<?php

class Contactform extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}
    

    public function index(){
        $this->form_validation->set_rules('fullname', 'Full Name', 'min_length[3]|trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('businessname', 'Business Name', 'trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Telephone Number', 'trim|is_natural|min_length[11]');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('message', 'Enquiry', 'trim|required|alpha_numeric_spaces');

        if($this->form_validation->run() == FALSE){
            
            $this->output->set_status_header('400');
            $this->output->set_content_type('application/json');

            $this->data['message'] = validation_errors();
            echo json_encode($this->data);   
            
        }
        else{

            $from_address = 'info@cccedwardstreetparish.org';

            $fullname = $this->input->post('fullname');
            $businessname = $this->input->post('businessname');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');
            
            
            $this->output->set_content_type('application/json');
            $this->output->set_status_header('200');
            //$msg = array(
            //        'fullname' => form_error('fullname'), 
            //        'business' => form_error('businessname'),
            //        'email' => form_error('email'),
            //        'phone' => form_error('phone'),
            //        'subject' => form_error('subject'),
            //        'message' => form_error('message')
            //);    
              
            $config['protocol'] = 'smtp';
            $config['charset']  = 'utf-8'; //Change this you your preferred charset 
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = "html"; //Use 'text' if you don't need html tags and images
            $config['crlf'] = '\r\n';      //should be "\r\n"
            $config['newline'] = '\r\n';   //should be "\r\n"

            $config['smtp_host'] = 'smtp.mandrillapp.com';
            $config['smtp_user'] = 'info@cccedwardstreetparish.org';
            $config['smtp_pass'] = 'spZUYyrkNIpqIBo4LZT7BA';
            $config['smtp_port'] = '587';
            $this->email->initialize($config);
                        
            $this->email->from($email, $fullname);
            $this->email->to($from_address);
            $this->email->subject($subject);
            
            //if($businessname == '' && $phone == ''){
                
            //}
            if($businessname == '' && $phone == ''){
                $this->email->message('Dear Edward Street Parish<br><br>'.$message.'');
            }
            if($businessname !== '' && $phone !== ''){
                $this->email->message('Dear Edward Street Parish<br><br>Business Name: '.$businessname. '<br> Telephone Nom.: '.$phone.'<br><br>'.$message.'');
            }
            if ($businessname !== '' && $phone == ''){
                $this->email->message('Dear Edward Street Parish<br><br>Business Name: '.$businessname.'<br><br>'.$message.'');
            }
            if ($phone !== '' && $businessname == ''){
                $this->email->message('Dear Edward Street Parish<br><br>Telephone Nom.: '.$phone.'<br><br>'.$message.'');
            }

            if(! $this->email->send()){
                echo json_encode(array(
                 'result' => 'error',
                ));
            }else{
                $this->email->send();
                echo json_encode(array(
                 'result' => 'ok',
                ));
            }
        }
        
    }
?>
