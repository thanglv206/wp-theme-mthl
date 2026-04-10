<?php get_header(); ?>

    <section class="pt-4 lg:pt-0 pb-10">
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 space-y-4">
                    <h1 class="text-3xl font-bold mb-6 text-milano-textDarkPrimary">Kết quả tìm kiếm cho: <?php echo get_search_query(); ?></h1>
                    <?php if (have_posts()) : ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                            <?php while (have_posts()) : the_post(); ?>
                                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                                    <a href="<?php the_permalink(); ?>" class="block">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img class="w-full h-48 object-cover" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                    </a>
                                    <div class="p-4">
                                        <h2 class="text-xl font-semibold mb-2">
                                            <a href="<?php the_permalink(); ?>" class="hover:text-blue-600"><?php the_title(); ?></a>
                                        </h2>
                                        <p class="text-gray-600"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                    </div>
                                    <div class="p-4 border-t border-gray-200 text-sm text-gray-500">
                                        <span>Posted on <?php echo get_the_date(); ?></span>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>

                        <div class="mt-8">
                            <?php
                            // Pagination
                            the_posts_pagination([
                                'mid_size' => 2,
                                'prev_text' => __('&laquo; Previous', 'textdomain'),
                                'next_text' => __('Next &raquo;', 'textdomain'),
                                'screen_reader_text' => __('Posts navigation', 'textdomain'),
                            ]);
                            ?>
                        </div>
                    <?php else : ?>
                        <div class="bg-milano-bgSecondary border-l-4 border-milano-secondary text-yellow-700 p-4" role="alert">
                            <p class="font-bold text-milano-secondary">Không có kết quả</p>
                            <p>Rất tiếc, không có bài viết nào liên quan từ khoá bạn đang tìm kiếm. Bạn thử tìm kiếm lại xem sao</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>