<?php
/**
 * Sunrise National functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sunrise_National
 */


if ( ! function_exists( 'sunrise_national_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sunrise_national_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Sunrise National, use a find and replace
		 * to change 'sunrise-national' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sunrise-national', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'align-wide' );
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		add_theme_support( 'align-wide' );

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
				'footer-top'   => __( 'Footer Top Button Menu', 'sunrise_national' ),
				'footer-left'   => __( 'Footer Left Menu', 'sunrise_national' ),
				'footer-right'   => __( 'Footer Right Menu', 'sunrise_national' ),
				'social'   => __( 'Social Menu', 'sunrise_national' ),
				'blog'   => __( 'Blog', 'sunrise_national' ),
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
		add_theme_support( 'custom-background', apply_filters( 'sunrise_national_custom_background_args', array(
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
add_action( 'after_setup_theme', 'sunrise_national_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sunrise_national_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'sunrise_national_content_width', 640 );
}
add_action( 'after_setup_theme', 'sunrise_national_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sunrise_national_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sunrise-national' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'sunrise-national' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'sunrise_national_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sunrise_national_scripts() {
	wp_enqueue_style( 'sunrise-national-style', get_stylesheet_uri() );

	wp_enqueue_style(
		'smvmt2020-source-serif-pro',
		'https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@400;600;700&display=swap',
		false
	);
	wp_enqueue_style(
		'smvmt2020-source-sans-pro',
		'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700;900&display=swap',
		false
	);	


	// https://getbootstrap.com/docs/4.3/getting-started/download/#bootstrapcdn
	wp_enqueue_script( 'sunrise-national-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'sunrise-national-vendor-scripts', get_template_directory_uri() . '/assets/js/vendor.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'sunrise-national-custom-scripts', get_template_directory_uri() . '/assets/js/custom.min.js', array('customize-preview'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sunrise_national_scripts' );

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



function sunrisenational_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Sidebar #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Sidebar #1', 'sunrisenational' ),
				'id'          => 'Sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the right column.', 'sunrisenational' ),
			)
		)
	);
}
add_action( 'widgets_init', 'sunrisenational_sidebar_registration' );


//Post Thumbnails
add_theme_support('post-thumbnails');


//acf

// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/inc/acf/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/inc/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return true;
}

add_filter( 'get_the_archive_title', function ($title) {
        if ( is_category() ) {
                $title = single_cat_title( '', false );
            } elseif ( is_tag() ) {
                $title = single_tag_title( '', false );
            } elseif ( is_author() ) {
                $title = '<span class="vcard">' . get_the_author() . '</span>' ;
            } elseif ( is_tax() ) { //for custom post types
                $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
            } elseif (is_post_type_archive()) {
                $title = post_type_archive_title( '', false );
            }
        return $title;
    });

function sunrise_color_palette() {
		// Editor color palette.
		add_theme_support(
				'editor-color-palette',
				array(
						array(
								'name' => esc_html__( 'Gold', 'sunrise-national' ),
								'slug' => 'sunrise-gold',
								'color' => '#ffde16'
						),
						array(
								'name' => esc_html__( 'Magenta', 'sunrise-national' ),
								'slug' => 'sunrise-magenta',
								'color' => '#8F0D56'
						),
						array(
								'name' => esc_html__( 'Grey', 'sunrise-national' ),
								'slug' => 'sunrise-grey',
								'color' => '#33342E'
						),
						array(
								'name' => esc_html__( 'Black', 'sunrise-national' ),
								'slug' => 'sunrise-black',
								'color' => '#000000'
						),
						array(
								'name' => esc_html__( 'Orange', 'sunrise-national' ),
								'slug' => 'sunrise-orange',
								'color' => '#fd9014'
						),
						array(
								'name' => esc_html__( 'Red', 'sunrise-national' ),
								'slug' => 'sunrise-red',
								'color' => '#EF4C39'
						),
						array(
								'name' => esc_html__( 'White', 'sunrise-national' ),
								'slug' => 'sunrise-white',
								'color' => '#fff'
						),
						array(
								'name' => esc_html__( 'Background Light', 'sunrise-national' ),
								'slug' => 'sunrise-background-light',
								'color' => '#FFFFFB'
						),
						array(
								'name' => esc_html__( 'Background Dark', 'sunrise-national' ),
								'slug' => 'sunrise-background-dark',
								'color' => '#F7F5E8'
						),
						array(
								'name' => esc_html__( 'Green', 'sunrise-national' ),
								'slug' => 'sunrise-green',
								'color' => '#E3EDDF'
						)
				)
		);
}

add_action( 'after_setup_theme', 'sunrise_color_palette' );


function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//Custom Post Types Temporary Home

function cptui_register_my_cpts() {

	/**
	 * Post Type: Campaigns.
	 */

	$labels = [
		"name" => __( "Campaigns", "sunrisenationalchild" ),
		"singular_name" => __( "Campaign", "sunrisenationalchild" ),
		"menu_name" => __( "Campaigns", "sunrisenationalchild" ),
		"all_items" => __( "All Campaigns", "sunrisenationalchild" ),
		"add_new" => __( "Add new", "sunrisenationalchild" ),
		"add_new_item" => __( "Add new Campaign", "sunrisenationalchild" ),
		"edit_item" => __( "Edit Campaign", "sunrisenationalchild" ),
		"new_item" => __( "New Campaign", "sunrisenationalchild" ),
		"view_item" => __( "View Campaign", "sunrisenationalchild" ),
		"view_items" => __( "View Campaigns", "sunrisenationalchild" ),
		"search_items" => __( "Search Campaigns", "sunrisenationalchild" ),
		"not_found" => __( "No Campaigns found", "sunrisenationalchild" ),
		"not_found_in_trash" => __( "No Campaigns found in trash", "sunrisenationalchild" ),
		"parent" => __( "Parent Campaign:", "sunrisenationalchild" ),
		"featured_image" => __( "Featured image for this Campaign", "sunrisenationalchild" ),
		"set_featured_image" => __( "Set featured image for this Campaign", "sunrisenationalchild" ),
		"remove_featured_image" => __( "Remove featured image for this Campaign", "sunrisenationalchild" ),
		"use_featured_image" => __( "Use as featured image for this Campaign", "sunrisenationalchild" ),
		"archives" => __( "Campaign archives", "sunrisenationalchild" ),
		"insert_into_item" => __( "Insert into Campaign", "sunrisenationalchild" ),
		"uploaded_to_this_item" => __( "Upload to this Campaign", "sunrisenationalchild" ),
		"filter_items_list" => __( "Filter Campaigns list", "sunrisenationalchild" ),
		"items_list_navigation" => __( "Campaigns list navigation", "sunrisenationalchild" ),
		"items_list" => __( "Campaigns list", "sunrisenationalchild" ),
		"attributes" => __( "Campaigns attributes", "sunrisenationalchild" ),
		"name_admin_bar" => __( "Campaign", "sunrisenationalchild" ),
		"item_published" => __( "Campaign published", "sunrisenationalchild" ),
		"item_published_privately" => __( "Campaign published privately.", "sunrisenationalchild" ),
		"item_reverted_to_draft" => __( "Campaign reverted to draft.", "sunrisenationalchild" ),
		"item_scheduled" => __( "Campaign scheduled", "sunrisenationalchild" ),
		"item_updated" => __( "Campaign updated.", "sunrisenationalchild" ),
		"parent_item_colon" => __( "Parent Campaign:", "sunrisenationalchild" ),
	];

	$args = [
		"label" => __( "Campaigns", "sunrisenationalchild" ),
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
		"name" => __( "Past Actions", "sunrisenationalchild" ),
		"singular_name" => __( "Past Action", "sunrisenationalchild" ),
	];

	$args = [
		"label" => __( "Past Actions", "sunrisenationalchild" ),
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
		"name" => __( "Endorsements", "sunrisenationalchild" ),
		"singular_name" => __( "Endorsement", "sunrisenationalchild" ),
	];

	$args = [
		"label" => __( "Endorsements", "sunrisenationalchild" ),
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
		"query_var" => true,
		"menu_icon" => "dashicons-star-filled",
		"supports" => [ "title", "editor", "thumbnail", "custom-fields", "page-attributes", "post-formats" ],
	];

add_action( 'init', 'endorsement_taxonomy', 0 );

	//create a custom taxonomy name it "type" for your posts
function endorsement_taxonomy() {

  $labels = array(
    'name' => _x( 'tatus', 'taxonomy general name' ),
    'singular_name' => _x( 'Status', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Status' ),
    'all_items' => __( 'All Status' ),
    'parent_item' => __( 'Parent Status' ),
    'parent_item_colon' => __( 'Parent Status:' ),
    'edit_item' => __( 'Edit Status' ),
    'update_item' => __( 'Update Status' ),
    'add_new_item' => __( 'Add New Status' ),
    'new_item_name' => __( 'New Status Name' ),
    'menu_name' => __( 'Status' ),
  );

  register_taxonomy('Status',array('our_endorsements'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'status' ),
  ));
}

	register_post_type( "our_endorsements", $args );

	/**
	 * Post Type: Events/Trainings.
	 */

	$labels = [
		"name" => __( "Events", "sunrisenationalchild" ),
		"singular_name" => __( "Event", "sunrisenationalchild" ),
	];

	$args = [
		"label" => __( "Events", "sunrisenationalchild" ),
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
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "page-attributes", "post-formats"],
		"taxonomies" => [ "campaigns" ],
	];

	register_post_type( "events", $args );
}


add_action( 'init', 'cptui_register_my_cpts' );

/**
* Removes or edits the 'Protected:' part from posts titles
*/

add_filter( 'protected_title_format', 'remove_protected_text' );
function remove_protected_text() {
return __('%s');
}

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}
