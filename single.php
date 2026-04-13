<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-8 max-w-4xl">
	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content', 'single' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>
</main><!-- #main -->

<?php
get_footer();
