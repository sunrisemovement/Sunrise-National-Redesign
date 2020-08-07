<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sunrise_National
 */

?>

<header class="entry-header">
		<div class="container">
			<div class="row header-row">
				<div class="col-md-6 header-blocks">
			<h4 class="h1-subhead">
				<?php echo get_secondary_title(); ?>
			</h4>
			<button class="header-button">
				This is a button
			</button>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</div>
	<div class="col-md-6 header-blocks iframe ">
		<iframe class="video" width="560" height="315" align="bottom" src="https://www.youtube.com/embed/rJiiMz0CC5U" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>

	</div>
	</div>
	<?php sunrise_national_post_thumbnail(); ?>
</header><!-- .entry-header -->
