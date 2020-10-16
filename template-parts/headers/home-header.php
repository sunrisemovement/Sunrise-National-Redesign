<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sunrise_National
 */

?>

<header class="entry-header post-header">
	<div class="alignwide">
		<div class="row header-row <?php if(get_field('header_embed') || get_the_post_thumbnail()){
				echo ""; }
				else {
				echo "";
			}?>">
				<div class="header-blocks header-content col-md-7">
					<?php if(get_field('secondary_header')): ?>
						<div class="h1-subhead-row">
							<h4 class="h1-subhead">
								<b>
									<?php echo get_field('secondary_header'); ?>
								</b>
							</h4>
						</div>
					<?php endif?>
					<h1 class="display-type entry-title">
						<?php echo get_field('home_title'); ?>
					</h1>
					<div class="entry-description">
						<?php echo get_field('home_description'); ?>
					</div>
					<?php //the_title( '<h1 class="entry-title"><b>', '</b></h1>' ); ?>
					<div class="button-row">
						<?php if(get_field('button_1_url')): ?>
							<a href="<?php echo get_field('button_1_url'); ?>"><button class="header-button btn has-sunrise-white-background-color ">
								<?php echo get_field('button_1_text'); ?>
							</button></a>
						<?php endif?>
						<?php if(get_field('button_2_url')): ?>
							<a href="<?php echo get_field('button_2_url'); ?>"><button class="header-button btn has-sunrise-gold-background-color">
								<?php echo get_field('button_2_text'); ?>
							</button></a>
						<?php endif?>
					</div>
				</div>
		</div>
	</div>
		<?php if(wp_is_mobile()): ?>
				<div class="header-background-image">
			<div class="header-background-image">
			<img src="<?php echo get_field('header_image'); ?>" />
		</div>
		</div>
	<?php elseif(get_field('header_embed')): ?>
				<div class="header-background-image video">
				<div class="header-blocks header-media">
					<iframe src="<?php echo get_field('header_embed'); ?>?autoplay=1&loop=1&autopause=0" width="640" height="360" frameborder=“0” allowfullscreen allow=autoplay></iframe>
			
				</div>
			</div>
		<?php elseif(get_field('header_image')): ?>
				<div class="header-background-image">
			<div class="header-background-image">
			<img src="<?php echo get_field('header_image'); ?>" />
		</div>
		</div>
		<?php endif?>

</header><!-- .entry-header -->
