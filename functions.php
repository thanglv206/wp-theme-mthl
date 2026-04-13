<?php
/**
 * MTHL v2.1 functions and definitions
 *
 * @package mthl
 */

if (!defined('MTHL_VERSION')) {
	define('MTHL_VERSION', '1.0.0');
}

function mthl_setup()
{
	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	// Let WordPress manage the document title.
	add_theme_support('title-tag');

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support('post-thumbnails');

	// Add support for custom logo
	add_theme_support('custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
	));

	// Register nav menus
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'mthl'),
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
add_action('after_setup_theme', 'mthl_setup');

/**
 * Enqueue scripts and styles.
 */
function mthl_scripts()
{
	wp_enqueue_style('mthl-style', get_stylesheet_uri(), array(), MTHL_VERSION);
	wp_enqueue_style('mthl-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), filemtime(get_theme_file_path('/assets/css/main.css')));

	wp_enqueue_script('mthl-main-script', get_template_directory_uri() . '/assets/js/main.js', array(), MTHL_VERSION, true);
}
add_action('wp_enqueue_scripts', 'mthl_scripts');

// Include additional files
// require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/custom-post-types.php';
require get_template_directory() . '/inc/meta-boxes.php';
require get_template_directory() . '/inc/customizer.php';

/**
 * Add Tailwind classes to Navigation Menu anchor tags.
 */
function mthl_nav_menu_link_attributes($atts, $item, $args, $depth)
{
	if (isset($args->theme_location) && $args->theme_location === 'menu-1') {
		$classes = 'transition-all duration-300 hover:scale-105 ';

		// Check if this menu item is the current page, or an ancestor of the current page
		if (in_array('current-menu-item', $item->classes) || in_array('current-page-ancestor', $item->classes)) {
			$classes .= 'text-primary border-b-2 border-secondary pb-1';
		} else {
			$classes .= 'text-on-surface hover:text-primary';
		}

		$atts['class'] = isset($atts['class']) ? $atts['class'] . ' ' . $classes : $classes;
	}
	return $atts;
}
add_filter('nav_menu_link_attributes', 'mthl_nav_menu_link_attributes', 10, 4);

/**
 * Custom Pagination with Tailwind classes
 */
function mthl_pagination() {
    $links = paginate_links(array(
        'prev_text' => '<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">chevron_left</span>',
        'next_text' => '<span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">chevron_right</span>',
        'type'      => 'array',
    ));

    if (empty($links)) {
        return;
    }

    echo '<div class="mt-20 flex justify-center items-center gap-2">';
    foreach ($links as $link) {
        $class = 'w-12 h-12 flex items-center justify-center rounded-xl border border-outline-variant hover:bg-surface-container-high transition-colors text-on-surface font-bold group';
        if (strpos($link, 'current') !== false) {
            $class = 'w-12 h-12 flex items-center justify-center rounded-xl bg-primary text-white font-bold shadow-md';
        } elseif (strpos($link, 'dots') !== false) {
            $class = 'w-12 h-12 flex items-center justify-center border-none hover:bg-transparent px-2 text-on-surface-variant font-bold w-auto';
        }
        $link = str_replace("class='page-numbers", "class='" . $class . " page-numbers", $link);
        $link = str_replace('class="page-numbers', 'class="' . $class . ' page-numbers', $link);
        echo $link;
    }
    echo '</div>';
}

