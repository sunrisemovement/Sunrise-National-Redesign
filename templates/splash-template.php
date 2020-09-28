<?php
/**
* Template Name: Splash
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'sunrise-national' ); ?></a>

		<header id="masthead" class="site-header">
		</header>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main splash-page">

			<div class="element">
				example
			</div>
		<?php
			get_template_part( 'template-parts/headers/splash-header', '' );
		?>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content/content', 'page' );

		endwhile; // End of the loop.
		?>
		<div class="after-content">
		</div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
