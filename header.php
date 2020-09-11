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
	<style> :root {
		--color-primary-brand: #FFDE16;

		--color-text: #33342e;
		​
		--color-secondaryText: #657287;
		​
		--color-error: #DB0A5B;
		​
		--color-background: #FFF;
		​
		--color-subtle-background: #F7F8FA;
		​
		--color-success: #00AB4C;
		​
		--color-link: #0078AB;
		​
		/* Form options */
		​
		--form-padding: 1.5rem;
		​
		--border-radius: 4px;
		​
		/* Border around entire form */
		​
		--form-border: 1px solid #E6E9ED;
		​
		/* Form header and footer areas */
		​
		--form-header-footer-background: #FFF;
		​
		--form-header-footer-border-color: #E6E9ED;
		​
		/* Advance button: continue, donate, etc. */
		​
		--advance-button-background-color: var(--color-primary-brand);
		​
		--advance-button-color: #FFF;
		​
		--advance-button-border: 0;
		​
		--advance-button-font-weight: bold;
		​
		--advance-button-text-transform: none;
		​
		--advance-button-font-size: 1rem;
		​
		/* Selectable buttons: amounts, recurring, etc. */
		​
		--select-button-color-text: var(color-text);
		​
		--select-button-color-background: #E6E9ED;
		​
		--select-button-border: 0;
		​
		--select-button-font-weight: bold;
		​
		--select-button-text-transform: none;
		​
		--select-button-font-size: 1rem;
		​
		--select-button-selected-color-text: var(--color-text);
		​
		--select-button-selected-color-background: var(--color-primary-brand);
		​
		--select-button-selected-border: 0;
		​
		/* Input fields */
		​
		--input-background-color: #FFF;
		​
		--input-border-size: 1px;
		​
		--input-border-color: #657287;
		​
		--input-border-focus-color: var(--color-primary-brand);
		​
		--input-color: var(--color-text);
		​
		--input-label-color: var(--color-primary-brand);
		​
		--input-color-placeholders: #657287;
	} </style>
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700;900&family=Source+Serif+Pro:ital,wght@0,400;1,700&display=swap" rel="stylesheet">
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
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/sunrise-logo.svg" width="" height="" alt="Sunrise Movement Logo" />
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
