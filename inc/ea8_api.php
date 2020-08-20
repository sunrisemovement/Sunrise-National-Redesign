<?php

class Ea8Api {

  const EA8_BASE_URL = "https://api.securevan.com/v4/";
  const DEV_STAGING_EA8_API_KEY  = "***REMOVED***";
  const PROD_EA8_API_KEY = "";

  private $ea8AuthKey;

  public function __construct() {
    // Staging or Dev
    //if( defined('ACF_DEV_API') && (ACF_DEV_API === 'STAGE' || ACF_DEV_API)) {
    if (true) {
    	$this->ea8AuthKey = $this::DEV_STAGING_EA8_API_KEY;
    } else {
    	$this->ea8AuthKey = $this::PROD_EA8_API_KEY;
    }
  }

  public function fetchOnlineActions() {
  	$response = $this->callAPI("GET",  self::EA8_BASE_URL."onlineActionsForms", $this->ea8AuthKey);
  	// echo '<pre>'; print_r($response); echo '</pre>';
  	return $response;
  }

  //$response  = json_encode(fetchOnlineActions());

  function callAPI($method, $url, $authKey, $data = false) {
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
