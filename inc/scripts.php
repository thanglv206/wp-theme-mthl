<?php
add_action('wp_enqueue_scripts', 'xosomilano_register_styles');
function xosomilano_register_styles() {
    global $theme_prefix,$theme_uri,$theme_version;
    wp_enqueue_style($theme_prefix . '-cdn-carousel', $theme_uri . '/css/cdn-carousel.css', [], $theme_version, 'all');
    wp_enqueue_style($theme_prefix . '-cdn-carousel-default', $theme_uri . '/css/cdn-carousel-theme-default.css', [], $theme_version, 'all');
    wp_enqueue_style($theme_prefix . '-cdn-flowbite', get_template_directory_uri() . '/node_modules/flowbite/dist/flowbite.min.css', [], $theme_version, 'all');
    wp_enqueue_style($theme_prefix . '-main-css', $theme_uri . '/css/main.css');
}

// register scripts
add_action('wp_enqueue_scripts', 'xosomilano_register_scripts');
function xosomilano_register_scripts() {
    global $theme_prefix,$theme_uri,$theme_version;
    wp_enqueue_script('jquery');
    wp_enqueue_script($theme_prefix.'-cdn-carousel-js', $theme_uri . '/js/cdn-carousel.js', array('jquery'), $theme_version, true);
    wp_enqueue_script($theme_prefix.'-cdn-flowbite-js', get_template_directory_uri() . '/node_modules/flowbite/dist/flowbite.min.js', array('jquery'), $theme_version, true);
}

function exclude_categories_from_search($query) {
    if ($query->is_search && !is_admin()) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts', 'exclude_categories_from_search');