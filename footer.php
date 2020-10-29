<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sunrise_National
 */

?>

	</div><!-- #content -->

	<?php
		get_template_part( 'template-parts/footer/nav-blocks', '' );
	?>
<footer id="site-footer" role="contentinfo" class="header-footer-group">

	<div class="section-inner row">

		<div class="footer-left col-md">
			<?php
			$has_footer_top = has_nav_menu( 'footer-top' );
			$has_footer_left = has_nav_menu( 'footer-left' );
			$has_footer_right = has_nav_menu( 'footer-right' );

			// Only output the container if there are elements to display.
			if ( $has_footer_top  || $has_footer_left || $has_footer_right   ) {
				?>

				<div class="footer-nav-widgets-wrapper header-footer-group">

					<div class="footer-inner section-inner">

							<aside class="footer-widgets-outer-wrapper" role="complementary">

								<div class="footer-widgets-wrapper">

									<?php if ( $has_footer_top ) { ?>
										<div class="row">
											<div class="footer-widgets footer-top col-md grid-item">
												<?php
												wp_nav_menu(
													array(
														'container'      => '',
														'depth'          => 1,
														'items_wrap'     => '%3$s',
														'theme_location' => 'footer-top',
													)
												);
												?>
											</div>
										</div>

									<?php } ?>

									<?php if ( $has_footer_right ) { ?>
										<div class="row">
											<div class="footer-widgets col-lg-5 col-6  grid-item">
												<?php
												wp_nav_menu(
													array(
														'container'      => '',
														'depth'          => 1,
														'items_wrap'     => '%3$s',
														'theme_location' => 'footer-left',
													)
												);
												?>
											</div>

										<?php } ?>

										<?php if ( $has_footer_left ) { ?>

											<div class="footer-widgets col-lg-5 col-6 grid-item">
												<?php
												wp_nav_menu(
													array(
														'container'      => '',
														'depth'          => 1,
														'items_wrap'     => '%3$s',
														'theme_location' => 'footer-right',
													)
												);
												?>
											</div>
										</div>

									<?php } ?>

								</div><!-- .footer-widgets-wrapper -->

							</aside><!-- .footer-widgets-outer-wrapper -->

					</div><!-- .footer-inner -->

				</div><!-- .footer-nav-widgets-wrapper -->

			<?php } ?>
		</div>

		<div class="footer-right col-md">
			<a class="to-the-top row" href="#masthead">
				<div class="to-the-top-long col-md">
					<?php
					/* translators: %s: HTML character for up arrow. */
					printf( __( 'To the top %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
					?>
				</div><!-- .to-the-top-long -->
			</a><!-- .to-the-top -->
			<?php
			$has_social_menu = has_nav_menu( 'social' );
			if ( $has_social_menu ) { ?>

				<nav aria-label="<?php esc_attr_e( 'Social links', 'sunrisenational' ); ?>" class="footer-social-wrapper">

					<ul class="social-menu footer-social reset-list-style social-icons fill-children-current-color">

						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'social',
								'container'       => '',
								'container_class' => '',
								'items_wrap'      => '%3$s',
								'menu_id'         => '',
								'menu_class'      => '',
								'depth'           => 1,
								'link_before'     => '<span class="screen-reader-text">',
								'link_after'      => '</span>',
								'fallback_cb'     => '',
							)
						);
						?>

					</ul><!-- .footer-social -->

				</nav><!-- .footer-social-wrapper -->

			<?php } ?>

			<div class="footer-pac">
				PAC-related content on this website is paid for by Sunrise PAC, 50 F Street NW STE #700, Washington, DC 20001. Not authorized by any candidate or candidate's committee.
			</div>

			<p class="footer-copyright">&copy;
				<?php
				echo date_i18n(
					/* translators: Copyright date format, see https://www.php.net/date */
					_x( 'Y', 'copyright date format', 'twentytwenty' )
				);
				?>
				Sunrise Movement
			</p><!-- .footer-copyright -->

	</div>

	</div><!-- .section-inner -->
	<script src="https://secure.actblue.com/cf/assets/actblue.js" async></script>
</footer><!-- #site-footer -->

<?php wp_footer(); ?>

</body>
</html>
