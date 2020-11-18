<?php
require_once( 'events_api.php' );
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

// We may need to change this Cloudfront URL at some point.
const ACTION_TAG_STR = "<script type=\"text/javascript\" src=\"https://d1aqhv4sn5kxtx.cloudfront.net/actiontag/at.js\"></script><div class=\"ngp-form\" data-form-url=\"https://actions.everyaction.com/v1/Forms/%s\"></div>";

// Fetch All Online Actions
//add_action( 'after_setup_theme', 'fetchNewOnlineActions' );
//Create custom posts for actions that didn't exist.
// createActionPosts($onlineActionsForms);

// =========== Custom Post Type Manipulation ================
// ================ Fetching / Storage ==================
/**
* Creates a wordpress post of the "event" post type from the json array passed in representing a single OnlineAction json object.
* Done By: Andrew Jones
*/
function createEventPost($onlineAction) {

	try {
		// insert the post and set the category
		// echo "Creating '".$onlineAction['name']."' Form post\n";
		$post_id = wp_insert_post(array (
			'post_type' => 'events',
			'post_title' => $onlineAction['event_title'],
			'post_content' => '',
			'post_status' => 'publish',
			'comment_status' => 'closed',
			'ping_status' => 'closed'
		));

		// Using Advanced Custom Fields Plugin
		update_field('form_tracking_id', $onlineAction['form_tracking_id'], $post_id);
		update_field('url', $onlineAction['url'], $post_id);

		if ($onlineAction['event_source'] == EventsApi::EVERY_ACTION) {
			update_field('action_tag', sprintf(ACTION_TAG_STR, $onlineAction['form_tracking_id']), $post_id);
		}

		update_field('event_start_date', $onlineAction['event_start_date'], $post_id);
		update_field('event_start_string', $onlineAction['event_start_string'], $post_id);
		update_field('event_end_string', $onlineAction['event_end_string'], $post_id);
		update_field('event_title', $onlineAction['event_title'], $post_id);
		update_field('event_type', $onlineAction['event_type'], $post_id);
		update_field('event_source', $onlineAction['event_source'], $post_id);
		if (isset($onlineAction['status'])) {
			update_field('status', $onlineAction['status'], $post_id);
		}
		update_field('featured_image_url', $onlineAction['featured_image_url'], $post_id);
		update_field('description', $onlineAction['description'], $post_id);
		if (isset($onlineAction['banner_image_path'])) {
			update_field('banner_image_path', $onlineAction['banner_image_path'], $post_id);
		}
	}
	catch (exception $e) {
		echo '<pre>'; print_r($e); echo '</pre>';
		return false;
	}
	return true;
}

// Takes API response json objects and creates a new post of the "events" post type for each OnlineAction that hasn't been created yet
// When a post is created for an OnlineAction the json object used to create it will be stored in a file with the name matching the
// form tracking id. Existence of a post for a given OnlineAction can be determined by checking for the json file existence.
// Done By: Andrew Wilson
function getOnlineActionsDirectory() {
	return get_template_directory().DIRECTORY_SEPARATOR."ea8".DIRECTORY_SEPARATOR."Action".DIRECTORY_SEPARATOR;
}

function fetchNewOnlineActions($bypassTimer = null) {
	write_log((new DateTime("now"))."-"."fetchNewOnlineActions called");
	$ONLINE_ACTION_DIR = getOnlineActionsDirectory();
	$LAST_EA_API_CALL_TIME = get_template_directory().DIRECTORY_SEPARATOR."ea8".DIRECTORY_SEPARATOR."lastApiCallTime.json";

	// make directory if it doesn't exist
	$fileExist = file_exists($ONLINE_ACTION_DIR);
	$isDir = is_dir($ONLINE_ACTION_DIR);
	if (!file_exists($ONLINE_ACTION_DIR) && !is_dir($ONLINE_ACTION_DIR)) {
		mkdir($ONLINE_ACTION_DIR, 0777, true);
	}

	if (is_null($bypassTimer) || empty($bypassTimer)){
		return;
		if (!checkApiCallTimer()) {
			return;
		}
	}
	write_log((new DateTime("now"))."-"."fetchNewOnlineActions timer passed, fetching...");
	$filteredOnlineActions = getOnlineActionsFromApi();

	$actionsCreated = 0;
	foreach ($filteredOnlineActions as $onlineAction) {

		$actionJsonFilepath = $ONLINE_ACTION_DIR.$onlineAction['form_tracking_id'].".json";

		// if a file exists for a given formTrackingId, update the contents, but do not create a post and then move on
		if (file_exists($actionJsonFilepath)) {
			file_put_contents($actionJsonFilepath, json_encode($onlineAction));
			continue;
		}

		// if the post is successfully created, store the response json in the file for it to mark that a post has been created for the formTrackingId
		if (createEventPost($onlineAction)) {
			file_put_contents($actionJsonFilepath, json_encode($onlineAction));
			$actionsCreated += 1;
		}
	}
	return $actionsCreated;
}

/* function that checks if it is time to call the API again.  $apiRefreshPeriod stores the time period that must elapse before refreshing
 * The time of the last API call is persisted in a file stored in $LAST_EA_API_CALL_TIME to persist between requests.
 * Returns true if enough time has past since the last call, false if not.
*/
function checkApiCallTimer() {
	$runNow = false;
	if (!file_exists($LAST_EA_API_CALL_TIME)) {
		return true;
	}
	$lastCallDate = json_decode(file_get_contents($LAST_EA_API_CALL_TIME));
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
	file_put_contents($LAST_EA_API_CALL_TIME, json_encode($now));
}

// echo '<pre>'; print_r($filteredOnlineActions); echo '</pre>';
// Call EveryAction API and return a json object with an array called "items" that contains all of the OnlineAction json objects returned
// Called by fetchNewOnlineActionForms
function getOnlineActionsFromApi() {
	$eventsApi = new EventsAPI();
	$onlineActions = $eventsApi->fetchOnlineActions();
	setLastCallDate();
	return $onlineActions;
}

function echoVar($var) {
	echo '<pre>'; print_r($var); echo '</pre>';
}

function addDashboardWidgets() {
	wp_add_dashboard_widget('everyaction_fetch_data_widget', 'Update Everyaction Data', 'renderUpdateOnlineActionsButton');
	wp_add_dashboard_widget('everyaction_delete_data_widget', 'Delete Everyaction Data', 'renderDeleteOnlineActionsButton');
}
add_action('wp_dashboard_setup', 'addDashboardWidgets');
add_action('wp_ajax_ea_action', 'onEveryactionAdminButtonClick');
add_action('wp_ajax_ea_delete_action', 'onEveryactionDeleteButtonClick');
/**
 * Add javascript file
 */
function addAjaxScript($hook) {
	// add JS-File only on the dashboard page
	if ('index.php' !== $hook) {
		return;
	}
	$scriptLocation = get_template_directory_uri()."/ea8/ea8_widget_ajax_script.js";
	wp_enqueue_script('ea8_widget_ajax_script', $scriptLocation, array(), NULL, true);
}
add_action('admin_enqueue_scripts', 'addAjaxScript');

function renderDeleteOnlineActionsButton() {
	?>
	<form id="ea_delete_form" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post">
		<input type="hidden" name="ea_delete_action" id="ea_delete_action" value="ea_delete_action">
		<p class="submit">
			<?php submit_button( __( 'Delete Everyaction Data' ), 'primary', 'save', false ); ?>
		</p>
	</form>
	<?php
	return;
}

function renderUpdateOnlineActionsButton() {
	?>
	<form id="ea_form" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post">
		<input type="hidden" name="ea_action" id="ea_action" value="ea_action">
		<p class="submit">
			<?php submit_button( __( 'Update Everyaction Data' ), 'primary', 'save', false ); ?>
		</p>
	</form>
	<?php
	return;
}

function onEveryactionAdminButtonClick() {
	echo ea_deleteAutoGeneratedEvents()." actions deleted\n";
	echo fetchNewOnlineActions(true)." actions created\n";
}

function onEveryactionDeleteButtonClick() {
	echo ea_deleteAutoGeneratedEvents()." posts deleted.\n";

	$removed = deleteDirectory(getOnlineActionsDirectory());

	if ($removed) {
		echo "Directory deleted";
	} else {
		echo "Failed to delete directory";
	}
}

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }
    return rmdir($dir);
}

function IsNullOrEmptyString($str){
    return (!isset($str) || trim($str) === '');
}

function ea_scheduleCronJobs() {
	if ( !wp_next_scheduled( 'ea_deleteOldEvents' ) ) {
		wp_schedule_event(time(), 'hourly', 'ea_deleteOldEvents');
	}
	if ( !wp_next_scheduled( 'fetchNewOnlineActions' ) ) {
		wp_schedule_event(time(), 'hourly', 'fetchNewOnlineActions');
	}
}

// this function deletes all events that are created by the events plugin (auto generated)
function ea_deleteAutoGeneratedEvents() {
	$posts = get_posts([
		'numberposts' => '-1', // -1 for all posts
	  	'post_type' => 'events',
	  	'post_status' => 'publish',
		'fields' => 'ids'
	]);
	$actionsJsonDir = getOnlineActionsDirectory();
	$countPostsDeleted = 0;
	foreach($posts as $postId) {
		$formId = get_field('form_tracking_id', $postId);

		if(IsNullOrEmptyString($formId)) {
			continue;
		}
		$fileName = $actionsJsonDir.$formId.".json";

		if(file_exists($fileName)) {
			wp_delete_post($postId);
			unlink($fileName);
			$countPostsDeleted += 1;
		}
	}

	return $countPostsDeleted;
}

// this function deletes events that are past the date/time they occurred on.
function ea_deleteOldEvents() {
	write_log((new DateTime("now"))."-"."ea_deleteOldEvents running");
	$posts = get_posts([
		'numberposts' => '-1', // -1 for all posts
	  	'post_type' => 'events',
	  	'post_status' => 'publish',
		'fields' => 'ids'
	]);
	$countPostsDeleted = 0;
	foreach($posts as $postId) {
		$deletePost = false;

		$dateStr = get_field('event_start_date', $postId);
		if(!IsNullOrEmptyString($dateStr)) {
			$eventDateTime = new DateTime($dateStr);
			$now = new DateTime("now");
			$deletePost = $now > $eventDateTime;
		}
		else {
			// manually created posts only have a date, no time associated.
			$dateStr = get_field('dates', $postId);
			$eventDateTime = new DateTime($dateStr);
			$today = new DateTime("today");
			$deletePost = $today > $eventDateTime;
		}

		if($deletePost) {
			$countPostsDeleted += 1;
			$formId = get_field('form_tracking_id', $postId);
			wp_delete_post($postId);
			$fileName = getOnlineActionsDirectory().$formId.".json";
			write_log((new DateTime("now"))."-"."ea_deleteOldEvents deleting ".$fileName);
			if(file_exists($fileName)) {
				unlink($fileName);
			}
		}
	}

	return $countPostsDeleted;
}

if (!function_exists('write_log')) {

    function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }

}

// test function used to modify the dates of some of the events coming in so they would be expired in ways that I could test - Andrew Wilson
// function ea_test() {
// 	$posts = get_posts([
// 		'numberposts' => '-1', // -1 for all posts
// 	  	'post_type' => 'events',
// 	  	'post_status' => 'publish',
// 		'fields' => 'ids'
// 	]);
// 	foreach($posts as $postId) {
// 		$dateStr = get_field('event_start_date', $postId);
// 		$dateStr = str_replace("10-26","10-22", $dateStr);
// 		update_Field('event_start_date', $dateStr, $postId);
// 		if(strPos($dateStr, "10-31") !== false) {
// 			update_Field('event_start_date', "", $postId);
// 			update_Field('dates', "10/22", $postId);
// 		}
// 	}
// }
add_action('ea_cron_hook', 'ea_scheduleCronJobs');
