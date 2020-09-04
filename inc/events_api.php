<?php

class EventsAPI {

  const EVENTS_URL = "https://sunrise-events.s3.amazonaws.com/ea-events-staging.json ";
  const PROD_KEYTYPE = "PROD";
  const DEV_KEYTYPE = "DEV";
  const EA_EVENT_SOURCE = "everyaction";

  public function __construct() {
    // Staging or Dev
    $Dev_Mode = false;
    if ($Dev_Mode) {
    } else {
    }
  }

  /**
  * Returns a modified list of Online Actions Forms that have a valid associated
  * event, with the associated event's StartDate inserted into the response.
  * Currently only returns select values in the Online Actions Form response.
  */
  public function fetchOnlineActions() {
    $filteredOnlineActions = [];
  	$response = self::callAPI("GET", self::EVENTS_URL);
    $json = json_decode($response, true)["map_data"];
    // echo '<pre>'; print_r($json); echo '</pre>';

  	foreach ($json as $eventJson) {
      if ($eventJson["event_source"] == self::EA_EVENT_SOURCE) {
        foreach ($eventJson['online_forms'] as $onlineActionJson) {
          $splitUrl = explode("/", $onlineActionJson['url']);
          $onlineAction = array(
            'url' => $onlineActionJson['url'],
      			'form_tracking_id' => $splitUrl[count($splitUrl) - 1],
      			'name' => $onlineActionJson['name'],
      			'status' => $onlineActionJson['status'],
      			'event_title' => $eventJson['event_title'],
      			'event_type' => $eventJson['event_type'],
      			'event_start_date' => $eventJson['start_date']);
          array_push($filteredOnlineActions, $onlineAction);
        }
      }
    }
  	return $filteredOnlineActions;
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
