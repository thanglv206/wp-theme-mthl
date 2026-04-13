<?php
/**
 * The template for displaying the footer
 */
?>
	<footer id="colophon" class="site-footer mt-auto bg-gray-800 text-white py-8">
		<div class="container mx-auto px-4 text-center">
			<div class="site-info">
				<p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
