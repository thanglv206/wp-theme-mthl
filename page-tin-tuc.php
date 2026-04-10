<?php get_header(); ?>
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 9,
    'paged' => $paged,
);
$news_query = new WP_Query($args);
?>
<section class="mt-6 lg:mt-10 md:pt-0 pb-10">
    <h1 class="hidden">Danh sách tin tức mới nhất | <?php bloginfo('name'); ?></h1>
    <div class="container px-4 mx-auto">
        <div class="grid grid-cols-12 gap-8 md:gap-4">
            <div class="col-span-12 md:col-span-12 xl:col-span-12 space-y-4">
                <?php if ($news_query->have_posts()) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
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
                                    <span>Đăng vào <?php echo get_the_date(); ?></span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <div class="mt-8">
                        <?php
                        echo paginate_links(array(
                            'total' => $news_query->max_num_pages,
                            'prev_text'    => __('&laquo;'),
                            'next_text'    => __('&raquo;'),
                            'type'         => 'list',
                        ));
                        ?>
                    </div>
                <?php else : ?>
                    <div class="bg-milano-bgSecondary border-l-4 border-milano-secondary text-yellow-700 p-4" role="alert">
                        <p class="font-bold text-milano-secondary">Không có kết quả</p>
                        <p>Hiện tại không có bài viết nào mới, vui lòng quay lại sau</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
