<?php
/**
 * Post template for Custom Post Type block
 */
$base_class = esc_attr($extra_attr['block_name']);

$postType = get_post_type_object(get_post_type());

?>
<a class=" card" href="<?php echo get_the_permalink();?>">
<div class=" <?php echo $base_class; ?>__post-wrapper">
  <div class="card-img">
    <?php if(get_the_post_thumbnail()): ?>
      <div class="post-thumbnail">
        <?php the_post_thumbnail('medium'); ?>
      </div><!-- .post-thumbnail -->
    <?php else:?>
      <img class="" src="<?php echo get_template_directory_uri(); ?>/assets/img/event-card.jpg" />
    <?php endif?>
  </div>
    <div class="card-body <?php echo $base_class; ?>__content-wrapper">
     <div class="card-type" >
        <?php  if ($postType) {
          echo esc_html($postType->labels->name);
        }
        ?></div>
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
