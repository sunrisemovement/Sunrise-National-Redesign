<?php
/**
 * Displays the blog horizontal row
 *
 * @package SunriseNational
 * @subpackage Sunrise_National
 *
 */

?>
<div class="alignwide container blog-horizontal-section blog-list">
		<div class="row">

			<?php
				$the_query = new WP_Query( array ( 'orderby' => 'date',  'offset' => '5', 'order' => 'DESC', 'posts_per_page' => '4', 'post_type' => 'post' ) );
				// output the random post
				 if ( $the_query->have_posts() ) : ?>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="col-md-3">
						<?php 			get_template_part( 'template-parts/content/content-vertical', '' ); ?>
					</div>
				<?php endwhile;
				// Reset Post Data
				wp_reset_postdata();?>
			<?php else : ?>
			<p><?php __('No Posts'); ?></p>
			<?php endif; ?>


	</div>
</div>
