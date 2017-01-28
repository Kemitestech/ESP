<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
    //load model in constructor
    $this->load->model('Media_model');
  }


  private function process_videos($watch = null, $id = null) {
      //$projectID = 'fpotmhn86g';
      $dotenv = new Dotenv\Dotenv(FCPATH);
      $dotenv->load();

      if($watch == 'watch' && $id) {
        //calls internal function
        return SELF::_watch($id);
      }

      //getMediaList() returns the decoded JSON response
      $response = $this->Media_model->getMediaList();
      //Key value pairs video_data and $response
      $vars = array('video_data' => $response);
      //if response is true then
      if($response) {
        $vars['video_data'] = $response;
      }
      //1st param is the view and the second param is the variables that are passed to the view that can be used within the index view and referenced as variables
      $this->fuel->pages->render('media/index', $vars);
  }
//Will be the first method called,  Param1= URI segment2 is passed to parameter. Param2 is the rest of the URI segments
  public function _remap($method, $params = array()) {
        //The second URI segment is prefixes with 'process_'
        $method = 'process_'.$method;

        //If method Exists
        if (method_exists($this, $method)) {
            //first parameter passed as array is the method contained within this class and second parameter is the rest of the URI segments will be passed to method
            return call_user_func_array(array($this, $method), $params);
        }
        show_404();
  }

  private function _watch($id) {
    $response = $this->Media_model->mediaShow($id);
    $vars = array('video_data' => $response);

    if($response) {
      $vars['video_data'] = $response;
    } else {
      show_404();
    }

    $this->fuel->pages->render('media/video', $vars);//passed to the video.php view
  }

  private function process_gallery() {
    $this->fuel->pages->render('media/gallery');
  }

}
