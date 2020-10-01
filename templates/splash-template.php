<?php
/**
* Template Name: Splash
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
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/assets/Santio-regular.otf" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/assets/Santio-Bold.otf" rel="stylesheet">
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'sunrise-national' ); ?></a>

<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main splash-page">

			<header class="entry-header post-header">
				<div class="container">
				<div class="row logo-bar">

							<div class="col logos">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/march.png" width="" height="" alt="" />
							</div>
							<div class="col logos">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/sunrise.png" width="" height="" alt="" />
							</div>
							<div class="col logos">
							 <img src="<?php echo get_template_directory_uri(); ?>/assets/img/count.png" width="" height="" alt="" />
							</div>
							<div class="col logos">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/dream.png" width="" height="" alt="" />
							</div>
							<div class="col logos">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/united.png" width="" height="" alt="" />
							</div>
				</div>
				<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
				<div class="row typing">
				 <div class="col-md-6  trump">
					 			Boomers Let
				 </div>

				<div class="response-strings col-md-6">

					<div id="typed-strings">

						<p>		20,100 black men shot by cops</p>
						<p>		990,100 acres burned </p>
						<p> 200,100 covid deaths </p>
							<p>		322,100 school students killed</p>
							<p>		20,100 black men shot by cops</p>
							<p>		2,100 deportations </p>

					</div>
					<span id="typed"></span>
				</div >
			</div>
				<div class="row callout">
					<h1>It's time for <span class="count-red-color"> change. </span> <br>
					</h1>
				</div>

			</div>

			</header><!-- .entry-header -->



		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content/content', 'page' );

		endwhile; // End of the loop.
		?>
		<div class="after-content">
		</div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();?>
<script>

	var typed = new Typed('#typed', {
		stringsElement: '#typed-strings',
  	typeSpeed: 90,
		shuffle: false,
		loop: true,
  	loopCount: Infinity,
		fadeOut: false,
		backDelay: 5000,
		backSpeed: 10,
		startDelay: 4

	});

</script>

<script
				 src="https://app.sunrisemovement.civicengine.com/embed.js"
				 async
 ></script>
			 <link
				 rel="stylesheet"
				 href="https://app.sunrisemovement.civicengine.com/embed.css"
			 />
