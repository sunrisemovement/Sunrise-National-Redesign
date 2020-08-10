<?php
/**
 * Template Name: Campaign Single
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sunrise_National
 */

get_header();
?>
<div class="campaign-single">
<?php
while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/content/campaign-page-header', '' );
	// If comments are open or we have at least one comment, load up the comment template.

endwhile; // End of the loop.
			wp_reset_postdata();
?>
		<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
			while ( have_posts() ) :
				the_post();
			get_template_part( 'template-parts/content/content', 'page' );
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php
get_footer();
