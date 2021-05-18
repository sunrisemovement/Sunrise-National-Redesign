<?php
/**
* Template Name: Narrow
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sunrise_National
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main base-page">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/headers/base-page-header', '' );
      ?>
      <div class="narrow-container">
        <?php
			get_template_part( 'template-parts/content/content', 'page' );


		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
