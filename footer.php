<?php global $theme_uri; ?>
<footer class="border-t border-milano-borderPrimary">
    <div class="container mx-auto py-10 px-4">
        <div class="flex flex-col lg:flex-row items-start justify-start lg:justify-between gap-4">
            <div class="flex items-center justify-between lg:justify-start gap-6 w-full lg:w-fit">
                <a href="<?= home_url() ?>" class="min-w-fit">
                    <?php
                    $logo_url = get_theme_mod('custom_logo');
                    if ($logo_url): ?>
                        <img src="<?= wp_get_attachment_image_url($logo_url, 'full'); ?>" alt="logo"
                             class="h-[64px] lg:h-[80px] w-[90px] min-w-[90px] lg:w-[112px] lg:min-w-[112px]"/>
                    <?php else: ?>
                        <span class="font-bold text-2xl text-milano-primary uppercase"><?= get_bloginfo('name'); ?></span>
                    <?php endif; ?>
                </a>
                <div class="flex flex-col items-center justify-center gap-1 w-full min-w-fit">
                    <div class="uppercase text-center text-milano-primary font-bold">Mắm tép chưng thịt Hạ Long</div>
                    <div class="text-center text-milano-textDarkPrimary text-sm">Cho bữa ăn Ngon - Sạch - Dinh Dưỡng</div>
                </div>
            </div>
            <div class="mt-8 lg:mt-0 min-w-fit">
                <div class="font-bold text-milano-textDarkSecondary uppercase text-sm mb-4">Liên hệ</div>
                <ul>
                    <li class="flex items-baseline justify-start gap-2">
                        <span class="material-icons text-xl text-milano-primary">phone_in_talk</span>
                        <div class="-top-[5px] relative"><span>Hotline: </span><a href="tel:0385492525">038 549 2525</a></div>
                    </li>
                    <li class="flex items-baseline justify-start gap-2">
                        <span class="material-icons text-xl text-milano-primary">mail</span>
                        <div class="-top-[5px] relative"><span>Email: </span><a href="mailTo:mamtephalong@gmail.com">mamtephalong@gmail.com</a></div>
                    </li>
                    <li class="flex items-baseline justify-start gap-2">
                        <span class="material-icons text-xl text-milano-primary">travel_explore</span>
                        <div class="-top-[5px] relative"><span>Facebook: </span><a href="https://fb.com/mamtephalongvn" target="_blank">https://fb.com/mamtephalongvn</a></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-xs text-white bg-milano-secondary text-center px-4 py-2">
        ©2024 Copyright. All rights reserved
    </div>
</footer>
</body>

<?php wp_footer(); ?>
</html>