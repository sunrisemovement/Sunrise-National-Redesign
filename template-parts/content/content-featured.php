<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sunrise_National
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>">
		<?php if(get_the_post_thumbnail()): ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail('large'); ?>
			</div><!-- .post-thumbnail -->
		<?php else:?>
			<div class="post-thumbnail">
					<img  src="<?php echo get_template_directory_uri(); ?>/assets/img/blog-card.jpg" />
			</div>
		<?php endif?>
	<header class="entry-header">
		<div class="cat-links">
			<?php $categories = get_the_category();

			if ( ! empty( $categories ) ) {
			    echo esc_html( $categories[0]->name );
			}
			?>
		</div>
			<div class="entry-title">
		<?php echo wp_trim_words( get_the_title(), 8 ); ?>
			</div>

		<h3>
			<?php echo get_field('secondary_header'); ?>
		</h3>
	</header><!-- .entry-header -->
	<?php if ( 'post' === get_post_type() ) : ?>
	<?php endif; ?>
</a>
</article><!-- #post-<?php the_ID(); ?> -->
