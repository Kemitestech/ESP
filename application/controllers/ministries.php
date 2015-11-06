<?php

class Ministries extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
	}

	public function index (){
		redirect ('ministries/our-ministries'); 
	} 

	public function view ($page = 'our-ministries'){
		
		if ( ! file_exists(APPPATH.'views/ministry_pages/'.$page.'.php')){ //checks if file exists
				show_404();
		} 

		$data['title'] = 'Edward Street Parish'; //assigns title element of array to capitalized home page
		$data['active'] = 'active';
		$data['dropdownactive'] = 'dropdown-active';
	
		$this->load->view('templates/header', $data);			
		$this->load->view('ministry_pages/'.$page, $data);
		$this->load->view('templates/newsletter_section', $data);
		$this->load->view('templates/footer');
	}

}


?>