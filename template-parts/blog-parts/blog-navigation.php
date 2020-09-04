<?php
/**
 * Displays the blog horizontal row
 *
 * @package SunriseNational
 * @subpackage Sunrise_National
 *
 */
 ?>
<nav class="blog-header container alignwide" aria-label="<?php esc_attr_e( 'Horizontal', 'sunrisenational' ); ?>" role="navigation">
	<div class="blog-bar row">
		<h3 class="blog-title"> <a href="">
			UPRISING NEWS
		</a>
		</h3><!-- .site-branding -->
		<ul class="blog-menu  d-none d-lg-block">
			<?php

				if (  has_nav_menu( 'blog' ) ) {
					wp_nav_menu(
						array(
							'container'  => '',
							'items_wrap' => '%3$s',
							'theme_location' => 'blog',
						)
				);
			}
			?>
		</ul>
	</div>
</nav>
