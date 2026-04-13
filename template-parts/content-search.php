<?php
/**
 * Template part for displaying results in search pages
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white shadow rounded-lg overflow-hidden flex flex-col'); ?>>
	<div class="p-6 flex-grow flex flex-col">
		<header class="entry-header mb-4">
			<?php the_title( sprintf( '<h2 class="entry-title text-xl font-bold"><a href="%s" rel="bookmark" class="hover:text-blue-600">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta text-sm text-gray-500 mt-2">
					<?php echo get_the_date(); ?>
				</div>
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary text-gray-700 flex-grow">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
