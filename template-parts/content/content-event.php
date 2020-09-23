<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sunrise_National
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php if( get_field('action_tag')): ?>
			<script type="text/javascript" src="https://d1aqhv4sn5kxtx.cloudfront.net/actiontag/at.js"></script><div class="ngp-form" data-form-url="<?php echo get_field('action_tag'); ?>
		<?php else: ?>
			<?php echo get_field('form_tracking_id'); ?>
			<?php echo get_field('event_start_date'); ?>
			<?php echo get_field('event_type'); ?>
			<?php echo get_field('event_title'); ?>
			<?php echo get_field('url'); ?>
			<?php echo get_field('status'); ?>
		<?php endif?>
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sunrise-national' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
