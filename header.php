<?php
/**
 * The header for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="light">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chiron+GoRound+TC:wght@200..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
        rel="stylesheet" />

    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-surface text-on-surface flex flex-col min-h-screen font-body selection:bg-primary/20'); ?>>

    <?php wp_body_open(); ?>
    <div id="page" class="site flex flex-col flex-grow w-full">
        <!-- TopNavBar -->
        <nav class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md shadow-sm">
            <div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto w-full">
                <div class="flex items-center">
                    <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    if (has_custom_logo() && $logo) {
                        echo '<a href="' . esc_url(home_url('/')) . '" class="flex items-center">';
                        echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="h-10 w-auto">';
                        echo '</a>';
                    } else {
                        echo '<a href="' . esc_url(home_url('/')) . '" class="text-2xl font-bold tracking-tighter text-primary">' . get_bloginfo('name') . '</a>';
                    }
                    ?>
                </div>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'container' => false,
                    'menu_class' => 'hidden md:flex items-center gap-8 font-medium tracking-wide list-none m-0 p-0',
                    'fallback_cb' => false,
                ));
                ?>
                <?php $phone = get_theme_mod('mthl_company_phone', '090 1234 567'); ?>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>"
                    class="bg-gradient-to-r from-primary to-primary-container text-white px-6 py-2 rounded-lg font-semibold transition-all duration-300 hover:scale-105 active:scale-95">
                    Gọi Hotline
                </a>
            </div>
        </nav>