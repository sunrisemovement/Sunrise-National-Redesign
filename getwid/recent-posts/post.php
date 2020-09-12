<?php
/**
 * Post template in Recent Posts Block
 */
$archive_year  = get_the_time('Y');
$archive_month = get_the_time('m');
$archive_day   = get_the_time('d');

$imageSize = ( ( isset($attributes['imageSize']) && $attributes['imageSize'] ) ? $attributes['imageSize'] : 'post-thumbnail');

$showTitle = isset( $attributes['showTitle'] ) && $attributes['showTitle'];
$showFeaturedImage = isset( $attributes['showFeaturedImage'] ) && $attributes['showFeaturedImage'] && has_post_thumbnail();
$showCategories = isset( $attributes['showCategories'] ) && $attributes['showCategories'] && has_category();
$showCommentsCount = isset( $attributes['showCommentsCount'] ) && $attributes['showCommentsCount'] && comments_open();
$showContent = isset( $attributes['showContent'] ) ? $attributes['showContent'] : false;
$showDate = isset( $attributes['showDate'] ) && $attributes['showDate'];
$contentLength = isset( $attributes['contentLength'] ) ? $attributes['contentLength'] : false;

/**
 *
 * @TODO:  Temporary fix wpautop
 *
 */
remove_filter('the_content', 'wpautop');

?>
<div class="blog-vertical-medium-section blog-list">

			<div class="content-vertical">

		<?php 			get_template_part( 'template-parts/content/content-vertical', '' ); ?>

</div></div>
