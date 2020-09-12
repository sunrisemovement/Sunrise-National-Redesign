<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
* Template Name: Custom Post Type
 * @package Sunrise_National
 */

get_header();
?>
<div class="post-single">
		<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main <?php if( get_field('square_image')): ?> square-image 	<?php endif?>">
			<?php
			while ( have_posts() ) :
				the_post();
			get_template_part( 'template-parts/headers/custom-post-header', '' );
			get_template_part( 'template-parts/content/content', 'page' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php
get_footer();
