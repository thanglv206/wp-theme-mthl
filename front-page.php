<?php
/**
 * The front page template file
 */

get_header();
?>
<main class="pt-20 md:pt-24">
    <!-- Hero Section -->
    <section
        class="max-w-7xl mx-auto px-4 md:px-8 pb-10 md:pb-16 grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">
        <div class="space-y-8">
            <div
                class="inline-flex items-center gap-2 bg-secondary-container text-on-secondary-container px-4 py-1 rounded-full text-sm font-bold uppercase tracking-wider">
                <span class="material-symbols-outlined text-sm" data-icon="verified">verified</span>
                Đặc sản Hạ Long chính hiệu
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight text-primary">
                Đặc sản Hạ Long <br /><span class="text-secondary italic">Tinh hoa</span> ẩm thực biển
            </h1>
            <p class="text-lg text-on-surface-variant max-w-lg leading-relaxed">
                Hương vị truyền thống được gìn giữ qua nhiều thế hệ. Mắm tép chưng thịt Hạ Long mang đến vị ngọt từ
                biển cả và sự ấm nồng trong từng bữa cơm gia đình.
            </p>
            <div class="grid grid-cols-2 md:flex gap-3 md:gap-4 pt-4">
                <?php $phone = get_theme_mod('mthl_company_phone', '090 1234 567'); ?>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>"
                    class="flex items-center justify-center text-center border-2 border-transparent bg-gradient-to-r from-primary to-primary-container text-white px-4 md:px-8 py-3.5 md:py-4 rounded-xl font-bold text-base md:text-lg shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 active:scale-95">
                    Đặt hàng ngay
                </a>
                <?php $shop_url = function_exists('wc_get_page_id') ? get_permalink(wc_get_page_id('shop')) : home_url('/san-pham'); ?>
                <a href="<?php echo esc_url($shop_url); ?>"
                    class="flex items-center justify-center text-center border-2 border-outline-variant/30 text-primary hover:border-primary hover:bg-primary/5 px-4 md:px-8 py-3.5 md:py-4 rounded-xl font-bold text-base md:text-lg transition-all duration-300 hover:shadow-md hover:-translate-y-1 active:scale-95">
                    Sản phẩm
                </a>
            </div>
        </div>
        <div class="relative">
            <div class="aspect-square overflow-hidden rounded-xl bg-surface-container-high shadow-2xl">
                <img class="w-full h-full object-cover"
                    data-alt="Close-up of traditional Vietnamese Mam Tep Chung Thit in a ceramic bowl, garnished with herbs on a rustic wooden table with soft morning light."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkXUVZqom5oCCXd1zQ52fYx6rerpBhklCBzxylIoEwIEhM5E1RemtW4vq062MzbEMP4R8sA48QrJ03wEypMs2NSs6W5AgC48_tZ4f1yH_PLIboCgagSb0xTh7ZQdQG4Mo0Onq5OXxqd0aAYQrOc3vLGESDk4jImFJYxwKptk8a-Znj0xLUWj8aN9xqHjsuLrl1DLReAUcw0Whn61stmXwAuM_8sjVuS9zKYot0Ff0OOTHAyM7n_wyg2RK890CLRO-pWl5l5HWAVLto" />
            </div>
        </div>
    </section>
    <!-- Product Section -->
    <section class="bg-surface-container-low py-12 md:py-24">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 md:mb-16 gap-6">
                <div class="space-y-3 md:space-y-4">
                    <h2 class="text-3xl md:text-4xl font-bold text-primary">Sản Phẩm Đặc Trưng</h2>
                    <p class="text-on-surface-variant max-w-2xl">Sản phẩm được chế biến từ nguồn nguyên liệu tươi ngon
                        nhất của vùng biển Quảng Ninh.</p>
                </div>
                <div class="hidden md:flex gap-4">
                    <button id="product-carousel-prev"
                        class="w-12 h-12 rounded-full border border-outline-variant/30 flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-colors">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button id="product-carousel-next"
                        class="w-12 h-12 rounded-full border border-outline-variant/30 flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-colors">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
            </div>
            <div id="product-carousel" class="flex gap-8 overflow-x-auto no-scrollbar pb-8 snap-x scroll-smooth">
                <?php
                $product_query = new WP_Query(array(
                    'post_type' => 'product',
                    'posts_per_page' => 8,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));

                if ($product_query->have_posts()):
                    while ($product_query->have_posts()):
                        $product_query->the_post();
                        $p_price = get_post_meta(get_the_ID(), '_product_price', true);
                        $p_sale = get_post_meta(get_the_ID(), '_product_sale_price', true);
                        $p_main = get_post_meta(get_the_ID(), '_product_is_main', true);
                        $fmt_price = !empty($p_price) ? number_format($p_price, 0, ',', '.') . 'đ' : '';
                        $fmt_sale = !empty($p_sale) ? number_format($p_sale, 0, ',', '.') . 'đ' : '';
                        $phone = get_theme_mod('mthl_company_phone', '0901234567');
                        $phone_raw = preg_replace('/[^0-9]/', '', $phone);
                        ?>
                        <!-- Product Card -->
                        <div
                            class="w-[75vw] md:w-[calc(50%-1rem)] lg:w-[calc(33.333333%-1.333333rem)] min-w-0 bg-surface-container-lowest rounded-xl overflow-hidden group border border-outline-variant/10 snap-start flex-shrink-0 flex flex-col">
                            <a href="<?php the_permalink(); ?>" class="aspect-square overflow-hidden relative block">
                                <?php if (has_post_thumbnail()): ?>
                                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                        alt="<?php the_title_attribute(); ?>" src="<?php the_post_thumbnail_url('medium'); ?>" />
                                <?php else: ?>
                                    <div class="w-full h-full bg-surface-variant flex items-center justify-center">No Image</div>
                                <?php endif; ?>

                                <?php if ($p_main === '1'): ?>
                                    <div
                                        class="absolute top-4 right-4 bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-xs font-bold">
                                        Bán chạy</div>
                                <?php endif; ?>
                            </a>
                            <div class="p-6 md:p-8 space-y-4 flex flex-col flex-1">
                                <div class="flex-1 space-y-3">
                                    <a href="<?php the_permalink(); ?>">
                                        <h3 class="text-xl md:text-2xl font-bold hover:text-primary transition-colors">
                                            <?php the_title(); ?>
                                        </h3>
                                    </a>
                                    <div class="flex items-baseline gap-2">
                                        <?php if ($p_sale): ?>
                                            <span
                                                class="text-xl md:text-2xl font-bold text-secondary"><?php echo $fmt_sale; ?></span>
                                            <span
                                                class="text-sm text-on-surface-variant line-through opacity-60"><?php echo $fmt_price; ?></span>
                                        <?php else: ?>
                                            <span
                                                class="text-xl md:text-2xl font-bold text-secondary"><?php echo $fmt_price ?: __('Liên hệ', 'mthl'); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-3 pt-2 mt-auto">
                                    <a href="tel:<?php echo esc_attr($phone_raw); ?>"
                                        class="text-center bg-primary text-white py-3 rounded-lg font-bold transition-all duration-300 hover:scale-105 text-sm">Đặt
                                        hàng</a>
                                    <a href="<?php the_permalink(); ?>"
                                        class="text-center border border-outline-variant/50 text-primary py-3 rounded-lg font-bold transition-all duration-300 hover:scale-105 text-sm">Chi
                                        tiết</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    ?>
                    <p class="text-on-surface-variant">Hiện chưa có sản phẩm nào.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Carousel Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const carousel = document.getElementById('product-carousel');
                const prevBtn = document.getElementById('product-carousel-prev');
                const nextBtn = document.getElementById('product-carousel-next');

                if (!carousel || !prevBtn || !nextBtn) return;

                const scrollAmount = 400;

                prevBtn.addEventListener('click', function () {
                    carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                });

                nextBtn.addEventListener('click', function () {
                    carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                });
            });
        </script>
    </section>
    <!-- News & Share Section -->
    <section class="py-12 md:py-24 bg-surface">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 md:mb-12 gap-6">
                <div class="space-y-3 md:space-y-4">
                    <h2 class="text-3xl md:text-4xl font-bold text-primary">Tin tức &amp; Chia sẻ</h2>
                    <p class="text-on-surface-variant max-w-xl">Cập nhật những câu chuyện về nghề truyền thống và bí
                        quyết nấu ăn ngon mỗi ngày.</p>
                </div>
                <div class="hidden md:flex gap-4">
                    <button id="news-carousel-prev"
                        class="w-12 h-12 rounded-full border border-outline-variant/30 flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-colors">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button id="news-carousel-next"
                        class="w-12 h-12 rounded-full border border-outline-variant/30 flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-colors">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
            </div>
            <div id="news-carousel" class="flex gap-8 overflow-x-auto no-scrollbar pb-8 snap-x scroll-smooth">
                <?php
                $news_query = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));

                if ($news_query->have_posts()):
                    while ($news_query->have_posts()):
                        $news_query->the_post();
                        $categories = get_the_category();
                        $first_category = !empty($categories) ? $categories[0]->name : 'Tin tức';
                        ?>
                        <!-- News Item -->
                        <div
                            class="w-[75vw] md:w-[calc(50%-1rem)] lg:w-[calc(33.333333%-1.333333rem)] min-w-0 group cursor-pointer snap-start flex-shrink-0">
                            <a href="<?php the_permalink(); ?>" class="aspect-video overflow-hidden rounded-lg mb-6 block">
                                <?php if (has_post_thumbnail()): ?>
                                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                        alt="<?php the_title_attribute(); ?>"
                                        src="<?php the_post_thumbnail_url('medium_large'); ?>" />
                                <?php else: ?>
                                    <div class="w-full h-full bg-surface-variant flex items-center justify-center">No Image</div>
                                <?php endif; ?>
                            </a>
                            <div class="space-y-3">
                                <div class="text-secondary font-bold text-xs uppercase tracking-widest">
                                    <?php echo esc_html($first_category); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>">
                                    <h3 class="text-xl font-bold group-hover:text-primary transition-colors">
                                        <?php the_title(); ?>
                                    </h3>
                                </a>
                                <p class="text-on-surface-variant text-sm line-clamp-2">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                </p>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    ?>
                    <p class="text-on-surface-variant">Hiện chưa có tin tức nào.</p>
                <?php endif; ?>
            </div>
        </div>
        <!-- News Carousel Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const newsCarousel = document.getElementById('news-carousel');
                const newsPrevBtn = document.getElementById('news-carousel-prev');
                const newsNextBtn = document.getElementById('news-carousel-next');

                if (!newsCarousel || !newsPrevBtn || !newsNextBtn) return;

                const newsScrollAmount = 400;

                newsPrevBtn.addEventListener('click', function () {
                    newsCarousel.scrollBy({ left: -newsScrollAmount, behavior: 'smooth' });
                });

                newsNextBtn.addEventListener('click', function () {
                    newsCarousel.scrollBy({ left: newsScrollAmount, behavior: 'smooth' });
                });
            });
        </script>
    </section>
    <!-- Quality Commitment Section -->
    <section class="py-12 md:py-24 bg-surface-container-low">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="text-center mb-8 md:mb-16 space-y-3 md:space-y-4">
                <h2 class="text-3xl md:text-4xl font-bold text-primary">Cam kết chất lượng</h2>
                <p class="text-on-surface-variant max-w-2xl mx-auto">Chúng tôi đặt chữ Tâm và uy tín lên hàng đầu
                    trong mỗi sản phẩm trao đến tay khách hàng.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8">
                <div
                    class="bg-surface-container-lowest p-6 md:p-8 rounded-xl text-center shadow-sm border border-outline-variant/10 hover:shadow-md transition-shadow">
                    <div
                        class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center text-primary mx-auto mb-4 md:mb-6">
                        <span class="material-symbols-outlined text-3xl">eco</span>
                    </div>
                    <h3 class="text-lg font-bold mb-3">Nguyên liệu tự nhiên</h3>
                    <p class="text-sm text-on-surface-variant">Lựa chọn từ nguồn hải sản tươi sạch nhất vùng vịnh Hạ
                        Long.</p>
                </div>
                <div
                    class="bg-surface-container-lowest p-6 md:p-8 rounded-xl text-center shadow-sm border border-outline-variant/10 hover:shadow-md transition-shadow">
                    <div
                        class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center text-primary mx-auto mb-4 md:mb-6">
                        <span class="material-symbols-outlined text-3xl">history_edu</span>
                    </div>
                    <h3 class="text-lg font-bold mb-3">Công thức gia truyền</h3>
                    <p class="text-sm text-on-surface-variant">Hương vị đặc trưng được gìn giữ và phát triển qua 3
                        thập kỷ.</p>
                </div>
                <div
                    class="bg-surface-container-lowest p-6 md:p-8 rounded-xl text-center shadow-sm border border-outline-variant/10 hover:shadow-md transition-shadow">
                    <div
                        class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center text-primary mx-auto mb-4 md:mb-6">
                        <span class="material-symbols-outlined text-3xl">health_and_safety</span>
                    </div>
                    <h3 class="text-lg font-bold mb-3">An toàn thực phẩm</h3>
                    <p class="text-sm text-on-surface-variant">Quy trình chế biến khép kín, đạt chuẩn vệ sinh an
                        toàn thực phẩm.</p>
                </div>
                <div
                    class="bg-surface-container-lowest p-6 md:p-8 rounded-xl text-center shadow-sm border border-outline-variant/10 hover:shadow-md transition-shadow">
                    <div
                        class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center text-primary mx-auto mb-4 md:mb-6">
                        <span class="material-symbols-outlined text-3xl">local_shipping</span>
                    </div>
                    <h3 class="text-lg font-bold mb-3">Giao hàng nhanh</h3>
                    <p class="text-sm text-on-surface-variant">Đảm bảo sản phẩm đến tay khách hàng luôn tươi ngon và
                        đúng hẹn.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials Section -->
    <section class="py-12 md:py-24 bg-surface">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="text-center mb-8 md:mb-16 space-y-3 md:space-y-4">
                <h2 class="text-3xl md:text-4xl font-bold text-primary">Khách hàng nói gì</h2>
                <p class="text-on-surface-variant max-w-2xl mx-auto">Sự hài lòng của quý khách là động lực lớn nhất
                    để chúng tôi không ngừng hoàn thiện.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8">
                <div
                    class="bg-surface-container-lowest p-6 md:p-8 rounded-xl shadow-sm border border-outline-variant/10 hover:shadow-md transition-shadow relative">
                    <span
                        class="material-symbols-outlined text-primary/20 text-6xl absolute top-4 right-6">format_quote</span>
                    <div class="flex gap-1 text-secondary mb-4">
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                    </div>
                    <p class="text-on-surface-variant italic mb-6 leading-relaxed">"Mắm tép ở đây vị rất vừa vặn,
                        không quá mặn như những nơi khác. Ăn cùng cơm nóng thì đúng là cực phẩm."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-surface-container-high overflow-hidden">
                            <img alt="Avatar" class="w-full h-full object-cover"
                                onerror="this.src='https://ui-avatars.com/api/?name=Chị+Lan&amp;background=8b2621&amp;color=fff'"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuD8pY7mU7Z7f_V5g9L8P5k4o9s8w8y8x8c8v8b8n8m8l8k8j8h8g8f8e8d8c8b8a8z" />
                        </div>
                        <div>
                            <div class="font-bold">Chị Lan Anh</div>
                            <div class="text-xs text-on-surface-variant">Hà Nội</div>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-surface-container-lowest p-6 md:p-8 rounded-xl shadow-sm border border-outline-variant/10 hover:shadow-md transition-shadow relative">
                    <span
                        class="material-symbols-outlined text-primary/20 text-6xl absolute top-4 right-6">format_quote</span>
                    <div class="flex gap-1 text-secondary mb-4">
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                    </div>
                    <p class="text-on-surface-variant italic mb-6 leading-relaxed">"Chả mực giã tay rất giòn và
                        thơm. Mỗi lần đi du lịch Hạ Long tôi đều ghé mua, giờ có thể đặt online tiện quá."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-surface-container-high overflow-hidden">
                            <img alt="Avatar" class="w-full h-full object-cover"
                                onerror="this.src='https://ui-avatars.com/api/?name=Anh+Hoàng&amp;background=8b2621&amp;color=fff'"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuD8pY7mU7Z7f_V5g9L8P5k4o9s8w8y8x8c8v8b8n8m8l8k8j8h8g8f8e8d8c8b8a8z" />
                        </div>
                        <div>
                            <div class="font-bold">Anh Minh Hoàng</div>
                            <div class="text-xs text-on-surface-variant">TP. Hồ Chí Minh</div>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-surface-container-lowest p-6 md:p-8 rounded-xl shadow-sm border border-outline-variant/10 hover:shadow-md transition-shadow relative">
                    <span
                        class="material-symbols-outlined text-primary/20 text-6xl absolute top-4 right-6">format_quote</span>
                    <div class="flex gap-1 text-secondary mb-4">
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star</span>
                        <span class="material-symbols-outlined text-sm">star_half</span>
                    </div>
                    <p class="text-on-surface-variant italic mb-6 leading-relaxed">"Giao hàng nhanh, đóng gói rất
                        cẩn thận và chuyên nghiệp. Sản phẩm chất lượng xứng đáng với giá tiền."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-surface-container-high overflow-hidden">
                            <img alt="Avatar" class="w-full h-full object-cover"
                                onerror="this.src='https://ui-avatars.com/api/?name=Bác+Hùng&amp;background=8b2621&amp;color=fff'"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuD8pY7mU7Z7f_V5g9L8P5k4o9s8w8y8x8c8v8b8n8m8l8k8j8h8g8f8e8d8c8b8a8z" />
                        </div>
                        <div>
                            <div class="font-bold">Bác Hùng</div>
                            <div class="text-xs text-on-surface-variant">Quảng Ninh</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Redesigned CTA Section -->
    <section class="max-w-7xl mx-auto px-4 md:px-8 py-12 md:py-24">
        <div class="relative rounded-3xl overflow-hidden shadow-2xl group">
            <!-- Background with image overlay -->
            <div class="absolute inset-0">
                <img alt="Ha Long Bay Background"
                    class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBbFO1GjPhiJ9bM1SkYvAVGNXSV-Ja3g0mMolW7kdIvANLHH2sWMTwCKM2LQtbTquWG4z0Paug_1nJ4b69Gtoetjm79zV0-MAMqbSpHVmJ5NqDZ9vRtFCMDQa1QHPj4MF2PD3Jhn2y9K0fafhcbi-L795UaBUTgpQYtTOs9NIfajD-u9LdS3r_ud5a1cAqITUhOKOYYMaobNhFmPRYGC-rZUR0PqUPBc5vmFQ-mI5W8zTkru2Pz92bbKh11BxiGt2h0xsilNbEWFfBY" />
                <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/80 to-transparent"></div>
            </div>
            <div
                class="relative z-10 p-8 py-16 md:p-24 flex flex-col md:flex-row items-center justify-between gap-8 md:gap-12">
                <div class="max-w-2xl space-y-4 md:space-y-8 text-center md:text-left">
                    <h2 class="text-3xl md:text-6xl font-extrabold text-white leading-tight">Mang trọn hương vị biển Hạ
                        Long về gian bếp nhà bạn</h2>
                    <p class="text-white/80 text-base md:text-xl font-medium max-w-xl">Hương vị di sản trong từng sản
                        phẩm. Liên hệ ngay để được giao hàng tận nơi nhanh chóng nhất.</p>
                </div>
                <div class="flex flex-col gap-6 w-full md:w-auto">
                    <a class="flex items-center justify-center gap-3 md:gap-4 bg-primary text-white px-6 py-4 md:px-10 md:py-6 rounded-2xl font-black text-xl md:text-2xl shadow-2xl hover:bg-primary-container hover:text-white transition-all hover:scale-105 active:scale-95"
                        href="tel:<?php echo esc_attr($phone_raw); ?>">
                        <span class="material-symbols-outlined text-2xl md:text-3xl">call</span>
                        <?php echo esc_html($phone); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
