<?php
/**
 * Template part for displaying a message that posts cannot be found
 */
?>

<section class="no-results not-found bg-white p-8 shadow rounded-lg text-center">
	<header class="page-header mb-6">
		<h1 class="page-title text-3xl font-bold"><?php esc_html_e( 'Nothing Found', 'mthl' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content text-gray-700">
		<?php if ( is_search() ) : ?>
			<p class="mb-6"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mthl' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p class="mb-6"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mthl' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
