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
        $this->form_validation->set_rules('ajax', 'Ajax', 'required|is_natural|alpha_numeric_spaces');

        $data['active'] = 'active';
        $data['title'] = 'Edward Street Parish';
            

        if($this->form_validation->run() == FALSE){
            
            if($ajax){
            $this->output->set_content_type('application/json');
            $this->output->set_status_header('400');
            $this->data['message'] = validation_errors();

            //$msg = array(
            //        'fullname' => form_error('fullname'), 
            //        'business' => form_error('businessname'),
            //        'email' => form_error('email'),
            //        'phone' => form_error('phone'),
            //        'subject' => form_error('subject'),
            //        'message' => form_error('message')
            //);    
            } 
        }
        else{
            
            if($ajax){
                $this->email->from('sinnell@aol.com', 'Emmanuel');
                $this->email->to('info.cccedwardstreetparish.org');
                $this->email->subject('Email Test');
                $this->email->message('Testing the email class.');

                $this->email->send(FALSE);
                $this->email->print_debugger(array('headers', 'body', 'subject'));
            }
            
           
        }
        echo json_encode($this->data);
        
        
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