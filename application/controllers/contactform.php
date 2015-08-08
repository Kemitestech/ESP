<?php

class Contactform extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}
    

    public function index(){
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('email');
           	
        $fullname = $this->input->post('fullname');
        $businessname = $this->input->post('businessname');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
        $ajax = $this->input->post('ajax');

        $this->form_validation->set_rules('fullname', 'Full Name', 'min_length[3]|trim|required|xss_clean|alpha_numeric_spaces');
        $this->form_validation->set_rules('businessname', 'Business Name', 'trim|required|xss_clean|alpha_numeric_spaces');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Telephone Number', 'trim|is_natural|min_length[11]');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean|alpha_numeric_spaces');
        $this->form_validation->set_rules('message', 'Enquiry', 'trim|required|xss_clean|alpha_numeric_spaces');
    

        $data['active'] = 'active';
        $data['title'] = 'Edward Street Parish';
            

        if($this->form_validation->run() == FALSE){
            
            
            $this->output->set_content_type('application/json');
            $this->output->set_status_header('400');
            $this->data['message'] = validation_errors();
            echo json_encode($this->data);

            //$msg = array(
            //        'fullname' => form_error('fullname'), 
            //        'business' => form_error('businessname'),
            //        'email' => form_error('email'),
            //        'phone' => form_error('phone'),
            //        'subject' => form_error('subject'),
            //        'message' => form_error('message')
            //);    
            
            
        }
        else{
            
            
            $this->output->set_content_type('application/json');
            $this->output->set_status_header('200');
            $this->data['message'] = 'Success';
            echo json_encode($this->data);


            //$msg = array(
            //        'fullname' => form_error('fullname'), 
            //        'business' => form_error('businessname'),
            //        'email' => form_error('email'),
            //        'phone' => form_error('phone'),
            //        'subject' => form_error('subject'),
            //        'message' => form_error('message')
            //);    
            $config['protocol'] = 'smtp';
            $config['charset']  = 'iso-8859-1'; //Change this you your preferred charset 
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html'; //Use 'text' if you don't need html tags and images

            $config['smtp_host'] = '#';
            $config['smtp_user'] = '#';
            $config['smtp_pass'] = '#';
            $config['smtp_port'] = '#';   
            
            $this->email->from('sinnell@aol.com', 'Emmanuel');
            $this->email->to('info.cccedwardstreetparish.org');
            $this->email->subject('Email Test');
            $this->email->message('If you forgot how to do this, go ahead and refer to: <a href="http://the-amazing-php.blogspot.com/2015/05/codeigniter-send-email-with-mandrill.html">The Amazing PHP</a>.');

            $this->email->send();
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