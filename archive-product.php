<?php
/**
 * The template for displaying product archives
 */

get_header();
?>

<main class="pt-20 md:pt-24 pb-12 md:pb-20">
    <!-- Breadcrumb -->
    <div class="max-w-7xl mx-auto px-4 md:px-8 mb-6 md:mb-8">
        <nav class="flex text-sm text-on-surface-variant font-medium">
            <a href="<?php echo home_url('/'); ?>" class="hover:text-primary transition-colors cursor-pointer">Trang
                chủ</a>
            <span class="mx-2 text-outline-variant opacity-50">&gt;</span>
            <span class="text-secondary font-bold">Sản phẩm</span>
        </nav>
    </div>

    <!-- Featured Section: Sản phẩm Nổi bật -->
    <?php
    $featured_args = array(
        'post_type' => 'product',
        'posts_per_page' => 1,
        'meta_key' => '_product_is_main',
        'meta_value' => '1'
    );
    $featured_query = new WP_Query($featured_args);

    if (!$featured_query->have_posts()) {
        // Fallback to latest
        $featured_query = new WP_Query(array('post_type' => 'product', 'posts_per_page' => 1));
    }

    if ($featured_query->have_posts()):
        while ($featured_query->have_posts()):
            $featured_query->the_post();
            $price = get_post_meta(get_the_ID(), '_product_price', true);
            $sale_price = get_post_meta(get_the_ID(), '_product_sale_price', true);
            $discount_percent = 0;
            if (!empty($price) && !empty($sale_price) && $price > $sale_price) {
                $discount_percent = floor((($price - $sale_price) / $price) * 100);
            }
            $formatted_price = !empty($price) ? number_format($price, 0, ',', '.') . 'đ' : '';
            $formatted_sale_price = !empty($sale_price) ? number_format($sale_price, 0, ',', '.') . 'đ' : '';

            ?>
            <section class="max-w-7xl mx-auto px-4 md:px-8 mb-12 md:mb-24">
                <div class="bg-primary/5 rounded-3xl overflow-hidden border border-primary/10 shadow-xl">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                        <a href="<?php the_permalink(); ?>" class="aspect-square overflow-hidden block">
                            <?php if (has_post_thumbnail()): ?>
                                <img alt="<?php the_title_attribute(); ?>"
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-700"
                                    src="<?php the_post_thumbnail_url('large'); ?>" />
                            <?php else: ?>
                                <div class="w-full h-full bg-surface-variant flex items-center justify-center">No Image</div>
                            <?php endif; ?>
                        </a>
                        <div class="p-6 md:p-16 flex flex-col justify-center">
                            <div class="flex items-center space-x-2 mb-6">
                                <span
                                    class="bg-secondary text-on-secondary text-xs font-black px-4 py-1.5 rounded-full uppercase tracking-widest">Sản
                                    phẩm Nổi bật</span>
                            </div>
                            <a href="<?php the_permalink(); ?>">
                                <h2
                                    class="text-2xl md:text-5xl font-headline font-black text-primary mb-3 md:mb-6 leading-tight hover:text-primary-container transition-colors">
                                    <?php the_title(); ?>
                                </h2>
                            </a>
                            <div
                                class="text-on-surface-variant text-base md:text-lg mb-6 md:mb-8 leading-relaxed prose prose-stone max-w-none">
                                <?php the_excerpt(); ?>
                            </div>
                            <div class="flex items-center space-x-3 md:space-x-4 mb-8 md:mb-10">
                                <?php if ($sale_price): ?>
                                    <span
                                        class="text-3xl md:text-4xl font-black text-primary"><?php echo $formatted_sale_price; ?></span>
                                    <?php if ($price > $sale_price): ?>
                                        <span
                                            class="text-lg md:text-xl text-outline line-through opacity-60"><?php echo $formatted_price; ?></span>
                                        <span
                                            class="bg-error-container text-on-error-container text-xs md:text-sm font-bold px-2 py-1 md:px-3 rounded">-<?php echo $discount_percent; ?>%</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span
                                        class="text-3xl md:text-4xl font-black text-primary"><?php echo $formatted_price ?: __('Liên hệ', 'mthl'); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', get_theme_mod('mthl_company_phone', '090 1234 567'))); ?>"
                                    class="flex-1 text-center bg-primary text-on-primary py-3 px-6 md:py-4 md:px-8 rounded-xl font-bold text-base md:text-lg hover:bg-primary-container transition-all shadow-lg hover:shadow-primary/20 active:scale-95">Đặt
                                    hàng ngay</a>
                                <a href="<?php the_permalink(); ?>"
                                    class="flex-1 text-center border-2 border-outline-variant text-on-surface py-3 px-6 md:py-4 md:px-8 rounded-xl font-bold text-base md:text-lg hover:bg-surface-container-high transition-all active:scale-95">Xem
                                    chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>

    <!-- Page Header -->
    <section class="max-w-7xl mx-auto px-4 md:px-8 mb-8 md:mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">Sản phẩm của chúng tôi</h2>
        <div class="w-24 h-1 bg-secondary rounded-full"></div>
    </section>

    <!-- Product Grid -->
    <section class="max-w-7xl mx-auto px-4 md:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-8">
        <?php
        // Main archive loop
        if (have_posts()):
            while (have_posts()):
                the_post();
                $price = get_post_meta(get_the_ID(), '_product_price', true);
                $sale_price = get_post_meta(get_the_ID(), '_product_sale_price', true);
                $formatted_price = !empty($price) ? number_format($price, 0, ',', '.') . 'đ' : '';
                $formatted_sale_price = !empty($sale_price) ? number_format($sale_price, 0, ',', '.') . 'đ' : '';
                ?>
                <!-- Product Card -->
                <div
                    class="group flex flex-col bg-surface-container-lowest rounded-xl overflow-hidden transition-all duration-500 hover:-translate-y-2 border border-surface-variant/50">
                    <a href="<?php the_permalink(); ?>" class="aspect-square overflow-hidden bg-surface-container block">
                        <?php if (has_post_thumbnail()): ?>
                            <img alt="<?php the_title_attribute(); ?>"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                src="<?php the_post_thumbnail_url('medium'); ?>" />
                        <?php else: ?>
                            <div class="w-full h-full bg-surface-variant flex items-center justify-center">No Image</div>
                        <?php endif; ?>
                    </a>
                    <div
                        class="p-5 md:p-8 flex-grow flex flex-col border-b-4 border-transparent hover:border-secondary/10 transition-colors">
                        <a href="<?php the_permalink(); ?>">
                            <h3
                                class="text-xl md:text-2xl font-headline font-bold text-on-surface mb-2 md:mb-3 hover:text-primary transition-colors">
                                <?php the_title(); ?>
                            </h3>
                        </a>
                        <div class="mb-4 md:mb-6 flex items-baseline gap-2">
                            <?php if ($sale_price): ?>
                                <span class="text-xl md:text-2xl font-bold text-primary"><?php echo $formatted_sale_price; ?></span>
                                <span
                                    class="text-xs md:text-sm text-outline line-through opacity-60"><?php echo $formatted_price; ?></span>
                            <?php else: ?>
                                <span
                                    class="text-xl md:text-2xl font-bold text-primary"><?php echo $formatted_price ?: __('Liên hệ', 'mthl'); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="mt-auto grid grid-cols-2 gap-3">
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', get_theme_mod('mthl_company_phone', '090 1234 567'))); ?>"
                                class="text-center bg-primary text-on-primary py-3 rounded-lg font-bold text-sm hover:bg-primary-container transition-colors active:scale-95 block">Đặt
                                hàng</a>
                            <a href="<?php the_permalink(); ?>"
                                class="text-center bg-transparent border border-outline-variant text-on-surface py-3 rounded-lg font-bold text-sm hover:bg-surface-container-high transition-colors active:scale-95 block">Chi
                                tiết</a>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
        else:
            ?>
            <div class="col-span-full py-12 text-center text-on-surface-variant">
                <p>Hiện chưa có sản phẩm nào.</p>
            </div>
        <?php endif; ?>
    </section>

    <!-- Pagination -->
    <?php mthl_pagination(); ?>

    <!-- Tư vấn & Đặt hàng Section -->
    <section class="max-w-7xl mx-auto px-4 md:px-8 mt-12 md:mt-24">
        <div class="relative bg-surface-container-low rounded-2xl p-6 md:p-12 overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-secondary/5 rounded-full -mr-20 -mt-20 blur-3xl"></div>
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8 md:gap-10">
                <div class="max-w-2xl text-center md:text-left">
                    <h2 class="text-3xl md:text-4xl font-bold text-primary mb-3 md:mb-4">Tư vấn
                        &amp; Đặt hàng
                    </h2>
                    <p class="text-on-surface-variant text-base md:text-lg leading-relaxed">Quý khách cần tư vấn chi
                        tiết về sản
                        phẩm hoặc đặt hàng số lượng lớn cho quà biếu, lễ tết? Đội ngũ của chúng tôi luôn sẵn sàng hỗ
                        trợ trực tiếp qua Hotline.</p>
                </div>
                <div class="flex flex-col items-center md:items-end shrink-0 mt-2 md:mt-0">
                    <p class="text-secondary font-bold uppercase tracking-widest text-xs md:text-sm mb-1 md:mb-2">
                        Hotline 24/7</p>
                    <a class="text-3xl md:text-4xl font-headline font-black text-primary hover:scale-105 transition-transform duration-300"
                        href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', get_theme_mod('mthl_company_phone', '090 1234 567'))); ?>"><?php echo esc_html(get_theme_mod('mthl_company_phone', '090 1234 567')); ?></a>
                    <p class="text-on-surface-variant italic mt-2 text-xs md:text-sm">Cam kết chất lượng - Giao hàng
                        toàn quốc
                    </p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>