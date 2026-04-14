<?php
/**
 * The template for displaying all single products
 */

get_header();

while (have_posts()):
    the_post();

    // Get Meta values
    $price = get_post_meta(get_the_ID(), '_product_price', true);
    $sale_price = get_post_meta(get_the_ID(), '_product_sale_price', true);
    $gallery_ids = get_post_meta(get_the_ID(), '_product_gallery', true);
    $gallery_array = !empty($gallery_ids) ? explode(',', $gallery_ids) : array();

    // Calculate Discount Percent
    $discount_percent = 0;
    if (!empty($price) && !empty($sale_price) && $price > $sale_price) {
        $discount_percent = floor((($price - $sale_price) / $price) * 100);
    }

    // Format prices for display
    $formatted_price = !empty($price) ? number_format($price, 0, ',', '.') . 'đ' : '';
    $formatted_sale_price = !empty($sale_price) ? number_format($sale_price, 0, ',', '.') . 'đ' : '';

    // Get main thumbnail URL
    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
    if (!$thumbnail_url) {
        // Fallback placeholder
        $thumbnail_url = 'https://via.placeholder.com/800x800?text=No+Image';
    }
    ?>

    <main class="max-w-7xl mx-auto px-4 md:px-8 pt-20 md:pt-24 pb-12 md:pb-16">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm text-on-surface-variant mb-6 md:mb-8">
            <a class="hover:text-primary transition-colors" href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-on-surface font-semibold"><?php the_title(); ?></span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-20">
            <!-- Left: Image Gallery -->
            <div class="space-y-6">
                <!-- Main Image -->
                <div class="aspect-square bg-surface-container-low rounded-xl overflow-hidden group">
                    <img id="main-product-image" alt="<?php echo esc_attr(get_the_title()); ?>"
                        class="w-full h-full object-cover transition-all duration-300"
                        src="<?php echo esc_url($thumbnail_url); ?>" />
                </div>

                <!-- Gallery Thumbnails -->
                <?php
                $all_images = array();

                // Add Gallery Images
                if (!empty($gallery_array)) {
                    foreach ($gallery_array as $attachment_id) {
                        if (empty($attachment_id))
                            continue;
                        $img_thumb = wp_get_attachment_image_url($attachment_id, 'medium');
                        $img_full = wp_get_attachment_image_url($attachment_id, 'large');
                        if ($img_thumb && $img_full) {
                            $all_images[] = array(
                                'thumb' => $img_thumb,
                                'full' => $img_full,
                            );
                        }
                    }
                }
                ?>

                <?php if (count($all_images) > 1): ?>
                    <div class="grid grid-cols-4 sm:grid-cols-5 gap-4" id="product-gallery-thumbnails">
                        <?php foreach ($all_images as $index => $image): ?>
                            <div data-full-image="<?php echo esc_url($image['full']); ?>"
                                class="gallery-thumb aspect-square bg-surface-container rounded-lg overflow-hidden cursor-pointer hover:opacity-100 transition-all border-2 <?php echo $index === 0 ? 'border-primary opacity-100' : 'border-transparent opacity-60 hover:border-outline-variant'; ?>">
                                <img class="w-full h-full object-cover" alt="Gallery Thumbnail <?php echo $index + 1; ?>"
                                    src="<?php echo esc_url($image['thumb']); ?>" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Gallery JS Script -->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const mainImage = document.getElementById('main-product-image');
                        const thumbnails = document.querySelectorAll('.gallery-thumb');

                        if (mainImage && thumbnails.length > 0) {
                            thumbnails.forEach(thumb => {
                                thumb.addEventListener('click', function () {
                                    // Remove active states from all thumbs
                                    thumbnails.forEach(t => {
                                        t.classList.remove('border-primary', 'opacity-100');
                                        t.classList.add('border-transparent', 'opacity-60');
                                    });

                                    // Add active state to the clicked one
                                    this.classList.remove('border-transparent', 'opacity-60', 'hover:border-outline-variant');
                                    this.classList.add('border-primary', 'opacity-100');

                                    // Change the main image smoothly
                                    mainImage.style.opacity = '0';
                                    setTimeout(() => {
                                        mainImage.src = this.getAttribute('data-full-image');
                                        mainImage.style.opacity = '1';
                                    }, 150);
                                });
                            });
                        }
                    });
                </script>
            </div>

            <!-- Right: Product Details -->
            <div class="flex flex-col justify-start">
                <div
                    class="inline-flex items-center px-3 py-1 bg-secondary-container text-on-secondary-container rounded-full text-xs font-bold uppercase tracking-wider mb-4 w-fit">
                    Hạ Long Original
                </div>
                <h1 class="text-3xl md:text-5xl font-headline font-bold text-primary mb-4 md:mb-6 leading-tight">
                    <?php the_title(); ?>
                </h1>

                <!-- Pricing Section -->
                <div
                    class="bg-surface-container-lowest p-4 md:p-6 rounded-xl space-y-4 md:space-y-6 mb-6 md:mb-8 border border-outline-variant/10 shadow-sm">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-baseline space-x-3">
                            <?php if ($sale_price): ?>
                                <span
                                    class="text-2xl md:text-3xl font-extrabold text-primary"><?php echo $formatted_sale_price; ?></span>
                                <?php if ($price > $sale_price): ?>
                                    <span
                                        class="text-on-surface-variant line-through text-base md:text-lg opacity-60"><?php echo $formatted_price; ?></span>
                                    <span
                                        class="bg-primary-container text-white text-[10px] px-2 py-0.5 rounded-full font-bold">-<?php echo $discount_percent; ?>%</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <span
                                    class="text-2xl md:text-3xl font-extrabold text-primary"><?php echo $formatted_price ?: __('Liên hệ', 'mthl'); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="flex gap-2">
                            <!-- Add to cart variants or similar custom functions could go here -->
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 text-secondary font-semibold text-sm">
                        <span class="material-symbols-outlined text-base">verified</span>
                        <span>Cam kết chuẩn chất lượng truyền thống</span>
                    </div>
                </div>

                <!-- CTA -->
                <a class="flex items-center justify-center space-x-3 w-full py-4 md:py-5 bg-gradient-to-r from-primary to-primary-container text-white rounded-xl text-base md:text-lg font-bold hover:scale-[1.02] transition-transform shadow-lg shadow-primary/20 mb-8"
                    href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', get_theme_mod('mthl_company_phone', '090 1234 567'))); ?>">
                    <span class="material-symbols-outlined">call</span>
                    <span>GỌI ĐẶT HÀNG NGAY -
                        <?php echo esc_html(get_theme_mod('mthl_company_phone', '090 1234 567')); ?></span>
                </a>

                <!-- Shipping & Guarantee -->
                <div class="grid grid-cols-2 gap-4 border-t border-outline-variant/15 pt-8">
                    <div class="flex items-start space-x-3">
                        <div class="p-2 bg-secondary/10 rounded-lg text-secondary">
                            <span class="material-symbols-outlined">local_shipping</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">Miễn phí giao hàng</h4>
                            <p class="text-xs text-on-surface-variant">Cho đơn hàng từ 3 hũ trở lên</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="p-2 bg-secondary/10 rounded-lg text-secondary">
                            <span class="material-symbols-outlined">verified</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">100% Tự nhiên</h4>
                            <p class="text-xs text-on-surface-variant">Không chất bảo quản, màu nhân tạo</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description Content -->
        <div class="mt-12 md:mt-20">
            <div class="bg-surface-container-lowest border border-outline-variant/10 p-6 md:p-8 rounded-2xl">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4 md:mb-6">Mô tả sản phẩm</h2>
                    <div class="text-on-surface-variant text-base md:text-lg leading-relaxed prose prose-stone max-w-none">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products (Displaying latest products for now) -->
        <div class="mt-16 md:mt-24">
            <div class="flex justify-between items-end mb-8 md:mb-10">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-primary mb-2 md:mb-4">Sản phẩm khác</h2>
                    <div class="h-1 w-20 bg-secondary rounded-full"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8">
                <?php
                $related_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand'
                );
                $related_query = new WP_Query($related_args);

                if ($related_query->have_posts()):
                    while ($related_query->have_posts()):
                        $related_query->the_post();
                        $rel_price = get_post_meta(get_the_ID(), '_product_price', true);
                        $rel_sale = get_post_meta(get_the_ID(), '_product_sale_price', true);
                        $rel_fmt_price = !empty($rel_price) ? number_format($rel_price, 0, ',', '.') . 'đ' : '';
                        $rel_fmt_sale = !empty($rel_sale) ? number_format($rel_sale, 0, ',', '.') . 'đ' : '';
                        $is_main = get_post_meta(get_the_ID(), '_product_is_main', true);
                        ?>
                        <!-- Product Card -->
                        <div
                            class="bg-surface-container-lowest rounded-xl overflow-hidden group border border-outline-variant/10 shadow-sm flex flex-col h-full">
                            <a href="<?php the_permalink(); ?>" class="aspect-square overflow-hidden relative block">
                                <?php if (has_post_thumbnail()): ?>
                                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                        src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title_attribute(); ?>" />
                                <?php else: ?>
                                    <div class="w-full h-full bg-surface-variant flex items-center justify-center">No Image</div>
                                <?php endif; ?>

                                <?php if ($is_main == '1'): ?>
                                    <div
                                        class="absolute top-4 right-4 bg-primary text-white text-[10px] px-2 py-1 rounded-full font-bold uppercase">
                                        Best Seller
                                    </div>
                                <?php endif; ?>
                            </a>
                            <div class="p-4 md:p-6 space-y-3 md:space-y-4 flex-grow flex flex-col justify-between">
                                <div>
                                    <a href="<?php the_permalink(); ?>">
                                        <h3
                                            class="text-lg md:text-xl font-headline font-bold group-hover:text-primary transition-colors">
                                            <?php the_title(); ?>
                                        </h3>
                                    </a>
                                </div>
                                <div>
                                    <div class="flex items-baseline gap-2 mb-3">
                                        <?php if ($rel_sale): ?>
                                            <span
                                                class="text-lg md:text-xl font-bold text-secondary"><?php echo $rel_fmt_sale; ?></span>
                                            <span
                                                class="text-xs md:text-sm text-on-surface-variant line-through opacity-60"><?php echo $rel_fmt_price; ?></span>
                                        <?php else: ?>
                                            <span
                                                class="text-lg md:text-xl font-bold text-secondary"><?php echo $rel_fmt_price ?: __('Liên hệ', 'mthl'); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 md:gap-3 pt-2">
                                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', get_theme_mod('mthl_company_phone', '090 1234 567'))); ?>"
                                            class="text-center bg-primary text-white py-2 rounded-lg font-bold transition-all duration-300 hover:scale-105 text-xs">Đặt
                                            hàng</a>
                                        <a href="<?php the_permalink(); ?>"
                                            class="text-center border border-outline-variant/50 text-primary py-2 rounded-lg font-bold transition-all duration-300 hover:scale-105 text-xs">Chi
                                            tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </main>

    <?php
endwhile;

get_footer();
