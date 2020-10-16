<?php
/**
 * The template for displaying all single posts in Post Carousel block
 */

$base_class = esc_attr($extra_attr['block_name']);

?>
  <?php if( get_field('event_source') == "mobilize"): ?>
  <a class="mobilize card" href="<?php echo get_field('url'); ?>">
  <?php else: ?>
  <a class="card everyaction" href="<?php echo get_the_permalink();?>">
  <?php endif?>
        <div class=" <?php echo $base_class; ?>__post">
    <?php if("x"==="y"): ?>
        <?php if(get_the_post_thumbnail()): ?>
          <div class="card-img">
            <?php the_post_thumbnail('large'); ?>
          </div><!-- .post-thumbnail -->
        <?php elseif (get_field('featured_image_url')): //breaking for now due to slow loading?>
            <div class="post-thumbnail">
                <img src="<?php echo get_field('featured_image_url'); ?>"/>
            </div><!-- .post-thumbnail -->
        <?php else :?>
            <div class="card-img">
              <img class="card-img-top card-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/event-card.jpg" />
            </div>
        <?php endif?>
    <?php endif?>
      <div class="card-body <?php echo $base_class; ?>__post-content-wrapper">
          <?php if( get_field('event_type')): ?>
            <div class="h1-subhead">
              <?php echo get_field('event_type'); ?>
            </div>
          <?php endif?>

          <div class="event-title <?php echo $base_class; ?>__post-header">
            <?php if( get_field('event_title')): ?>
              <?php $thetitle = get_field('event_title');
              $getlength = strlen($thetitle);
              $thelength = 70;?>
            <?php else:
              $thetitle = get_the_title(); /* or you can use get_the_title() */
              $getlength = strlen($thetitle);
              $thelength = 70;
                ?>
            <?php endif?>
                <h4 class="card-title">
                    <?php echo substr($thetitle, 0, $thelength);
                    if ($getlength > $thelength) echo "...";?>
              </h4>
          </div>
          <div class="event-timing">

            <?php if(get_field('dates')): ?>
              <span class="dates">
                <?php echo get_field('dates'); ?>
                <?php if(get_field('times')): ?>
                   @ <?php echo get_field('times'); ?>
                <?php endif?>
              </span>
            <?php elseif( get_field('event_start_string')): ?>
                <span class="dates"> <?php echo get_field('event_start_string'); ?>  </span>
            <?php else: ?>
              <?php echo get_field('event_start_date'); ?>
            <?php endif?>
          </div>
        </div>
      </div>
</a>
