<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Media_model extends CI_Model {
  const WISTIA_BASE_URL = "https://api.wistia.com/v1/";

  protected $format = 'json';
  protected $apiKey = null;

  public function __construct() {
      parent::__construct();
      //Codeigniter : Write Less Do More
  }

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

  public function mediaShow($id = null) {
      $media = $this->sendRequest('medias/'.$id);

      return $media;
  }

  protected function sendRequest($module, $params = null) {
      // build url
      $url = self::WISTIA_BASE_URL.$module.'.'.$this->format;

      if($params) {
          $url.='?'.http_build_query($params);
      }
      $result = $this->__send($url);
      $result = json_decode($result);

      return $result;
  }

  protected function __send($url) {
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_USERPWD, "api:".getenv("WISTIA_SECRET"));

      $result = curl_exec($ch);
      curl_close($ch);
      $this->response = $result;

      return $result;
  }
}
