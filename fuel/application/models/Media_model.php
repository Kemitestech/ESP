<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Media_model extends CI_Model {
  const WISTIA_BASE_URL = "https://api.wistia.com/v1/";

//variables can be used by other classes that extend it
  protected $format = 'json';
  protected $apiKey = null;

  public function __construct() {
      parent::__construct();
      //Codeigniter : Write Less Do More
  }

  // Gets a list of media items based on project id and pagination criteria
  public function getMediaList($projectID = null, $page = 1, $per_page = 100, $full = true) {
    //for holding response from the api
      $medias = null;
      //criteria is that the page needs to be grater than or equal to one
      if($page >= 1) {
          //Array that is that will be used for post fields
          $params = array(
            'page' => $page,
            'per_page' => $per_page
          );
          //Checks if the project ID exists
          //If so element will be added to the array
          if($projectID) {
              $params['project_id'] = $projectID;
          }
          //JSON response from the the send request
          //Fist parameter will be appended to the wistia URL and the second parameter is for the post firld for the request
          $medias = $this->sendRequest('medias', $params);
      }

      // If we receive the max possible results we query the next page
      //Maximun allowed 100
      if($full && count($medias) == $per_page) {
        //call itself to the next set of result for the next page
          $nextPage = $this->getMediaList($projectID, $page+=1, $perPage);
          if(count($nextPage) > 0) {
              //Combining arrays together.  Updating media with the next set of results
              $medias = array_merge($medias, $nextPage);
          }
      }
      return $medias;
  }

  // Gets a single nedia item based on media id
  public function mediaShow($id = null) {
      $media = $this->sendRequest('medias/'.$id);
      
      if(isset($media->error)) {
        return null;
      }
      return $media;
  }

  //Fist parameter will be used apart of the api request and the second is the post fields
  protected function sendRequest($module, $params = null) {
      // build url
      $url = self::WISTIA_BASE_URL.$module.'.'.$this->format;
      // checks if there params and appends them to url as query parameters
      if($params) {//.- a way of appending
        //'?' for making query prameter in url
        //returns a string of query parameters
          $url.='?'.http_build_query($params);
      }
      // calls the api endpoint
      $result = $this->__send($url);
      // We then decode the JSON that's returned from the API
      $result = json_decode($result);

      return $result;
  }

 //
  protected function __send($url) {
      // initialise curl session with the url
      $ch = curl_init($url);

      // we set our options for calling api
      //Effects what curl_exec returns.  Returns the actual response in the form of json if set to true.
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

      // sets WWW-Authenticate for username:password
      curl_setopt($ch, CURLOPT_USERPWD, "api:".getenv("WISTIA_SECRET"));

      // Execute the given CURL session.
      $result = curl_exec($ch);
      // close the session
      curl_close($ch);
      //sets the result to the response
      //$this->response = $result;
      // Then returns the result
      return $result;
  }
}
