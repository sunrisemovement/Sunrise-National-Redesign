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

				<?php if(get_field('header_embed')): ?>
				<div class="col-md-6 header-blocks header-media order-sm-1 ">
					<iframe class="video" width="560" height="315" align="bottom" src="<?php echo get_field('header_embed'); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				<?php elseif(get_the_post_thumbnail()): ?>
					<div class="col-md-6 header-blocks header-media order-sm-2 order-sm-2">
						<div class="post-thumbnail">
							<?php the_post_thumbnail('large'); ?>
						</div><!-- .post-thumbnail -->
					</div>
					<?php endif?>

				<div class="col-md-6 header-blocks header-text order-sm-1 ">
					<?php if(get_field('secondary_header')): ?>
						<h4 class="h1-subhead">
							<?php echo get_field('secondary_header'); ?>
						</h4>
					<?php endif?>
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						<div class="button-row">
						<?php if(get_field('button_1_url')): ?>
							<a href="<?php echo get_field('button_1_url'); ?>"><button class="header-button yellow">
							<?php echo get_field('button_1_text'); ?>
						</button></a>
							<?php endif?>
							<?php if(get_field('button_2_url')): ?>
								<a href="<?php echo get_field('button_2_url'); ?>"><button class="header-button btn-light">
								<?php echo get_field('button_2_text'); ?>
							</button></a>
								<?php endif?>
							</div>
					</div>
									</div>
</div>
<div class="header-background-image">
<?php if(get_field('header_image')): ?>
<div class="header-image">
<img src="<?php echo get_field('header_image'); ?>" />
<?php endif?>
</div>
</div>

</header><!-- .entry-header -->
