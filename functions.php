<?php
/**
 * MTHL v2.1 functions and definitions
 *
 * @package mthl
 */

if ( ! defined( 'MTHL_VERSION' ) ) {
	define( 'MTHL_VERSION', '1.0.0' );
}

function mthl_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Register nav menus
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'mthl' ),
		)
	);

	// Add theme support for HTML5
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action( 'after_setup_theme', 'mthl_setup' );

/**
 * Enqueue scripts and styles.
 */
function mthl_scripts() {
	wp_enqueue_style( 'mthl-style', get_stylesheet_uri(), array(), MTHL_VERSION );
	wp_enqueue_style( 'mthl-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), filemtime( get_theme_file_path( '/assets/css/main.css' ) ) );

	wp_enqueue_script( 'mthl-main-script', get_template_directory_uri() . '/assets/js/main.js', array(), MTHL_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'mthl_scripts' );

// Include additional files
// require get_template_directory() . '/inc/custom-functions.php';
