<?php

class Contactform extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
        $this->load->library('form_validation');
           	
        if($this->form_validation->run() == FALSE){
            $this->load->view('pages/contact-us');
        }
        else{
            $this->load->view('pages/home');
        }
    }

}

?>