<?php
/**
 * Displays the blog featured component
 *
 * @package SunriseNational
 * @subpackage Sunrise_National
 *
 */

?>
<div class=" blog-featured-section container alignwide blog-list">
		<div class="row">

				<div class="col-lg-6 col-md-12 blog-featured-single order-lg-2">
				<?php
					$the_query = new WP_Query( array (
					'post_type' => 'post',
					'posts_per_page' => '1'
				 ) );
					// output the random post
					 if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<?php 			get_template_part( 'template-parts/content/content-featured', 'featured' ); ?>

					<?php endwhile;
					// Reset Post Data
					wp_reset_postdata();?>
				<?php else : ?>
				<p><?php __('No Posts'); ?></p>
				<?php endif; ?>
				</div>

				<div class="col-lg-3 col-md-6 blog-vertical-thumbnail-section order-lg-1">
				<?php
					$the_query = new WP_Query( array (
						'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => '6',
						'post_type' => 'post', 'offset' => "1",
					) );
					// output the random post
					 if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<?php 			get_template_part( 'template-parts/content/content-sidebar', 'sidebar' ); ?>

					<?php endwhile;
					// Reset Post Data
					wp_reset_postdata();?>
				<?php else : ?>
				<p><?php __('No Posts'); ?></p>
				<?php endif; ?>
				</div>


				<div class="col-lg-3 col-md-6 order-lg-3 ">
					<h4> Twitter Updates </h4>
					<?php
				 echo do_shortcode( '[custom-twitter-feeds]' );
				?>

				</div>
	</div>
</div>
