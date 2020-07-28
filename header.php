<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sunrise_National
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

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'wordpress-bootstrap-starter-theme' ); ?></a>

		<header id="masthead" class="site-header">
			<div class="header-inner section-inner">

				<div class="header-titles-wrapper">

					<div class="site-branding">
						<?php
							the_custom_logo();
							if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
							else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
							endif;
				 		?>
					</div><!-- .site-branding -->
					<div class="header-navigation-wrapper">

						<nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'sunrisenational' ); ?>" role="navigation">
							<ul class="secondary-menu reset-list-style">
								<?php
								if ( has_nav_menu( 'secondary' ) ) {
									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'secondary',
										)
									);
									}
									?>
							</ul>
							<ul class="primary-menu reset-list-style">
								<?php

									if (  has_nav_menu( 'primary' ) ) {
										wp_nav_menu(
											array(
												'container'  => '',
												'items_wrap' => '%3$s',
												'theme_location' => 'primary',
											)
									);
								}
								?>

							</ul>

						</nav><!-- .primary-menu-wrapper -->
					</div><!-- .header-navigation-wrapper -->
				</div><!-- .header-inner -->
			</div>
		</header><!-- #masthead -->


		<div id="content" class="site-content">
