<?php

class Contactform extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}
    
    public function alpha_space_only($str)
    {
        if (!preg_match("/^[a-zA-Z ]+$/",$str))
        {
            $this->form_validation->set_message('alpha_space_only', 'The %s field must contain only alphabets and space');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function index(){
        $this->load->library('form_validation');
           	
        $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|xss_clean|callback_alpha_space_only');
        $this->form_validation->set_rules('businessname', 'Business Name', 'trim|xss_clean|callback_alpha_space_only');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Telephone Number', 'trim|is_natural|min_length[11]');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean|callback_alpha_space_only');
        $this->form_validation->set_rules('message', 'Enquiry', 'trim|required|xss_clean');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header');
            $this->load->view('contact-us');
            $this->load->view('templates/newsletter_section');
            $this->load->view('templates/footer');  
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('pages/home');
            $this->load->view('templates/newsletter_section');
            $this->load->view('templates/footer');
        }
    }

    public function view($page = 'contact-us'){
        if ( ! file_exists(APPPATH.'views/'.$page.'.php')){ //checks if file exists
            show_404();
        }

        $data['active'] = 'active';
        $data['title'] = 'Edward Street Parish';

        $this->load->view('templates/header', $data);
        $this->load->view($page);
        $this->load->view('templates/newsletter_section');
        $this->load->view('templates/footer');

    }

}

?>