<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactform extends CI_Controller {

		public function __construct() {
			parent::__construct();
		}

    public function index() {
				$this->load->library('email');
				$dotenv = new Dotenv\Dotenv(FCPATH);
				$dotenv->load();
				$spark_post_username = getenv('SPARK_POST_USERNAME');
				$spark_post_password = getenv('SPARK_POST_SECRET');
				$csrfTokenName = $this->security->get_csrf_token_name().'';
				$csrfHash = $this->security->get_csrf_hash().'';

        $this->form_validation->set_rules('fullname', 'Full Name', 'min_length[3]|trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('businessname', 'Business Name', 'trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Telephone Number', 'trim|is_natural|min_length[11]');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('message', 'Enquiry', 'trim|required|alpha_numeric_spaces');
				$this->form_validation->set_rules('firstname', 'First Name', 'callback_check_empty');

        if($this->form_validation->run() == FALSE) {

            $this->output->set_status_header('400');
            $this->output->set_content_type('application/json');

            $this->data['message'] = validation_errors();
						echo json_encode([
							'message' => $this->data['message'],
							'csrfTokenName' => $csrfTokenName,
							'csrfHash' => $csrfHash
						]);
        }
        else {
            $fullname = $this->input->post('fullname');
            $businessname = $this->input->post('businessname');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            $this->output->set_content_type('application/json');
            $this->output->set_status_header('200');

						$config['protocol'] = 'smtp';
						$config['charset']  = 'utf-8'; //Change this you your preferred charset
						$config['wordwrap'] = TRUE;
						$config['mailtype'] = "html"; //Use 'text' if you don't need html tags and images
						$config['crlf'] = "\r\n";      //should be "\r\n"
						$config['newline'] = "\r\n";   //should be "\r\n"

						$config['smtp_host'] = 'smtp.sparkpostmail.com';
						$config['smtp_user'] = $spark_post_username;
						$config['smtp_pass'] = $spark_post_password;
						$config['smtp_port'] = '587';
						$config['smtp_crypto'] = 'tls';

						$this->email->initialize($config);
            $this->email->from('info@cccedwardstreetparish.org', $fullname);
						$this->email->reply_to($email, $fullname);
            $this->email->to('info@cccedwardstreetparish.org');
            $this->email->subject($subject);

						//Checks if businessname and phonenumber is empty.
						//If empty set variables to empty string
						$businessname = !empty($businessname) ? 'Business name: ' . $businessname . '<br><br>' : '';
						$phone = !empty($phone) ? 'Contact Number: ' . $phone . '<br><br>' : '';
						$conclusion = 'Kind regards,<br>' . $fullname;
						$this->email->message('Dear Edward Street Parish,<br><br>' . $message . '<br><br>' . $businessname . $phone . $conclusion);

            if(!$this->email->send()){
                echo json_encode(array('result' => 'error', 'csrfTokenName' => $csrfTokenName, 'csrfHash' => $csrfHash));
            }else{
                echo json_encode(array('result' => 'ok', 'csrfTokenName' => $csrfTokenName, 'csrfHash' => $csrfHash));
            }
        }

    }

		public function check_empty($string) {
			if(empty($string)) {
				return true;
			} else {
				$this->form_validation->set_message('check_empty', 'The {field} field should be no longer than 50 characters');
				return false;
			}
		}
	}
?>
