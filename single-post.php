<?php
/**
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Sunrise_National
 */

get_header();
get_template_part( 'template-parts/blog-parts/blog-navigation' );
?>

<div class="container">
	<div class="row">
	<div id="primary" class="content-area blog-single col-lg-9">
		<main id="main" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content/content-blog', get_post_type() );

		endwhile; // End of the loop.
		?>
		</main><!-- #main -->
	</div><!-- #primary -->
	</div>
</div>
<div class="container post-footer">
	<div class="row">
	<div class="border-gradient-sunrise col-sm-7">
		<div>
		<h4 class="post-footer-text">
			Want to start taking action to make a difference? Join one of upcoming campaigns and get involved!
		</h4>
		<a href="/take-action/"><button>
			Take Action with Sunrise
		</button></a>
			</div>
	</div>
	<div class="col post-next d-none d-md-flex">
	<?php
		$the_query = new WP_Query( array ( 'orderby' => 'rand', 'posts_per_page' => '3' ) );
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
</div>
</div>
<?php
get_footer();
?>
