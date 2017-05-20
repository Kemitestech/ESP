<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactform extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

    public function index() {
		$spark_post_username = getenv('SPARK_POST_USERNAME');
		$spark_post_password = getenv('SPARK_POST_SECRET');
		$dotenv = new Dotenv\Dotenv(FCPATH);
		$dotenv->load();
		$client = new GuzzleHttp\Client();
		$httpClient = new Http\Adapter\Guzzle6\Client($client);
		$sparkPost = new SparkPost\SparkPost($httpClient, array('key' => getenv('SPARK_POST_SECRET').''));
		$csrfTokenName = $this->security->get_csrf_token_name().'';
		$csrfHash = $this->security->get_csrf_hash().'';

        $this->form_validation->set_rules('fullname', 'Full Name', 'max_length[30]|required|alpha_numeric_spaces|trim');
        $this->form_validation->set_rules('businessname', 'Business Name', 'max_length[50]|alpha_numeric_spaces|trim');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Telephone Number', 'min_length[8]|trim|is_natural');
        $this->form_validation->set_rules('subject', 'Subject', 'max_length[20]|required|trim');
        $this->form_validation->set_rules('message', 'Enquiry', 'trim|required|max_length[500]');
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
           	$this->output->set_content_type('application/json');
            $this->output->set_status_header('200');	

            $fullname = $this->input->post('fullname');
            $businessname = $this->input->post('businessname');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');
			$textMessage = "Dear Edward Street Parish,\n\n{$message}\n\n{$businessname}\n\n{$phone}\n\nKind regards,\n{$fullname}";

			// Checks if businessname and phonenumber is empty.
			// If empty set variables to empty string
			$businessname = !empty($businessname) ? 'Business name: ' . $businessname . '<br><br>' : '';
			$phone = !empty($phone) ? 'Contact Number: ' . $phone . '<br><br>' : '';
			$conclusion = 'Kind regards,<br>' . $fullname;
			$promise = $sparkPost->transmissions->post(array(
				'content' => array(
					'from' => array('name' => 'Edward Street Parish', 'email' => 'info@cccedwardstreetparish.org'),
					'subject' => "{$subject}",
					'html' => "Dear Edward Street Parish,<br><br>{$message}<br><br>{$businessname}{$phone}{$conclusion}",
					'text' => $textMessage,
					'reply_to' => "{$email}"
				),
				'recipients' => array( 
						array( 
							'address' => array('name' => 'Edward Street Parish', 'email' => 'info@cccedwardstreetparish.org')
						) 
				)
			));	
			
			try {
				$response = $promise->wait();
				echo json_encode(array('result' => 'ok', 'csrfTokenName' => $csrfTokenName, 'csrfHash' => $csrfHash));
			} catch (\Exception $e) {
				echo json_encode(array('result' => 'error', 'csrfTokenName' => $csrfTokenName, 'csrfHash' => $csrfHash));
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
