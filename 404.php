<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>

<main id="primary" class="site-main max-w-7xl mx-auto px-8 pt-24 pb-16 text-center">
	<section class="error-404 not-found">
		<header class="page-header mb-8">
			<h1 class="page-title text-5xl font-bold text-gray-900 mb-4"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'mthl' ); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<p class="text-xl text-gray-600 mb-8"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'mthl' ); ?></p>
			<div class="max-w-md mx-auto">
				<?php get_search_form(); ?>
			</div>
		</div><!-- .page-content -->
	</section><!-- .error-404 -->
</main><!-- #main -->

<?php
get_footer();
