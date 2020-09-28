<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * Template Post Type: events
 * Template Name: Event
 * @package Sunrise_National
 */

get_header();
?>
<div class="event-single">
		<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main event-template <?php if( get_field('square_image')): ?> square-image <?php endif?>
			">


			<?php
			while ( have_posts() ) :
				the_post();
			get_template_part( 'template-parts/headers/event-post-header', '' );
			get_template_part( 'template-parts/content/content', 'event' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php
get_footer();
