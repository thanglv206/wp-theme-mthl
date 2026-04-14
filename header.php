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
            <div class="flex justify-between items-center px-4 md:px-8 py-4 max-w-7xl mx-auto w-full relative">
                <!-- Logo -->
                <div class="flex items-center relative z-50">
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

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden relative z-50 p-2 text-primary focus:outline-none -mr-2">
                    <span class="material-symbols-outlined text-3xl"
                        style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">menu</span>
                </button>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu-1',
                        'container' => false,
                        'menu_class' => 'flex items-center gap-8 font-medium tracking-wide list-none m-0 p-0 text-base',
                        'fallback_cb' => false,
                    ));
                    ?>
                    <?php $phone = get_theme_mod('mthl_company_phone', '090 1234 567'); ?>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>"
                        class="bg-gradient-to-r from-primary to-primary-container text-white px-6 py-2 rounded-lg font-semibold transition-all duration-300 hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                        Gọi Hotline
                    </a>
                </div>
            </div>
        </nav>

        <!-- Backdrop for mobile -->
        <div id="nav-backdrop"
            class="fixed inset-0 bg-black/50 z-[60] hidden opacity-0 transition-opacity duration-300 md:hidden">
        </div>

        <!-- Navigation Drawer (Mobile) -->
        <div id="nav-drawer"
            class="fixed inset-y-0 right-0 w-[85vw] max-w-sm bg-surface shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-[70] flex flex-col p-8 pt-20 h-[100dvh] overflow-y-auto md:hidden">

            <button id="mobile-menu-close" class="absolute top-4 right-4 p-2 text-primary focus:outline-none -mr-2">
                <span class="material-symbols-outlined text-3xl"
                    style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">close</span>
            </button>

            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-1',
                'container' => false,
                'menu_class' => 'flex flex-col gap-6 font-medium tracking-wide list-none m-0 p-0 w-full text-lg mt-8',
                'fallback_cb' => false,
            ));
            ?>
            <?php $phone = get_theme_mod('mthl_company_phone', '090 1234 567'); ?>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>"
                class="mt-auto bg-gradient-to-r from-primary to-primary-container text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 active:scale-95 flex items-center justify-center gap-2 shadow-md w-full">
                <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">call</span>
                Gọi Hotline
            </a>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const btn = document.getElementById('mobile-menu-btn');
                const closeBtn = document.getElementById('mobile-menu-close');
                const drawer = document.getElementById('nav-drawer');
                const backdrop = document.getElementById('nav-backdrop');
                let isOpen = false;

                function toggleMenu() {
                    isOpen = !isOpen;
                    if (isOpen) {
                        drawer.classList.remove('translate-x-full');
                        backdrop.classList.remove('hidden');
                        setTimeout(() => {
                            backdrop.classList.remove('opacity-0');
                        }, 10);
                        document.body.style.overflow = 'hidden'; // Prevent scrolling under drawer
                    } else {
                        drawer.classList.add('translate-x-full');
                        backdrop.classList.add('opacity-0');
                        setTimeout(() => {
                            backdrop.classList.add('hidden');
                        }, 300);
                        document.body.style.overflow = ''; // Restore scrolling
                    }
                }

                if (btn && backdrop) {
                    btn.addEventListener('click', toggleMenu);
                    backdrop.addEventListener('click', toggleMenu);
                    if (closeBtn) closeBtn.addEventListener('click', toggleMenu);
                }
            });
        </script>