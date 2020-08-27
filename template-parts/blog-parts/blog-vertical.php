<?php
/**
 * Displays the blog vertical column
 *
 * @package SunriseNational
 * @subpackage Sunrise_National
 *
 */

?>
<div class="container blog-vertical-medium-section blog-list">
		<div class="row">
			<div class="col-md-8 content-vertical">
			<?php
				$the_query = new WP_Query( array ( 'orderby' => 'rand', 'posts_per_page' => '3','post_type' => 'post', ) );
				// output the random post
				 if ( $the_query->have_posts() ) : ?>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<?php 			get_template_part( 'template-parts/content/content-vertical', '' ); ?>
				<?php endwhile;
				// Reset Post Data
				wp_reset_postdata();?>
			<?php else : ?>
			<p><?php __('No Posts'); ?></p>
			<?php endif; ?>
			</div>
			<div class="col offset-md-1">
			 embed form - replace
			</div>


	</div>
</div>
