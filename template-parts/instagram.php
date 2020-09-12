<?php
/**
 * Displays the instagram section
 *
 * @package SunriseNational
 * @subpackage Sunrise_National
 *
 */

?>
<div class="instagram-section">
	<div class="container">
			<div class="row">
				<h3>  <?php sunrisenational_the_theme_svg( 'instagram', 'social' ); ?> Instagram Updates</h3>
				<? echo do_shortcode('[insta-gallery id="3"]');?>
		</div>
	</div>
</div>
