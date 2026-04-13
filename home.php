<?php
/**
 * The home template file (Blog index)
 */

get_header();
?>

<main class="min-h-screen">
    <!-- Hero Section (Reduced Height) -->
    <section class="relative h-[45vh] flex items-center justify-center pt-16 overflow-hidden">
        <img alt="Cảnh đẹp Hạ Long" class="absolute inset-0 w-full h-full object-cover"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCBMhbGpkAUs0NnNr-ZyCTJgxlbYtNlK7wccPQnL8I6hmjT8685anF4JbZWxDxN8bFLEZtPPTe7bPFWtniq2Zdjym0eQtmXwWLpYyKyeSP9FI1x67EWglVrtPqrZ8efW7JaNB-LYoR3ZSgg1VrSTKDvH8naNJNi4gz4nUu2RlYG4yMr9jaFH4i85pYCi3YHssRZmsf1CwZjC3KtjbGuMYWiLnA-p4yPGQ5MP9kMK1MdnCoLIQgyAx1ywL5VhMt9Jz72aAHqZIDz-nWB" />
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-8 text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg">Tin tức &amp; Chia sẻ</h1>
            <div class="w-16 h-1 bg-secondary-fixed mx-auto mb-6"></div>
            <p class="max-w-2xl mx-auto text-base md:text-lg font-medium opacity-90 drop-shadow-md">Khám phá văn hóa ẩm thực vùng biển Hạ Long, những câu chuyện về nghề mắm truyền thống và bí quyết chế biến món ngon mỗi ngày.</p>
        </div>
    </section>

    <!-- Categories Filter -->
    <section class="sticky top-[72px] z-40 bg-surface/95 backdrop-blur-sm border-b border-outline-variant/15 py-6">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex items-center justify-center gap-4 overflow-x-auto no-scrollbar">
                <?php
                // Display categories as filter buttons
                $categories = get_categories(array('hide_empty' => true));
                $blog_page_id = get_option('page_for_posts');
                $blog_url = $blog_page_id ? get_permalink($blog_page_id) : home_url('/');
                
                $current_cat_id = is_category() ? get_queried_object_id() : 0;
                
                // "Tất cả" button
                $is_all_active = ($current_cat_id === 0 && !is_search()) ? 'bg-primary text-white shadow-md' : 'bg-surface-container-high text-on-surface-variant hover:bg-outline-variant/20';
                echo '<a href="' . esc_url($blog_url) . '" class="px-8 py-2.5 rounded-xl font-bold transition-all whitespace-nowrap inline-flex items-center justify-center ' . esc_attr($is_all_active) . '">Tất cả</a>';

                foreach($categories as $category) {
                    $is_active = ($current_cat_id === $category->term_id) ? 'bg-primary text-white shadow-md' : 'bg-surface-container-high text-on-surface-variant hover:bg-outline-variant/20';
                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="px-8 py-2.5 rounded-xl font-bold transition-all whitespace-nowrap inline-flex items-center justify-center ' . esc_attr($is_active) . '">' . esc_html($category->name) . '</a>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- News Grid -->
    <section class="py-16 px-8 bg-surface">
        <div class="max-w-7xl mx-auto">
            <?php if (have_posts()) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="group cursor-pointer bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                            <a href="<?php the_permalink(); ?>" class="relative aspect-[4/3] overflow-hidden block">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img alt="<?php the_title_attribute(); ?>"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                        src="<?php the_post_thumbnail_url('medium_large'); ?>" />
                                <?php else : ?>
                                    <div class="w-full h-full bg-surface-variant flex items-center justify-center text-on-surface-variant">Không có ảnh</div>
                                <?php endif; ?>
                                
                                <?php
                                $article_categories = get_the_category();
                                if (!empty($article_categories)) {
                                    echo '<div class="absolute top-4 left-4 bg-primary text-white px-3 py-1 text-xs font-bold rounded-lg uppercase tracking-widest">' . esc_html($article_categories[0]->name) . '</div>';
                                }
                                ?>
                            </a>
                            <div class="p-6 space-y-3 flex-grow flex flex-col">
                                <time class="text-secondary text-sm font-bold" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                                <a href="<?php the_permalink(); ?>">
                                    <h3 class="text-2xl font-bold text-on-surface group-hover:text-primary transition-colors leading-tight">
                                        <?php the_title(); ?>
                                    </h3>
                                </a>
                                <p class="text-on-surface-variant line-clamp-3">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                </p>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <?php mthl_pagination(); ?>

            <?php else : ?>
                <!-- Empty State Section -->
                <section class="py-24 px-8 max-w-4xl mx-auto">
                    <div class="bg-surface-container-lowest p-12 md:p-20 flex flex-col items-center text-center">
                        <!-- Illustrative Icon -->
                        <div class="relative mb-8">
                            <div class="w-32 h-32 bg-surface-container-high rounded-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-6xl text-outline-variant"
                                    data-icon="description">description</span>
                            </div>
                            <div
                                class="absolute -bottom-2 -right-2 w-12 h-12 bg-secondary-container rounded-full flex items-center justify-center shadow-lg border-4 border-surface-container-lowest">
                                <span class="material-symbols-outlined text-on-secondary-container text-2xl font-bold"
                                    data-icon="search">search</span>
                            </div>
                        </div>
                        <!-- Empty State Content -->
                        <h2 class="text-3xl font-headline font-bold text-on-surface mb-4">
                            Hiện chưa có bài viết nào
                        </h2>
                        <p class="text-on-surface-variant text-lg max-w-md mx-auto mb-10 leading-relaxed">
                            Chúng tôi sẽ sớm cập nhật những tin tức mới nhất về ẩm thực và di sản Hạ Long. Quý khách vui lòng
                            quay lại sau.
                        </p>
                        <!-- Action Button -->
                        <a class="inline-flex items-center gap-2 bg-primary text-on-primary px-8 py-4 rounded-lg font-bold hover:scale-105 active:scale-95 transition-all duration-300 shadow-xl shadow-primary/10 group"
                            href="<?php echo esc_url(home_url('/')); ?>">
                            <span class="material-symbols-outlined text-xl" data-icon="arrow_back">arrow_back</span>
                            Quay lại Trang chủ
                        </a>
                    </div>
                    <!-- Decorative Elements -->
                    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 opacity-40">
                        <div class="h-[1px] bg-gradient-to-r from-transparent via-outline-variant to-transparent"></div>
                        <div class="text-center italic font-headline text-secondary">Hương vị di sản vùng vịnh</div>
                        <div class="h-[1px] bg-gradient-to-r from-transparent via-outline-variant to-transparent"></div>
                    </div>
                </section>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
