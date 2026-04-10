<?php get_header(); ?>

<section class="mt-6 lg:mt-10 lg:pt-0 pb-10">
    <div class="container px-4 mx-auto">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div class="grid grid-cols-12 gap-8 md:gap-4">
                <div class="col-span-12 space-y-4">
                    <h1 class="text-3xl font-bold mb-4 text-gray-800 text-center"><?php the_title(); ?></h1>
                    <div class="mx-auto p-4 sm:p-6 lg:p-8 bg-white rounded-lg shadow-md">

                        <!-- Post Meta Information -->
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0">
                                <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', ['class' => 'h-10 w-10 rounded-full object-cover']); ?>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-700"><?php the_author(); ?></p>
                                <p class="text-sm text-gray-500">Đăng vào
                                    <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                                </p>
                            </div>
                        </div>

                        <!-- Post Content -->
                        <div class="post-content text-gray-700 space-y-4">
                            <?php the_content(); ?>
                        </div>

                    </div>
                </div>
            </div>
        <?php endwhile; endif; ?>

    </div>
</section>

<?php get_footer(); ?>


