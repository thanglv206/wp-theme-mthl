<?php
$home_page = get_page_by_path('trang-chu');
$home_introduce = get_field('home_introduce', $home_page->ID);
$home_banner_carousel = get_field('home_banner_carousel', $home_page->ID);
?>
<?php get_header(); ?>
    <section class="pt-4 md:pt-0 pb-10">
        <div class="container px-4 mx-auto">
            <div class="flex flex-col items-center justify-center gap-2 my-0 lg:my-10">
                <h1 class="font-bold text-milano-primary text-xl lg:text-3xl uppercase">Mắm tép chưng thịt và tôm sắt biển Hạ Long</h1>
                <span class="font-bold text-base lg:text-xl uppercase">Đặc sản Hạ Long</span>
                <span class="font-bold text-base lg:text-xl">Cho bữa ăn
                    <b class="text-milano-primary">Ngon</b> – <b class="text-milano-primary">Sạch</b> – <b
                            class="text-milano-primary">Dinh dưỡng</b>
                </span>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 lg:gap-8">
                <?php if (!empty($home_banner_carousel) && count($home_banner_carousel) > 0): ?>
                    <img id="skeleton-banner" class="rounded-xl mt-8" src="<?= get_template_directory_uri(); ?>/assets/imgs/banner1.webp" alt="Mắp tép chưng thịt Hạ Long" />
                    <div class="home-owl-carousel owl-carousel mt-8">
                        <?php foreach ($home_banner_carousel as $banner): ?>
                            <div class="item">
                                <img class="rounded-xl" src="<?= esc_url($banner['url']); ?>" alt="<?= esc_attr($banner['alt'] ?? 'Mắp tép chưng thịt Hạ Long'); ?>" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        $(`#skeleton-banner`).hide();
                        $('.home-owl-carousel').owlCarousel({
                            loop:true,
                            margin:10,
                            responsiveClass:true,
                            autoplay: true,
                            autoplayTimeout: 5000,
                            autoplayHoverPause: true,
                            nav: false,
                            dots: true,
                            autoplaySpeed: 1000,
                            responsive:{
                                0:{
                                    items:1,
                                },
                                480:{
                                    items:1,
                                },
                                1024: {
                                    items: 1,
                                }
                            }
                        })
                    })
                </script>
                <div>
                    <div class="my-8">
                        <div class="flex items-baseline justify-between gap-4">
                            <div class="text-xl flex-grow font-bold">Hộp 500gram:</div>
                            <div class="space-x-2">
                                <strike class="text-milano-textDarkSecondary font-semibold text-lg">220.000đ</strike>
                                <span class="text-milano-primary font-bold text-2xl">200.000đ</span>
                            </div>
                        </div>
                        <div class="flex items-baseline justify-between gap-4">
                            <div class="text-xl flex-grow font-bold">Hộp 1kg:</div>
                            <div class="space-x-2">
                                <strike class="text-milano-textDarkSecondary font-semibold text-lg">420.000đ</strike>
                                <span class="text-milano-primary font-bold text-2xl">380.000đ</span>
                            </div>
                        </div>
                    </div>
                    <div class="my-8 border-2 bg-milano-bgMuted border-dashed border-milano-secondary p-4 rounded-lg">
                        <ul>
                            <li class="flex items-baseline justify-start gap-2">
                                <span class="material-icons text-2xl text-milano-primary">local_shipping</span>
                                <span class="-top-[6px] relative">Freeship nội thành khi mua từ 3 hộp</span>
                            </li>
                            <li class="flex items-baseline justify-start gap-2">
                                <span class="material-icons text-2xl text-milano-primary">workspace_premium</span>
                                <span class="-top-[6px] relative">An toàn vệ sinh thực phẩm - Không chất phụ gia, chất bảo quản</span>
                            </li>
                            <li class="flex items-baseline justify-start gap-2">
                                <span class="material-icons text-2xl text-milano-primary">safety_check</span>
                                <span class="-top-[6px] relative">Bảo quản tủ mát 1-2 tháng</span>
                            </li>
                            <li class="flex items-baseline justify-start gap-2">
                                <span class="material-icons text-2xl text-milano-primary">monitor_heart</span>
                                <span class="-top-[6px] relative">100% nguyên liệu tươi, sạch, đảm bảo đầy đủ dinh dưỡng</span>
                            </li>
                        </ul>
                    </div>
                    <div class="my-8">
                        <a href="tel:0385492525" class="flex flex-col gap-1 p-4 rounded-lg shadow-lg bg-milano-primary items-center justify-center text-white">
                    <span class="text-xl uppercase font-semibold">
                        Tư vấn & Đặt hàng ngay
                    </span>
                            <i>038 549 2525</i>
                        </a>
                    </div>
                    <div id="home--introduce" class="home--introduce whitespace-pre-line my-8 px-4 py-0 bg-milano-bgMuted text-milano-darkPrimary rounded-lg">
                        <?= get_the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>