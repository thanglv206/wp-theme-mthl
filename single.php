<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

<main id="primary" class="site-main pt-24 pb-20 max-w-7xl mx-auto px-8">
	<div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">
		<!-- Main Content Area: 2/3 -->
		<div class="lg:col-span-2">
			<?php
			while (have_posts()):
				the_post();

				// Custom Breadcrumbs for Single Post
				$blog_page_id = get_option('page_for_posts');
				$blog_title = $blog_page_id ? get_the_title($blog_page_id) : 'Tin tức';
				$blog_link = $blog_page_id ? get_permalink($blog_page_id) : home_url('/tin-tuc');
				?>
				<!-- Breadcrumb -->
				<nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-sm text-on-surface-variant mb-12">
					<a class="hover:text-primary transition-colors" href="<?php echo esc_url(home_url('/')); ?>">Trang
						chủ</a>
					<span class="material-symbols-outlined text-xs">chevron_right</span>
					<a class="hover:text-primary transition-colors"
						href="<?php echo esc_url($blog_link); ?>"><?php echo esc_html($blog_title); ?></a>
					<span class="material-symbols-outlined text-xs">chevron_right</span>
					<span
						class="text-on-surface font-medium truncate max-w-[200px] md:max-w-none"><?php the_title(); ?></span>
				</nav>
				<?php
				get_template_part('template-parts/content', 'single');

				// If comments are open or we have at least one comment, load up the comment template.
				// if ( comments_open() || get_comments_number() ) :
				// 	comments_template();
				// endif;
			endwhile; // End of the loop.
			?>
		</div>

		<!-- Sidebar Area: 1/3 -->
		<div class="lg:col-span-1">
			<?php
			// Related News
			$categories = get_the_category();
			if (!empty($categories)) {
				$category_id = $categories[0]->term_id;
				$related_args = array(
					'cat' => $category_id,
					'posts_per_page' => 4,
					'post__not_in' => array(get_the_ID()),
				);
				$related_query = new WP_Query($related_args);

				if ($related_query->have_posts()):
					?>
					<!-- Related News -->
					<div class="sticky top-[100px]">
						<h2
							class="text-2xl font-bold text-primary mb-8 border-b border-outline-variant/30 pb-4 flex items-center justify-between">
							Tin bài liên quan
							<?php
							$cat_link = get_category_link($category_id);
							?>
							<a class="text-sm font-semibold text-secondary hover:underline flex items-center gap-1"
								href="<?php echo esc_url($cat_link); ?>">
								Xem tất cả <span class="material-symbols-outlined text-xs">arrow_forward</span>
							</a>
						</h2>
						<div class="flex flex-col gap-8">
							<?php
							while ($related_query->have_posts()):
								$related_query->the_post();
								$rel_categories = get_the_category();
								$rel_cat_name = !empty($rel_categories) ? $rel_categories[0]->name : 'Tin tức';
								?>
								<!-- Card -->
								<div class="group cursor-pointer" onclick="window.location.href='<?php the_permalink(); ?>';">
									<div class="aspect-[4/3] overflow-hidden rounded-xl bg-surface-container-low mb-4">
										<?php if (has_post_thumbnail()): ?>
											<?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500')); ?>
										<?php else: ?>
											<img src="https://placehold.co/600x400?text=No+Image"
												class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
												alt="No image placeholder">
										<?php endif; ?>
									</div>
									<span
										class="text-xs font-bold text-secondary tracking-widest uppercase"><?php echo esc_html($rel_cat_name); ?></span>
									<h3
										class="text-lg font-bold mt-2 group-hover:text-primary transition-colors line-clamp-2 leading-tight">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
								</div>
							<?php endwhile;
							wp_reset_postdata(); ?>
						</div>
					</div>
					<?php
				endif;
			}
			?>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
