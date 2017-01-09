<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Media_model');
  }

  private function process_videos($watch = null, $id = null) {
      //$projectID = 'fpotmhn86g';
      $dotenv = new Dotenv\Dotenv(FCPATH);
      $dotenv->load();

      if($watch == 'watch' && $id) {
        return SELF::_watch($id);
      }

      $response = $this->Media_model->getMediaList();
      $vars = array('video_data' => $response);

      if($response) {
        $vars['video_data'] = $response;
      }

      $this->fuel->pages->render('media/index', $vars);
  }

  public function _remap($method, $params = array()) {
        $method = 'process_'.$method;

        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $params);
        }
        show_404();
  }

  private function _watch($id) {
    $response = $this->Media_model->mediaShow($id);
    $vars = array('video_data' => $response);

    if($response) {
      $vars['video_data'] = $response;
    }

    $this->fuel->pages->render('media/video', $vars);
  }

  private function process_gallery() {
    $this->fuel->pages->render('media/gallery');
  }

}
