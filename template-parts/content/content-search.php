<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sunrise_National
 */

?>
<a href="<?php echo get_permalink(); ?>" >
<article class="content-search" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-4">
		<div class="card-img">
		    <?php if(get_the_post_thumbnail()): ?>
		        <?php the_post_thumbnail('medium'); ?>
		    <?php else:?>
		      <img class="" src="<?php echo get_template_directory_uri(); ?>/assets/img/event-card.jpg" />
		    <?php endif?>
		  </div>
	</div>
	<div class="col-md-8 search-content">
		<header class="entry-header">
			<h3>
				<?php echo the_title(); ?>
			</h3>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php
				sunrise_national_posted_on();
				sunrise_national_posted_by();
				?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->


		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
</a>
