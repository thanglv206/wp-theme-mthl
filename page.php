<?php get_header(); ?>
    <section class="pt-4 md:pt-0 pb-10">
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-12 gap-8 md:gap-4">
                <div class="hidden lg:block col-span-2">
                    <?php get_template_part('template-parts/sider'); ?>
                </div>
                <div class="col-span-12 md:col-span-8 lg:col-span-7 space-y-4">
                    <?php if (trim(get_the_content())) : ?>
                        <div class="rounded-md text-justify">
                            <div><?= the_content() ?></div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-span-12 md:col-span-4 lg:col-span-3">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>