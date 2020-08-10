<?php
/**
 * The template for displaying all single posts in Post Carousel block
 */

$base_class = esc_attr($extra_attr['block_name']);

?>

<div class="<?php echo $base_class; ?>__post">
  <?php if(get_field('header_image')): ?>
  <img src="<?php echo get_field('header_image'); ?>" />
<?php endif?>
    <div class="<?php echo $base_class; ?>__post-content-wrapper">
        <div class="<?php echo $base_class; ?>__post-header">
            <?php the_title( '<h3 class="'.$base_class.'__post-title"><a href="'.esc_url(get_permalink()).'">', '</a></h3>' ); ?>
        </div>
        <?php if(get_field('dates')): ?>
          <h3 class="dates">
            <?php echo get_field('dates'); ?> @ <?php echo get_field('time'); ?>
          </h3>
        <?php endif?>
    </div>
</div>
