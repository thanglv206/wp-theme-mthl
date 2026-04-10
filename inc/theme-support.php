<?php
// register theme customize
add_action('after_setup_theme', 'xosomilano_theme_support');
function xosomilano_theme_support() {
    // register nav menu
    register_nav_menus([
        'primary' => 'Primary menu',
    ]);
}

// register some features in post form
add_theme_support('post-thumbnails');
add_theme_support( 'custom-logo' );
add_theme_support('title-tag');