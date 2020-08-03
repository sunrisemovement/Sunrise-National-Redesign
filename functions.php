<?php
/**
 * Sunrise National functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sunrise_National
 */

if ( ! function_exists( 'surnise_national_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function surnise_national_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Sunrise National, use a find and replace
		 * to change 'wordpress-bootstrap-starter-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wordpress-bootstrap-starter-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		function sunrise_national_menus() {

			$locations = array(
				'primary'  => __( 'Lower Desktop Horizontal Menu', 'sunrise_national' ),
				'secondary' => __( 'Top Secondary Desktop Horizontal Menu', 'sunrise_national' ),
				'mobile'   => __( 'Mobile Menu', 'sunrise_national' ),
				'footer'   => __( 'Footer Menu', 'sunrise_national' ),
				'social'   => __( 'Social Menu', 'sunrise_national' ),
			);

			register_nav_menus( $locations );
		}

		add_action( 'init', 'sunrise_national_menus' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'surnise_national_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'surnise_national_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function surnise_national_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'surnise_national_content_width', 640 );
}
add_action( 'after_setup_theme', 'surnise_national_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function surnise_national_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wordpress-bootstrap-starter-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wordpress-bootstrap-starter-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'surnise_national_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function surnise_national_scripts() {
	wp_enqueue_style( 'wordpress-bootstrap-starter-theme-style', get_stylesheet_uri() );

	// https://getbootstrap.com/docs/4.3/getting-started/download/#bootstrapcdn
	wp_enqueue_script( 'wordpress-bootstrap-starter-theme-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'wordpress-bootstrap-starter-theme-vendor-scripts', get_template_directory_uri() . '/assets/js/vendor.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'wordpress-bootstrap-starter-theme-custom-scripts', get_template_directory_uri() . '/assets/js/custom.min.js', array('customize-preview'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'surnise_national_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * REQUIRED FILES
 * Include required files.
 */

// Handle SVG icons.
require get_template_directory() . '/inc/svg-icons.php';
require get_template_directory() . '/classes/class-sunrise-svg-icons.php';
// Custom page walker.
require get_template_directory() . '/classes/class-sunrise-walker-page.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}







//Custom Post Types Temporary Home

function cptui_register_my_cpts() {

	/**
	 * Post Type: Campaigns.
	 */

	$labels = [
		"name" => __( "Campaigns", "twentytwentychild" ),
		"singular_name" => __( "campaign", "twentytwentychild" ),
		"menu_name" => __( "Campaigns", "twentytwentychild" ),
		"all_items" => __( "All Campaigns", "twentytwentychild" ),
		"add_new" => __( "Add new", "twentytwentychild" ),
		"add_new_item" => __( "Add new Campaign", "twentytwentychild" ),
		"edit_item" => __( "Edit Campaign", "twentytwentychild" ),
		"new_item" => __( "New Campaign", "twentytwentychild" ),
		"view_item" => __( "View Campaign", "twentytwentychild" ),
		"view_items" => __( "View Campaigns", "twentytwentychild" ),
		"search_items" => __( "Search Campaigns", "twentytwentychild" ),
		"not_found" => __( "No Campaigns found", "twentytwentychild" ),
		"not_found_in_trash" => __( "No Campaigns found in trash", "twentytwentychild" ),
		"parent" => __( "Parent Campaign:", "twentytwentychild" ),
		"featured_image" => __( "Featured image for this Campaign", "twentytwentychild" ),
		"set_featured_image" => __( "Set featured image for this Campaign", "twentytwentychild" ),
		"remove_featured_image" => __( "Remove featured image for this Campaign", "twentytwentychild" ),
		"use_featured_image" => __( "Use as featured image for this Campaign", "twentytwentychild" ),
		"archives" => __( "Campaign archives", "twentytwentychild" ),
		"insert_into_item" => __( "Insert into Campaign", "twentytwentychild" ),
		"uploaded_to_this_item" => __( "Upload to this Campaign", "twentytwentychild" ),
		"filter_items_list" => __( "Filter Campaigns list", "twentytwentychild" ),
		"items_list_navigation" => __( "Campaigns list navigation", "twentytwentychild" ),
		"items_list" => __( "Campaigns list", "twentytwentychild" ),
		"attributes" => __( "Campaigns attributes", "twentytwentychild" ),
		"name_admin_bar" => __( "Campaign", "twentytwentychild" ),
		"item_published" => __( "Campaign published", "twentytwentychild" ),
		"item_published_privately" => __( "Campaign published privately.", "twentytwentychild" ),
		"item_reverted_to_draft" => __( "Campaign reverted to draft.", "twentytwentychild" ),
		"item_scheduled" => __( "Campaign scheduled", "twentytwentychild" ),
		"item_updated" => __( "Campaign updated.", "twentytwentychild" ),
		"parent_item_colon" => __( "Parent Campaign:", "twentytwentychild" ),
	];

	$args = [
		"label" => __( "Campaigns", "twentytwentychild" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ "slug" => "campaign", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-megaphone",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "page-attributes", "post-formats" ],
	];

	register_post_type( "campaign", $args );

	/**
	 * Post Type: Past Wins.
	 */

	$labels = [
		"name" => __( "Past Wins", "twentytwentychild" ),
		"singular_name" => __( "past win", "twentytwentychild" ),
	];

	$args = [
		"label" => __( "Past Wins", "twentytwentychild" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "actions", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-location-alt",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "page-attributes", "post-formats" ],
	];

	register_post_type( "actions", $args );

	/**
	 * Post Type: Endorsements.
	 */

	$labels = [
		"name" => __( "Endorsements", "twentytwentychild" ),
		"singular_name" => __( "endorsement", "twentytwentychild" ),
	];

	$args = [
		"label" => __( "Endorsements", "twentytwentychild" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "our_endorsements", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-star-filled",
		"supports" => [ "title", "editor", "thumbnail", "custom-fields", "page-attributes", "post-formats" ],
	];

	register_post_type( "our_endorsements", $args );

	/**
	 * Post Type: Events/Trainings.
	 */

	$labels = [
		"name" => __( "Actions", "twentytwentychild" ),
		"singular_name" => __( "action", "twentytwentychild" ),
	];

	$args = [
		"label" => __( "actions", "twentytwentychild" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => [ "slug" => "events", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "page-attributes", "post-formats" ],
		"taxonomies" => [ "campaigns" ],
	];

	register_post_type( "events", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
