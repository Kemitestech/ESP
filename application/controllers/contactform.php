<?php

class Contactform extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
           	
        if ($this->form_validation->run() == FALSE){
            $this->load->view('pages/contact');
        }
        else{
            $this->load->view('pages/home');
        }
    }

}

?>