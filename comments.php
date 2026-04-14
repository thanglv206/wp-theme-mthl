<?php
/**
 * The template for displaying comments
 */

if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area mt-8 md:mt-12 pt-6 md:pt-8 border-t border-outline-variant/30">
	<?php if (have_comments()): ?>
		<h2 class="comments-title text-3xl md:text-4xl font-bold text-primary mb-6">
			<?php
			$mthl_comment_count = get_comments_number();
			if ('1' === $mthl_comment_count) {
				printf(
					/* translators: 1: title. */
					esc_html__('One thought on &ldquo;%1$s&rdquo;', 'mthl'),
					'<span>' . wp_kses_post(get_the_title()) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $mthl_comment_count, 'comments title', 'mthl')),
					number_format_i18n($mthl_comment_count),
					'<span>' . wp_kses_post(get_the_title()) . '</span>'
				);
			}
			?>
		</h2>

		<ol class="comment-list space-y-8">
			<?php
			wp_list_comments(
				array(
					'style' => 'ol',
					'short_ping' => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if (!comments_open()):
			?>
			<p class="no-comments mt-4 text-gray-500 italic"><?php esc_html_e('Comments are closed.', 'mthl'); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().
	
	comment_form(array(
		'class_form' => 'mt-8 flex flex-col gap-4',
		'class_submit' => 'px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold cursor-pointer w-auto'
	));
	?>
</div><!-- #comments -->