<?php
	class About_us extends CI_Controller {
		
		public function __construct(){
			
			parent::__construct();
		}

		public function index(){				

			redirect('about-us/who-we-are');		
		}

		public function view($page = 'who-we-are'){
			
			if ( ! file_exists(APPPATH.'views/about_pages/'.$page.'.php')){ //checks if file exists
				show_404();
			}
			
			$data['title'] = 'Edward Street Parish'; //assigns title element of array to capitalized home page
			$data['active'] = 'active';
			$data['dropdownactive'] = 'dropdown-active'; //assigns title element of array to capitalized home page
			
			
			$this->load->view('templates/header', $data);			
			$this->load->view('about_pages/'.$page, $data);
			$this->load->view('templates/newsletter_section', $data);
			$this->load->view('templates/footer');			
		}

	}
?>
