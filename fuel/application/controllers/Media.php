<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller{

  public function __construct() {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Media_model');
  }

  public function index() {
      //$projectID = 'fpotmhn86g';
      $dotenv = new Dotenv\Dotenv(FCPATH);
      $dotenv->load();

      $response = $this->Media_model->getMediaList();
      $vars = array('video_data' => $response);

      if($response) {
        $vars['video_data'] = $response;
      }
      // $this->data['id'] = $response->id;
      // $this->data['videoTitle'] = $response->name;
      // $this->data['description'] = $response->description;
      // $this->data['hashed_id'] = $response->hashed_id;
      // $this->data['thumbnail'] = $response->thumbnail;
      // $this->data['status'] = $response->status;
      // $this->load->view('_blocks/header', $vars);
      // $this->load->view('media/index', $vars);
      // $this->load->view('_blocks/newsletter_section', $vars);
      // $this->load->view('_blocks/footer', $vars);
      $this->fuel->pages->render('media/index', $vars);
  }

  public function watch($id) {
    $dotenv = new Dotenv\Dotenv(FCPATH);
    $dotenv->load();

    $response = $this->Media_model->mediaShow($id);
    $vars = array('video_data' => $response);
    
    if($response) {
      $vars['video_data'] = array($response);
    }
    // $this->data['id'] = $response->id;
    // $this->data['videoTitle'] = $response->name;
    // $this->data['description'] = $response->description;
    // $this->data['hashed_id'] = $response->hashed_id;
    // $this->data['thumbnail'] = $response->thumbnail;
    // $this->data['status'] = $response->status;
    // $this->load->view('_blocks/header', $vars);
    // $this->load->view('media/index', $vars);
    // $this->load->view('_blocks/newsletter_section', $vars);
    // $this->load->view('_blocks/footer', $vars);
    $this->fuel->pages->render('media/index', $vars);
  }
}
