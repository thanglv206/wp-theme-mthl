<?php
/**
 * The header for our theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'antialiased text-gray-900 bg-gray-50' ); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site min-h-screen flex flex-col">
	<a class="skip-link screen-reader-text sr-only" href="#primary"><?php esc_html_e( 'Skip to content', 'mthl' ); ?></a>

	<header id="masthead" class="site-header bg-white shadow-sm">
		<div class="container mx-auto px-4 py-4 flex justify-between items-center">
			<div class="site-branding">
				<h1 class="text-2xl font-bold">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<p class="text-sm text-gray-500"><?php bloginfo( 'description' ); ?></p>
			</div>

			<nav id="site-navigation" class="main-navigation hidden md:block">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'flex gap-6',
						'container'      => false,
					)
				);
				?>
			</nav>
		</div>
	</header><!-- #masthead -->
