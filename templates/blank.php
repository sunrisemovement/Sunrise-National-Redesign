<?php
/**
* Template Name: blank
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sunrise_National
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700;900&family=Source+Serif+Pro:ital,wght@0,400;1,700&display=swap" rel="stylesheet">
	<!--tiktok pixel tracking code-->
	<script>
	  (function() {
		var ta = document.createElement('script'); ta.type = 'text/javascript'; ta.async = true;
		ta.src = 'https://analytics.tiktok.com/i18n/pixel/sdk.js?sdkid=BTUHCLGRQH54JI5RLS70';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ta, s);
	  })();
	</script>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-PCQ8KLL');
	</script>

	<meta name="facebook-domain-verification" content="e4adyjw30pdtot2gm4mtm4vcpvimxc" />
	<!-- The script tag needs to be included once per page where embeds appear. Putting it in the <head> tag will be fastest. -->
	<?php if(get_field('js-header')){
		echo get_field('js-header');
	}?>
	<style href="<?php bloginfo('template_url'); ?>/assets/css/actblue.css"></style>
	<script>window.actBlueConfig = {styleSheetHref: "https://raw.githubusercontent.com/sunrisemovement/extra-files/main/actblue.css"};</script>
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>


	<div id="primary" class="content-area">
		<main id="main" class="site-main base-page">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content/content', 'page' );


		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
