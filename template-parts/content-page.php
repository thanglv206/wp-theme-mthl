<?php
/**
 * Template part for displaying page content in page.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white p-6 md:p-10 shadow rounded-lg'); ?>>
	<header class="entry-header mb-8 pb-4 border-b">
		<?php the_title( '<h1 class="entry-title text-4xl font-bold">', '</h1>' ); ?>
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
