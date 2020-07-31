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

					<div class="header-navigation-wrapper">

						<nav class="header-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'sunrisenational' ); ?>" role="navigation">
							<div class="top-menu">
							<ul class="header-menu secondary-menu">
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
						</div>
							<div class="bottom-menu">
								<div class="site-branding">
									<?php
										the_custom_logo();
										if ( is_front_page() && is_home() ) :
									?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
									<?php
										else :
									?>
									<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
									<?php
										endif;
									?>
								</div><!-- .site-branding -->
								<ul class="header-menu primary-menu">
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
							</div>

						</nav><!-- .primary-menu-wrapper -->
						<div class="header-toggles hide-no-js">

							<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">

								<button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
									<span class="toggle-inner">
										<span class="toggle-text"><?php _e( 'Menu', 'sunrisenational' ); ?></span>
										<span class="toggle-icon">
											<?php sunrisenational_the_theme_svg( 'ellipsis' ); ?>
										</span>
									</span>
								</button><!-- .nav-toggle -->

							</div><!-- .nav-toggle-wrapper -->
					</div><!-- .header-navigation-wrapper -->
				</div><!-- .header-inner -->
			</div>
		</header><!-- #masthead -->
		<?php
		// Output the menu modal.
		get_template_part( 'template-parts/modal-menu' );
		?>


		<div id="content" class="site-content">
