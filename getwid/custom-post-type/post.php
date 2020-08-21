<?php
/**
 * Post template for Custom Post Type block
 */

$base_class = esc_attr($extra_attr['block_name']);

?>
<a class=" card" href="<?php echo get_the_permalink();?>">
<div class=" <?php echo $base_class; ?>__post-wrapper">
  <div class="card-img">
    <?php if (has_post_thumbnail()): ?>
      <?php if(get_field('header_image')): ?>
      <img class="" src="<?php echo get_field('header_image'); ?>" />
    <?php else:?>
      <img class="" src="<?php echo get_template_directory_uri(); ?>/assets/img/event-card.jpg" />
    <?php endif?>
    <?php endif; ?>
  </div>
    <div class="card-block <?php echo $base_class; ?>__content-wrapper">
        <div class="<?php echo $base_class; ?>__post-header">
            <?php the_title( '<h3 class="'.$base_class.'__post-title">', '</h3>' ); ?>
        </div>
        <div class="excerpt <?php echo $base_class; ?>__post-excerpt"><?php
            the_excerpt();
        ?></div>
          <button class="">
            Learn More
          </button>
    </div>
</div>
</a>
