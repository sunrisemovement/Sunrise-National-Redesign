<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sunrise_National
 */

?>

<header class="entry-header campaign-header">
		<div class="container">
			<div class="row header-row">
				<div class="col-md-6 header-blocks">
		<?php if(get_field('secondary_header')): ?>
			<h4 class="h1-subhead">
				<?php echo get_field('secondary_header'); ?>
			</h4>
		<?php endif?>
		<?php the_title( '<h1 class="entry-title h2">', '</h1>' ); ?>
		<?php if(get_field('button_url')): ?>
			<a href="<?php echo get_field('button_url'); ?>"><button class="header-button yellow">
			<?php echo get_field('button_text'); ?>
		</button></a>
			<?php endif?>
	</div>
	<div class="col-md-6 header-blocks header-media">
		<?php if(get_field('header_embed')): ?>
			<iframe class="video" width="560" height="315" align="bottom" src="<?php echo get_field('header_embed'); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			<?php endif?>
		<?php elseif(get_field('header_image')): ?>
		<img src="<?php echo get_field('header_image'); ?>" />
	<?php endif?>
	</div>

	</div>
	</div>
	<?php sunrise_national_post_thumbnail(); ?>
</header><!-- .entry-header -->
