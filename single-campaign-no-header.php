<?php
/**
 * Template Name: No Header
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *  Template Post Type: campaign
 * @package Sunrise_National
 */

get_header();
?>
<div class="campaign-single ">
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
</div>
<?php
get_footer();
