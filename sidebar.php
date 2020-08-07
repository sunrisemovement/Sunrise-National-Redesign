<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sunrise_National
 */

?>

<aside id="secondary" class="widget-area content-sidebar">

	<?php
// the query
$the_query = new WP_Query( array(
	'posts_per_page' => 3,
));
?>

<?php if ( $the_query->have_posts() ) : ?>
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

<?php 			get_template_part( 'template-parts/content/content-sidebar', 'sidebar' ); ?>

<?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<?php else : ?>
<p><?php __('No News'); ?></p>
<?php endif; ?>

			<?php //echo do_shortcode( '[display-posts image_size="thumbnail"]' ); ?>
			<?php //dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
