<?php

class Ea8Api {

  const EA8_BASE_URL = "https://api.securevan.com/v4/";
  const PROD_KEYTYPE = "PROD";
  const DEV_KEYTYPE = "DEV";
  const PROD_KEY_NAME = "prod_key.txt";
  const DEV_KEY_NAME = "dev_key.txt";

  private $ea8AuthKey;

  public function __construct() {
    // Staging or Dev
    $Dev_Mode = true;
    if ($Dev_Mode) { //defined('ACF_DEV_API') && (ACF_DEV_API === 'STAGE' || ACF_DEV_API)) {
    	$this->ea8AuthKey = $this->readKey(self::DEV_KEYTYPE);
    } else {
    	$this->ea8AuthKey = $this->readKey(self::PROD_KEYTYPE);
    }
  }

  /**
  * Returns a modified list of Online Actions Forms that have a valid associated
  * event, with the associated event's StartDate inserted into the response.
  * Currently only returns select values in the Online Actions Form response.
  */
  public function fetchOnlineActions() {
    $filteredOnlineActions = [];
    $response = self::callAPI("GET", self::EA8_BASE_URL."onlineActionsForms", $this->ea8AuthKey);
    $json = json_decode($response, true)['items'];
  	foreach ($json as $onlineActionJson) {
    	//echo '<pre>'; print_r($onlineActionJson); echo '</pre>';
      $eventId = $onlineActionJson['eventId'];
      // Currently skipping all non-event-associated actions.
      if (self::isNullOrEmptyString($eventId)) {
        continue;
      } else {

        $onlineAction = array(
    			'formTrackingId' => $onlineActionJson['formTrackingId'],
    			'formName' => $onlineActionJson['formName'],
    			'isActive' => $onlineActionJson['isActive'],
    			'campaignId' => $onlineActionJson['campaignId'],
    			'eventId' => $onlineActionJson['eventId']
          );
          $onlineAction = $this->insertFieldsFromEvent(
            $this->fetchEventById($eventId),
            $onlineAction);
	       // echo '<pre>'; print_r($onlineAction); echo '</pre>';
      }
      array_push($filteredOnlineActions, $onlineAction);
    }
  	return $filteredOnlineActions;
  }

  function fetchEventById($eventId) {
   $response = $this->callAPI("GET", self::EA8_BASE_URL."events/".$eventId, $this->ea8AuthKey);
   return $response;
  }

  function insertFieldsFromEvent($eventResponse, $onlineAction) {
    if ($this->validateResponse($eventResponse)) {
        $json = json_decode($eventResponse, true);
        $onlineAction['startDate'] = $json['startDate'];
        $onlineAction['eventType'] = $json['eventType'];
        // echo '<pre>'; print_r($onlineAction); echo '</pre>';
    }
    return $onlineAction;
  }

  //TODO Add response validation to all API calls
  function validateResponse($response) {
    return true;
  }

  function readKey($keyType) {
    $keyPath = get_template_directory_uri().DIRECTORY_SEPARATOR."ea8".DIRECTORY_SEPARATOR;
    if(strcmp($keyType, self::PROD_KEYTYPE) == 0) {
      return file_get_contents($keyPath.self::PROD_KEY_NAME);
    }
    else if (strcmp($keyType, self::DEV_KEYTYPE) == 0) {
      return file_get_contents($keyPath.self::DEV_KEY_NAME);
    }
    else {
      return "";
    }
  }

  static function callAPI($method, $url, $authKey, $data = false) {
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

      // windows testing
      //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

      // Optional Authentication:
      curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($curl, CURLOPT_USERPWD, $authKey);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

      $result = curl_exec($curl);

      curl_close($curl);
      return $result;
  }

  static function isNullOrEmptyString($str){
    return (!isset($str) || trim($str) === '');
  }
}

?>
