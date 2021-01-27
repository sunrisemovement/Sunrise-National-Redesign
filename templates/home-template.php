<?php
/**
* Template Name: Home
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sunrise_National
 */

get_header();
?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main home-page">
		<?php
			get_template_part( 'template-parts/headers/home-header', '' );
		?>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content/content', 'page' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
