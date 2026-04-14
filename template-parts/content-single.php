<?php
/**
 * Template part for displaying single posts
 */

$categories = get_the_category();
$category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- Article Header -->
    <header class="mb-10 md:mb-12">
        <div class="flex items-center gap-4 mb-4">
            <span
                class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase">
                <?php echo esc_html($category_name); ?>
            </span>
            <time class="text-sm font-semibold text-on-surface-variant flex items-center gap-1.5"
                datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                <span class="material-symbols-outlined text-base">calendar_today</span>
                <?php echo esc_html(get_the_date()); ?>
            </time>
        </div>

        <?php the_title('<h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-primary mb-6 leading-tight tracking-tight">', '</h1>'); ?>

        <?php if (has_post_thumbnail()): ?>
            <div class="relative w-full aspect-video md:aspect-[21/9] overflow-hidden bg-surface-container-low rounded-xl">
                <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover')); ?>
            </div>
        <?php endif; ?>
    </header>

    <!-- Article Content -->
    <div class="entry-content prose prose-stone max-w-none text-on-surface/90 leading-relaxed space-y-6 md:space-y-8 text-base md:text-lg">
        <?php
        the_content();
        ?>
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->