<?php
/**
 * Displays the blog featured component
 *
 * @package SunriseNational
 * @subpackage Sunrise_National
 *
 */

?>
<div class="container blog-featured-section">
		<div class="row">

				<div class="col-md-6 blog-featured-single order-md-2">
				<?php
					$the_query = new WP_Query( array (
					'orderby' => 'date',
					'posts_per_page' => '1',
					'category_name' => 'featured',
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

				<div class="col-md-3 blog-vertical-thumbnail-section order-md-1">
				<?php
					$the_query = new WP_Query( array (
						'orderby' => 'rand', 'posts_per_page' => '5'
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


				<div class="col-md-3 order-md-3 ">
					<h4> Twitter Updates </h4>
					<?php
				 echo do_shortcode( '[custom-twitter-feeds]' );
				?>

				</div>
	</div>
</div>
