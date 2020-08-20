<?php
require_once( 'ea8_api.php' );
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

// Fetch All Online Actions
add_action( 'after_setup_theme', 'fetchNewOnlineActions' );
//Create custom posts for actions that didn't exist.
// createActionPosts($onlineActionsForms);

// =========== Custom Post Type Manipulation ================
// ================ Fetching / Storage ==================
/**
* Creates a wordpress post of the "event" post type from the json array passed in representing a single OnlineAction json object.
<<<<<<< HEAD
<<<<<<< HEAD
* Done By: Andrew Wilson
*/
function createEventPost($onlineActionForms) {

	try {
=======
=======
* Done By: Andrew Jones
>>>>>>> Add ea8 api
*/
function createEventPost($onlineActionForms) {
	foreach ($onlineActionForms as $onlineAction) {
>>>>>>> Functions stubs and comments for EveryAction API
		// insert the post and set the category
		echo "Creating '".$onlineAction['formName']."' Form post";
		$post_id = wp_insert_post(array (
			'post_type' => 'events',
			'post_title' => $onlineAction['formName'],
			'post_content' => 'test content',
			'post_status' => 'publish',
			'comment_status' => 'closed',
			'ping_status' => 'closed'
		));
		// Using Advanced Custom Fields Plugin
		update_field('form_tracking_id', $onlineAction['formTrackingId'], $post_id);
		update_field('action_tag', sprintf(ACTION_TAG_STR, $onlineAction['formTrackingId']), $post_id);
		update_field('event_start_date', $onlineAction['startDate'], $post_id);
		update_field('event_type_name', $onlineAction['eventType']['name'], $post_id);
		update_field('event_type_id', $onlineAction['eventType']['eventTypeId'], $post_id);
	}
	catch (exception $e) {
		echo '<pre>'; print_r($e); echo '</pre>';
		return false;
	}
	return true;
}

const ONLINE_ACTION_DIR = "./EA8/Action/";
const LAST_EA_API_CALL_TIME = "./EA8/lastApiCallTime.json";

// Takes API response json objects and creates a new post of the "events" post type for each OnlineAction that hasn't been created yet
// When a post is created for an OnlineAction the json object used to create it will be stored in a file with the name matching the
// form tracking id. Existence of a post for a given OnlineAction can be determined by checking for the json file existence.
<<<<<<< HEAD
// Done By: Andrew Wilson
// fetchNewOnlineActions();
function fetchNewOnlineActions() {
	// make directory if it doesn't exist
	if (!file_exists(ONLINE_ACTION_DIR) && !is_dir(ONLINE_ACTION_DIR)) {
		mkdir(ONLINE_ACTION_DIR, 0777, true);
	}
	if (!checkApiCallTimer()) {
		return;
	}
	$filteredOnlineActions = getOnlineActionsFromApi();

	// echo '<pre>'; print_r($filteredOnlineActions); echo '</pre>';
	foreach ($filteredOnlineActions as $onlineAction) {
		$actionJsonFilepath = ONLINE_ACTION_DIR.$onlineAction['formTrackingId'].".json";

		// if a file exists for a given formTrackingId, update the contents, but do not create a post and then move on
		if (file_exists($actionJsonFilepath)) {
			file_put_contents($actionJsonFilepath, json_encode($onlineAction));
			continue;
		}

		// if the post is successfully created, store the response json in the file for it to mark that a post has been created for the formTrackingId
		if (createEventPost($onlineAction)) {
			file_put_contents($actionJsonFilepath, json_encode($onlineAction));
		}
	}
}

/* function that checks if it is time to call the API again.  $apiRefreshPeriod stores the time period that must elapse before refreshing
 * The time of the last API call is persisted in a file stored in LAST_EA_API_CALL_TIME to persist between requests.
 * Returns true if enough time has past since the last call, false if not.
*/
function checkApiCallTimer() {
	$runNow = false;
	if (!file_exists(LAST_EA_API_CALL_TIME)) {
		return true;
	}
	$lastCallDate = json_decode(file_get_contents(LAST_EA_API_CALL_TIME));
	$lastCallDate = new DateTime($lastCallDate->date);
	// time in seconds between EveryAction API calls.  The format starts with P and then 10H specifies 10 hours as the refresh period
	// https://www.php.net/manual/en/dateinterval.construct.php
	$apiRefreshPeriod = new DateInterval('PT10H');

	$now = new DateTime("now");
	$nextCallDate = $lastCallDate->add($apiRefreshPeriod);
	$runNow = $now > $nextCallDate;
	return $runNow;
}

// This function sets the last time that the API was called and stores it in a persisted file for quick reference
function setLastCallDate() {
	$now = new DateTime("now");
	file_put_contents(LAST_EA_API_CALL_TIME, json_encode($now));
=======
// Done By: Andrew Jones
function fetchNewOnlineActionsForm() {
	$json = getOnlineActionsFromApi();

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

>>>>>>> Add ea8 api
}

// Call EveryAction API and return a json object with an array called "items" that contains all of the OnlineAction json objects returned
// Called by fetchNewOnlineActionForms
function getOnlineActionsFromApi() {
<<<<<<< HEAD
	// $json = json_decode(file_get_contents(
	//  	"test_data_online_actions_forms.json", true), true);
	$ea8Api = new Ea8Api();
	$onlineActions = $ea8Api->fetchOnlineActions();
	//echo '<pre> hello'; print_r($json); echo '</pre>';
	setLastCallDate();
	return $onlineActions;
}

function echoVar($var) {
	echo '<pre>'; print_r($var); echo '</pre>';
=======

	// $json = json_decode(file_get_contents(
	// 	"test_data_online_actions_forms.json", true), true);
	$ea8Api = new Ea8Api();
	return json_decode($ea8Api->fetchOnlineActions(), true);
>>>>>>> Add ea8 api
}

function deleteExistingOnlineActionsForms() {
	$posts = get_posts([
		'numberposts' => '-1', // -1 for all posts
	  'post_type' => 'events',
	  'post_status' => 'publish',
		'fields' => 'ids'
	]);
	foreach($posts as $postId) {
		wp_delete_post($postId);
	}
	// echo '<pre> after ===== '; print_r($posts); echo '</pre>';
}
// fetchNewOnlineActions();
// deleteExistingOnlineActionsForms();

// ==================== API Calls =======================
