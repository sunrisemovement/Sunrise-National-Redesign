<?php
/**
* Template Name: Blog Home
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package Sunrise_National
 */

get_header();?>
		<div id="content" class="site-content blog-home">
			<?php
get_template_part( 'template-parts/blog-parts/blog-navigation' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
				<?php get_template_part( 'template-parts/blog-parts/blog-featured', '' ); ?>
				<?php get_template_part( 'template-parts/blog-parts/blog-horizontal', '' ); ?>
			<?php get_template_part( 'template-parts/instagram', '' ); ?>
			<?php get_template_part( 'template-parts/blog-parts/blog-vertical', '' ); ?>
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'page' );


			endwhile; // End of the loop.
			wp_reset_postdata();
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
