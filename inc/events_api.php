<?php

class EventsAPI {
  public const EVERY_ACTION = "everyaction";
  private const EVENTS_URL = "https://sunrise-events.s3.amazonaws.com/events.json";
  private const ACCEPTED_TRAINING_TYPES = ["Sunrise School", "Training", "Phonebank"];

  public function __construct() { }

  /**
  * Returns a modified list of Online Actions Forms that have a valid associated
  * event, with the associated event's StartDate inserted into the response.
  * Currently only returns select values in the Online Actions Form response.
  */
  public function fetchOnlineActions() {
    $filteredEventsAndActions = [];
  	$response = self::callAPI("GET", self::EVENTS_URL);
    $json = json_decode($response, true)["map_data"];

  	foreach ($json as $eventJson) {
      if ($this->filter($eventJson)) {
        if (isset($eventJson['online_forms'])) {
          foreach ($eventJson['online_forms'] as $onlineActionJson) {
            $splitUrl = explode("/", $onlineActionJson['url']);
            $onlineAction = array(
              'url' => $onlineActionJson['url'],
        			'form_tracking_id' => $splitUrl[count($splitUrl) - 1],
        			'name' => $onlineActionJson['name'],
        			'status' => $onlineActionJson['status'],
              'description' => $onlineActionJson['description'],
              'banner_image_path' => $onlineActionJson['bannerImagePath'],
            );
            array_push($filteredEventsAndActions, $this->addEventFields($onlineAction, $eventJson));
          }
        }
        else {
          $splitUrl = explode("/", $eventJson['registration_link']);
          $formTrackingId = $splitUrl[count($splitUrl) - 1];

          if (!$formTrackingId) {
             $formTrackingId = $splitUrl[count($splitUrl) - 2];
          }

          $event = array(
            'url' => $eventJson['registration_link'],
            'form_tracking_id' => $formTrackingId,
            'name' => $eventJson['event_title'],
            'description' => $eventJson['description']
          );
          array_push($filteredEventsAndActions, $this->addEventFields($event, $eventJson));
        }
      }
    }
  	return $filteredEventsAndActions;
  }

  private function addEventFields($eventOrAction, $eventJson) {
    return array_merge($eventOrAction, array(
      'event_source' => $eventJson['event_source'],
      'event_title' => $eventJson['event_title'],
      'event_type' => $eventJson['event_type'],
      'event_start_date' => $eventJson['start_date'],
      'event_start_string' => $eventJson['start_date_string'],
      'event_end_string' => $eventJson['end_date_string'],
      'featured_image_url' => $eventJson['featured_image_url'],
    ));
  }

  private function filter($item) {
    return $item["is_national"] &&
      in_array($item["event_type"], self::ACCEPTED_TRAINING_TYPES);
  }

  static function callAPI($method, $url, $authKey = null, $data = false) {
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

      curl_close($curl);
      return $result;
  }
}

?>
