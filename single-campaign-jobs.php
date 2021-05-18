<?php
/**
 * Template Name: Custom-Jobs
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *  Template Post Type: campaign
 * @package Sunrise_National
 */

get_header();
?>
<div class="campaign-single jobs">
<?php
while ( have_posts() ) :
	the_post();
endwhile; // End of the loop.
			wp_reset_postdata();
?>

<header class=" jobs-header alignfull">
	<img class="jobs-header__sunrise-logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/sunrise-top-logo.png">
	<img class="jobs-header__logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/sunrise-job-logo.png">
	<div class="jobs-header__text">
		Our movement demands a Green New Deal that guarantees a good job building a sustainable, just and people powered economy to anyone who wants one.
	</div>
	<img class="jobs-header__background" src="<?php echo get_template_directory_uri(); ?>/assets/img/gradient-header.png">
	<nav class="jobs-header__nav alignwide">
		<a href="#live">Live Stream</a>
		<a href="#about">About</a>
		<a class="cta-callout" id="involved-trig" href="#get-involved">Get Involved</a>
		<a href="https://www.sunrisemovement.org/theory-of-change/what-is-a-federal-jobs-guarantee/">Job FAQ</a>
		<a href="#contact">Contact Us</a>
	</nav>

</header>


	<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
			while ( have_posts() ) :
				the_post();
			get_template_part( 'template-parts/content/content', 'page' );
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
</div>
<?php
get_footer();
