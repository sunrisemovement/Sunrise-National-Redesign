<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Sunrise_National
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function surnise_national_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'surnise_national_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function surnise_national_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'surnise_national_pingback_header' );


// ======================================================
// EveryAction8 - Specific Code
// ======================================================
//TODO this should be on some trigger, e.g. daily / time-based trigger
//since it seems unlikely EA8 offers a webhook of some sort.
//Read in test files

const ACTION_TAG_STR = "<script type=\"text/javascript\" src=\"https://d1aqhv4sn5kxtx.cloudfront.net/actiontag/at.js\"></script><div class=\"ngp-form\" data-form-url=\"https://actions.everyaction.com/v1/Forms/%s\"></div>";
// deleteExistingOnlineActionsForms();

// Fetch All Online Actions
add_action( 'after_setup_theme', 'fetchNewOnlineActionsForm' );


//Create custom posts for actions that didn't exist.
// createActionPosts($onlineActionsForms);

// =========== Custom Post Type Manipulation ================
// ================ Fetching / Storage ==================
/**
* Creates a wordpress post of the "event" post type from the json array passed in representing a single OnlineAction json object.
*/
function createEventPost($onlineActionForms) {
	foreach ($onlineActionForms as $onlineAction) {
		// insert the post and set the category
		$post_id = wp_insert_post(array (
		    'post_type' => 'events',
		    'post_title' => $onlineAction['formName'],
		    'post_content' => 'test content',
		    'post_status' => 'publish',
		    'comment_status' => 'closed',
		    'ping_status' => 'closed'
		));
		// Using Advanced Custom Fields Plugin
		update_field('formTrackingId', $onlineAction['formTrackingId'], $post_id);
		update_field('actionTag', sprintf(ACTION_TAG_STR, $onlineAction['formTrackingId']), $post_id);
	}
}

// Takes API response json objects and creates a new post of the "events" post type for each OnlineAction that hasn't been created yet
// When a post is created for an OnlineAction the json object used to create it will be stored in a file with the name matching the
// form tracking id. Existence of a post for a given OnlineAction can be determined by checking for the json file existence.
function fetchNewOnlineActionsForm() {
	$json = json_decode(file_get_contents(
		"test_data_online_actions_forms.json", true), true);

	$onlineActionsForms = [];
	foreach ($json['items'] as $onlineActionJson) {
		$onlineAction = array(
			'formTrackingId' => $onlineActionJson['formTrackingId'],
			'formName' => $onlineActionJson['formName'],
			'isActive' => $onlineActionJson['isActive'],
			'campaignId' => $onlineActionJson['campaignId'],
			'eventId' => $onlineActionJson['eventId']);
		array_push($onlineActionsForms, $onlineAction);
	}
	return $onlineActionsForms;
	// echo '<pre> $onlineActionsForms ===== '; print_r($onlineActionsForms); echo '</pre>';
	//echo '<pre>'; print_r($onlineActionsForms); echo '</pre>';
}

// Call EveryAction API and return a json object with an array called "items" that contains all of the OnlineAction json objects returned
// Called by fetchNewOnlineActionForms
function getOnlineActionsFromApi() {
	
}

function deleteExistingOnlineActionsForms() {
	//TODO only getting 5 posts
	$posts = get_posts([
	  'post_type' => 'events',
	  'post_status' => 'publish',
		'fields' => 'ids'
	]);
	foreach($posts as $postId) {
		wp_delete_post($postId);
	}
	// echo '<pre> after ===== '; print_r($posts); echo '</pre>';
}

// ==================== API Calls =======================




function fetchOnlineActions() {
	$response = callAPI("GET",  EA8_ONLNE_ACTIONS_URL, EA8_AUTH_KEY);
	return $response;
}

//$response  = json_encode(fetchOnlineActions());

function callAPI($method, $url, $authKey, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }


    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, $authKey);

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
		echo($result);

    curl_close($curl);

    return $result;
}
