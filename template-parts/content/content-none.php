<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sunrise_National
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'sunrise-national' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<div class="row">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'sunrise-national' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p class="col"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'sunrise-national' ); ?></p>
			<div class="col text-align-right">
			<?php
			get_search_form();
			?>
			</div>
				<?php
		else :
			?>
			<div class="col ">
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'sunrise-national' ); ?></p>
			</div>
			<div class="col text-align-right">
			<?php
			get_search_form();
			?>

			</div>
			<?php
		endif;
		?>
	</div>
	</div><!-- .page-content -->
</section><!-- .no-results -->
