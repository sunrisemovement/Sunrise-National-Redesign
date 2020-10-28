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

	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700;900&family=Source+Serif+Pro:ital,wght@0,400;1,700&display=swap" rel="stylesheet">
	<!--tiktok pixel tracking code-->
	<script>
	  (function() {
		var ta = document.createElement('script'); ta.type = 'text/javascript'; ta.async = true;
		ta.src = 'https://analytics.tiktok.com/i18n/pixel/sdk.js?sdkid=BTUHCLGRQH54JI5RLS70';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ta, s);
	  })();
	</script>
	<meta name="facebook-domain-verification" content="e4adyjw30pdtot2gm4mtm4vcpvimxc" />
	<!-- The script tag needs to be included once per page where embeds appear. Putting it in the <head> tag will be fastest. -->
	<?php if(get_field('js-header')){
		echo get_field('js-header');
	}?>
	<style href="<?php bloginfo('template_url'); ?>/assets/css/actblue.css"></style>
	<script>window.actBlueConfig = {styleSheetHref: "https://raw.githubusercontent.com/sunrisemovement/extra-files/main/actblue.css"};</script>
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'sunrise-national' ); ?></a>

		<header id="masthead" class="site-header">
			<div class="header-inner section-inner">

				<div class="header-titles-wrapper">

					<div class="header-navigation-wrapper">

						<nav class="header-menu-wrapper " aria-label="<?php esc_attr_e( 'Horizontal', 'sunrisenational' ); ?>" role="navigation">
							<div class="top-menu d-none d-md-flex">
								<ul class="secondary-menu header-menu top">
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

								<?php if ( has_nav_menu( 'social' ) ) { ?>
									<nav class="social-menu" aria-label="<?php esc_attr_e( 'Expanded Social links', 'sunrisenational' ); ?>" role="navigation">
										<ul class="social-menu reset-list-style social-icons fill-children-current-color">

											<?php
											wp_nav_menu(
												array(
													'theme_location'  => 'social',
													'container'       => '',
													'container_class' => '',
													'items_wrap'      => '%3$s',
													'menu_id'         => '',
													'menu_class'      => '',
													'depth'           => 1,
													'link_before'     => '<span class="screen-reader-text">',
													'link_after'      => '</span>',
													'fallback_cb'     => '',
												)
											);
											?>

										</ul>
									</nav><!-- .social-menu -->
									<?php } ?>

						</div>
							<div class="bottom-menu">
								<a href="/" class="site-branding">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/sunrise-logo.png" width="" height="" alt="Sunrise Movement Logo" />
								</a><!-- .site-branding -->
								<ul class="header-menu bottom primary-menu d-none d-md-flex">
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
								<div class="header-toggles hide-no-js d-md-none">

									<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">

										<button class="toggle nav-toggle desktop-nav-toggle btn btn-dark" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
											<span class="toggle-inner">
												<span class="toggle-icon">
													<?php sunrisenational_the_theme_svg( 'ellipsis' ); ?>
												</span>
												<span class="toggle-text"><?php _e( 'Menu', 'sunrisenational' ); ?></span>
											</span>
										</button><!-- .nav-toggle -->

									</div><!-- .nav-toggle-wrapper -->
							</div><!-- .header-navigation-wrapper -->
							</div>

						</nav><!-- .primary-menu-wrapper -->

				</div><!-- .header-inner -->
			</div>
		</header><!-- #masthead -->
			<?php
			// Output the menu modal.
			get_template_part( 'template-parts/navigation/modal-menu' );
			?>
