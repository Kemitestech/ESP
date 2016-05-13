<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactform extends CI_Controller {

		public function __construct() {
			parent::__construct();
		}

    public function index() {
				$this->load->library('email');

        $this->form_validation->set_rules('fullname', 'Full Name', 'min_length[3]|trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('businessname', 'Business Name', 'trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Telephone Number', 'trim|is_natural|min_length[11]');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('message', 'Enquiry', 'trim|required|alpha_numeric_spaces');

        if($this->form_validation->run() == FALSE) {

            $this->output->set_status_header('400');
            $this->output->set_content_type('application/json');

            $this->data['message'] = validation_errors();
            echo json_encode($this->data);

        }
        else {
						$email_config = $this->config->load('mailchimp_email', TRUE, TRUE); // Loads Mailchimp configurations

						$to_address = $email_config['to_address']; // Gets the 'to address' item from mailchimp_email config file
            $fullname = $this->input->post('fullname');
            $businessname = $this->input->post('businessname');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            $this->output->set_content_type('application/json');
            $this->output->set_status_header('200');

						$this->email->initialize($email_config);

            $this->email->from($email, $fullname);
            $this->email->to($to_address);
            $this->email->subject($subject);

            if($businessname == '' && $phone == '')	{
                $this->email->message('Dear Edward Street Parish,<br><br>'.$message.'');
            }
            if($businessname !== '' && $phone !== '') {
                $this->email->message('Dear Edward Street Parish,<br><br>Business Name: '.$businessname. '<br> Telephone Nom.: '.$phone.'<br><br>'.$message.'');
            }
            if($businessname !== '' && $phone == '') {
                $this->email->message('Dear Edward Street Parish,<br><br>Business Name: '.$businessname.'<br><br>'.$message.'');
            }
            if($phone !== '' && $businessname == '') {
                $this->email->message('Dear Edward Street Parish,<br><br>Phone Number: '.$phone.'<br><br>'.$message.'');
            }

            if(!$this->email->send()){
                echo json_encode(array('result' => 'error'));
            }else{
                $this->email->send();
                echo json_encode(array('result' => 'ok'));
            }
        }

    }
	}
?>
