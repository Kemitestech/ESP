<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Media_model extends CI_Model {
  const WISTIA_BASE_URL = "https://api.wistia.com/v1/";

  protected $format = 'json';
  protected $apiKey = null;

  public function __construct() {
      parent::__construct();
      //Codeigniter : Write Less Do More
  }

  // Gets a list of media items based on project id and pagination criteria
  public function getMediaList($projectID = null, $page = 1, $per_page = 100, $full = true) {
      $medias = null;

      if($page >= 1) {
          $params = array(
            'page' => $page,
            'per_page' => $per_page
          );
          if($projectID) {
              $params['project_id'] = $projectID;
          }
          $medias = $this->sendRequest('medias', $params);
      }

      // If we receive the max possible results we query the next page
      if($full && count($medias) == $per_page) {
          $nextPage = $this->getMediaList($projectID, $page+=1, $perPage);
          if(count($nextPage) > 0) {
              $medias = array_merge($medias, $nextPage);
          }
      }
      return $medias;
  }

  // Gets a single nedia item based on media id
  public function mediaShow($id = null) {
      $media = $this->sendRequest('medias/'.$id);

      return $media;
  }


  protected function sendRequest($module, $params = null) {
      // build url
      $url = self::WISTIA_BASE_URL.$module.'.'.$this->format;

      // checks if there params and appends them to url as query parameters
      if($params) {
          $url.='?'.http_build_query($params);
      }
      // calls the final api endpoint
      $result = $this->__send($url);
      // We then decode the JSON that's returned from the API
      $result = json_decode($result);

      return $result;
  }

  protected function __send($url) {
      // initialise curl session with the url
      $ch = curl_init($url);

      // we set our options for calling api
      // Returns the transfer as a string
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

      // sets WWW-Authenticate for username:password
      curl_setopt($ch, CURLOPT_USERPWD, "api:".getenv("WISTIA_SECRET"));

      // Execute the given cURL session.
      $result = curl_exec($ch);
      // close the session
      curl_close($ch);
      //sets the result to the response
      $this->response = $result;
      // Then returns the result
      return $result;
  }
}
