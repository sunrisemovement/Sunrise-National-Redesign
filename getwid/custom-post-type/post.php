<?php
/**
 * Post template for Custom Post Type block
 */
$base_class = esc_attr($extra_attr['block_name']);

?>

<div class="blog-list">
    <div class="content-vertical">
       <?php 			get_template_part( 'template-parts/content/content-vertical', '' ); ?>
  </div>
</div>
