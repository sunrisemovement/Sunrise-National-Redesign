<?php
/**
 * Template Name: Cover Template
 * Template Post Type: post, page
 *
 * @package Sunrise_National
 * @subpackage Twenty_Twenty
 * 
 */

get_header();
?>

<main id="site-content" role="main">

	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content/content-cover' );
		}
	}

	?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
