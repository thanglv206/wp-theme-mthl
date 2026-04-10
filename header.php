<?php global $theme_uri; ?>
<?php
$home_page = get_page_by_path('trang-chu');
$home_header_bio = get_field('home_header_bio', $home_page->ID);
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-TK8RWQ9P');</script>
	<!-- End Google Tag Manager -->
    <?php wp_head(); ?>
</head>
<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TK8RWQ9P" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
<header class="bg-white">
    <div class="bg-milano-secondary">
        <div class="container mx-auto py-1 px-4">
            <?php
            $current_timestamp = current_time('timestamp');
            $current_date = date_i18n('l d/m/Y', $current_timestamp);
            $days_in_vietnamese = [
                'Monday' => 'Thứ Hai',
                'Tuesday' => 'Thứ Ba',
                'Wednesday' => 'Thứ Tư',
                'Thursday' => 'Thứ Năm',
                'Friday' => 'Thứ Sáu',
                'Saturday' => 'Thứ Bảy',
                'Sunday' => 'Chủ Nhật'
            ];
            $current_date_vietnamese = str_replace(array_keys($days_in_vietnamese), array_values($days_in_vietnamese), $current_date);
            ?>
            <div class="w-full flex items-center justify-between gap-2 xl:gap-4 flex-wrap xl:flex-nowrap">
                <div class="header-loop-content to-left">
                    <p class="text-white text-sm px-8"><?= $home_header_bio; ?></p>
                </div>
                <div class="inline-flex items-center justify-end gap-4 relative min-w-max w-full xl:w-fit">
                    <span class="hotspot main-wrapper">
                      <span class="hotspot dots-container">
                        <span class="hotspot dot1"></span>
                        <span class="hotspot dot2"></span>
                      </span>
                    </span>
                    <span class="text-white text-sm">Hôm nay: <?= $current_date_vietnamese; ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container px-4 mx-auto">
        <div class="flex items-center justify-between w-full h-auto lg:h-[112px]">
            <a href="<?= home_url() ?>" class="py-4 lg:py-0 min-w-fit">
                <?php
                $logo_url = get_theme_mod('custom_logo');
                if ($logo_url):
                ?>
                    <img src="<?= wp_get_attachment_image_url($logo_url, 'full'); ?>" alt="logo"
                         class="h-[64px] lg:h-[88px] w-auto"/>
                <?php else: ?>
                    <span class="font-bold text-2xl text-milano-primary uppercase"><?= get_bloginfo('name'); ?></span>
                <?php endif; ?>
            </a>
            <div class="w-full hidden lg:block">
                <nav class="relative min-w-fit">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'container' => false,
                        'items_wrap' => '<ul class="header_menu">%3$s</ul>',
                        'fallback_cb' => false
                    ]);
                    ?>
                </nav>
            </div>
            <div class="flex items-center justify-end gap-4 min-w-fit">
                <div class="block min-w-fit ml-8">
                    <a href="tel:0385492525" class="bg-milano-primary border-none rounded-lg text-white flex items-center justify-center gap-2 px-4 h-10">
                        <span class="material-icons text-2xl">phone_in_talk</span>
                        <span>038 549 2525</span>
                    </a>
                </div>
                <div class="block lg:hidden">
                    <button class="block lg:hidden bg-white border-none" type="button" data-drawer-target="drawer-example" data-drawer-show="drawer-example" aria-controls="drawer-example">
                        <span class="material-icons text-2xl text-milano-primary">menu</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="drawer-example" class="fixed top-0 left-0 z-40 h-screen px-4 py-8 overflow-y-auto transition-transform -translate-x-full bg-white w-80 bg-milano-muted" tabindex="-1" aria-labelledby="drawer-label">
        <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>

        <div class="space-y-6">
            <div class="font-bold text-lg text-milano-primary border-b-[2px] border-milano-primary uppercase pb-1">Danh mục</div>
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
                'items_wrap' => '<ul class="header_menu_drawer space-y-3">%3$s</ul>',
                'fallback_cb' => false,
            ]);
            ?>
        </div>
    </div>
</header>