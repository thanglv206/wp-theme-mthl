<?php
global $theme_prefix, $theme_uri, $theme_version;

$theme_prefix = 'theme_mthl';
$theme_uri = get_template_directory_uri() . '/assets';
$theme_dir = get_template_directory();
$theme_version = '1.0';

// include scripts
include_once $theme_dir . '/inc/scripts.php';

// include theme support
include_once $theme_dir . '/inc/theme-support.php';
