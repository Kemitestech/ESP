<?php
class Home extends CI_Controller {
	
	public function __construct(){
		
		$this->load->helper('url');
	}

	public function view($page = 'home'){  //view method that takes an arguement, which is the name of the page to be loaded 
		
		if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php')){ //checks if file exists
			show_404();
		}

		$data['title'] = 'Edward Street Parish'; //assigns title element of array to capitalized home page
		$data['nav'] = ucfirst($page); //assigns nav element of array to capitalized home page

		$this->load->view('templates/header', $data); //loads view in templates/header, view takes two parameters: url  and data 
		$this->load->view('pages/'.$page, $data);		//$data array is used to pass values to the view
		$this->load->view('templates/newsletter_section', $data);
		$this->load->view('templates/footer', $data); 
	}	

} 	
?>