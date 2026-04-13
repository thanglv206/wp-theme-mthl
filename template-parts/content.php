<?php
/**
 * Template part for displaying posts
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white shadow rounded-lg overflow-hidden flex flex-col'); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail aspect-video">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover')); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="p-6 flex-grow flex flex-col">
		<header class="entry-header mb-4">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title text-3xl font-bold">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title text-xl font-bold"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="hover:text-blue-600">', '</a></h2>' );
			endif;
			?>
		</header><!-- .entry-header -->

		<div class="entry-content text-gray-700 flex-grow">
			<?php
			if ( is_singular() ) :
				the_content();
			else :
				the_excerpt();
			endif;
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
