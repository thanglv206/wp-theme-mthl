<?php
/**
 * Template part for displaying single posts
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white p-6 md:p-10 shadow rounded-lg'); ?>>
	<header class="entry-header mb-8 pb-4 border-b">
		<?php the_title( '<h1 class="entry-title text-4xl font-bold mb-4">', '</h1>' ); ?>
		<div class="entry-meta text-gray-500 text-sm">
			<?php
			echo '<span class="posted-on">Posted on ' . get_the_date() . '</span> ';
			echo '<span class="byline"> by ' . get_the_author() . '</span>';
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail mb-8">
			<?php the_post_thumbnail('large', array('class' => 'w-full h-auto rounded')); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content prose max-w-none">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
