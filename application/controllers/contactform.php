<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactform extends CI_Controlller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
    	//set validation rules
    	$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|xss_clean|callback_alpha_space_only');
    	$this->form_validation->set_rules('businessname', 'Business Name', 'trim|xss_clean|callback_alpha_space_only');
    	$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
    	$this->form_validation->set_rules('phone', 'Telephone Number', 'trim|is_natural|min_length[11]');
    	$this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean|callback_alpha_space_only');
    	$this->form_validation->set_rules('message', 'Enquiry', 'trim|required|xss_clean');

    	if ($this->form_validation->run() == FALSE){
    		
    		if($this->input->post('ajax')){
    			echo(json_encode(array(
	    			'validate'=>FALSE, 
                	'fullname'=>form_error('fullname'), 
                	'businessname'=>form_error('businessName'),
                	'email'=>form_error('email'),
                	'phone'=>form_error('phone'),
                	'subject'=>form_error('subject'),
                	'message'=>form_error('message')
                )));
    		}
    	}	
    	else {
    		
    	//get the form data
    	$name = $this->input->post('fullname');
    	$businessname = $this->input->post('businessname');
    	$from_email = $this->input->post('email');
    	$phone = $this->input->post('phone');
    	$subject = $this->input->post('subject');
    	$message = $this->input->post('message');

    	//configure email settings
    	$config['protocol'] = 'smtp';
    	$config['smtp_host'] = 'ssl://smtp.cccedwardstreetparish.org';
    	$config['smtp_port'] = '465';
    	$config['smtp_user'] = 'info@cccedwardstreetparish.org';
    	$config['smtp_pass'] = 'N2wcr0ss';
    	$config['mailtype'] = 'html';
    	$config['wordwrap'] = TRUE;
    	$config['charset'] = 'iso-8859-1';
    	$config['newline'] = "\r\n"; //use double quotes here
    	$this->email->initialize($config);

    	//set to_email id to which you want to receive mails
   	 	$to_email = 'info@cccedwardstreetparish.org';

   	 	//send mail
    	$this->email->from($from_email, $name, $businessname, $phone);
    	$this->email->to($to_email);
    	$this->email->subject($subject);
    	$this->email->message($message);
    	if ($this->email->send()){
    		//$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Your mail has been sent successfully!</div		>');
            //redirect('contact_form/index');
            echo(json_encode("validate"=>TRUE));
    	}
    	else{
    		//error
	        //$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">There is error in sending mail! Please try again later</div>');
	        //redirect('contact_form/index');
	        echo(json_encode("validate"=>FALSE));
    	}
    	
   		}

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

}

?>