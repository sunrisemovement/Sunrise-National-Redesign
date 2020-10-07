<?php
/**
 * Template part for displaying header event.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sunrise_National
 */

?>

<header class="entry-header post-header<?php if( get_field('square_image')): ?> square 	<?php endif?>">
		<div class="container">
			<div class="row header-row">


			  <?php if( get_field('square_image')): ?>
				<div class="col-md-6 header-blocks square header-content">
				<?php else: ?>
					<div class="col-md-6 header-blocks header-content">
				<?php endif?>

						<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );}?>


						<?php if( get_field('event_title')): ?>
							<h1 class="entry-title h2">	<?php echo get_field('event_title'); ?> </h1>
						<?php else: ?>
								<?php the_title( '<h1 class="entry-title h2">', '</h1>' ); ?>
						<?php endif?>

						<?php echo get_field('event_start_string'); ?>
							<?php if(get_field('dates')): ?>
								<h3 class="dates">
									<?php echo get_field('dates'); ?>
									<?php if(get_field('times')): ?>
										 @ <?php echo get_field('times'); ?> EST
									<?php endif?>
								</h3>
							<?php elseif( get_field('event_start_string')): ?>
									<h3 class="dates"><?php echo get_field('event_start_string'); ?> 	<?php echo get_field('event_end_string'); ?> EST</h3>
							<?php else: ?>
								<h3 class="dates"><?php echo get_field('event_start_date'); ?> EST</h3>
							<?php endif?>
							<?php if( get_field('event_type')): ?>
								<div class="h1-subhead">
									<?php echo get_field('event_type'); ?>
								</div>
							<?php endif?>

						<div class="button-row">
							<?php if(get_field('button_1_url')): ?>
								<a href="<?php echo get_field('button_1_url'); ?>"><button class="header-button  yellow">
									<?php echo get_field('button_1_text'); ?>
								</button></a>
							<?php endif?>
							<?php if(get_field('button_2_url')): ?>
								<a href="<?php echo get_field('button_2_url'); ?>"><button class="header-button  btn-light">
									<?php echo get_field('button_2_text'); ?>
								</button></a>
							<?php endif?>
						</div>
					</div>




					<?php if( get_field('square_image')): ?>
					<div class="col-md-4 offset-md-2 header-blocks square  header-media">
					<?php else: ?>
						<div class="col-md-6 header-blocks header-media">
					<?php endif?>

						<?php if (get_field('header_embed')){ ?>
							<iframe class="video" width="560" height="315" align="bottom" src="<?php echo get_field('header_embed'); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						<?php } ?>
						<?php if (get_the_post_thumbnail()){ ?>
							<div class="post-thumbnail">
								<?php echo the_post_thumbnail('large'); ?>
							</div><!-- .post-thumbnail -->
						<?php } ?>

					</div>
				</div>
			</div>

		<div class="header-background-image">
			<?php if (get_field('header_image')){ ?>
				<img src="<?php echo get_field('header_image'); ?>" />
			<?php } ?>
		<?php if (get_field('featured_image_url')) { ?>
					<img src="<?php echo get_field('featured_image_url'); ?>" />
			<?php } ?>
		</div>

</header><!-- .entry-header -->
