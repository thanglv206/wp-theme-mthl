<?php
/**
 * The main template file
 */

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-8">
	<?php
	if ( have_posts() ) :
		echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">';
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile;
		echo '</div>';
		the_posts_navigation();
	else :
		get_template_part( 'template-parts/content', 'none' );
	endif;
	?>
</main><!-- #main -->

<?php
get_footer();
