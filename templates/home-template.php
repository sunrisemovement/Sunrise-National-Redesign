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
		<div class="after-content">
				<div class="section-padding">
			<?php
				get_template_part( 'template-parts/blog-parts/blog-navigation', '' );
				get_template_part( 'template-parts/blog-parts/blog-featured', '' );
			?>
			</div>
			<?php
				get_template_part( 'template-parts/instagram', '' );
			?>
			<?php
				get_template_part( 'template-parts/footer/nav-blocks', '' );
			?>
		</div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
