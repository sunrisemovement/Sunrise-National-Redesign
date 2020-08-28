<?php
/**
 * The template for displaying all single posts in Post Carousel block
 */

$base_class = esc_attr($extra_attr['block_name']);

?>
<a class="card" href="<?php echo get_the_permalink();?>">
  <div class=" <?php echo $base_class; ?>__post">
    <?php if(get_field('header_image')): ?>
      <div class="post-thumbnail">
        <?php the_post_thumbnail('medium'); ?>
      </div><!-- .post-thumbnail -->
  <?php else:?>
    <img class="card-img-top card-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/event-card.jpg" />
  <?php endif?>
      <div class="card-body <?php echo $base_class; ?>__post-content-wrapper">
          <div class="event-timing">
          <?php if(get_field('dates')): ?>
            <div class="dates">
              <?php echo get_field('dates'); ?>
            </div>
              <?php if(get_field('times')): ?>
                  <div class="times">
                <?php echo get_field('times'); ?>
                  </div>
              <?php endif?>
          <?php endif?>
        </div>
          <div class="event-title <?php echo $base_class; ?>__post-header">
              <?php the_title( '<h4 class="card-title '.$base_class.'__post-title">', '</h4>' ); ?>
          </div>
        </div>
      </div>
</a>
