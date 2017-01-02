<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailchimp extends CI_Controller {

		public function __construct() {
			parent::__construct();
      $this->load->model('Mailchimp_model');
      $this->config->load('mailchimp_email');
		}

    public function index() {
				$this->load->library('email');
				$dotenv = new Dotenv\Dotenv(FCPATH);
				$dotenv->load();
				$mail_chimp_secret = getenv('SPARK_POST_SECRET');
        $csrfTokenName = $this->security->get_csrf_token_name().'';
        $csrfHash = $this->security->get_csrf_hash().'';

        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
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
            $email = $this->input->post('email');
            $listId = $this->config->item('list_id');
            $listName = $this->config->item('list_name');
            $url = $this->config->item('api_url');

            $response = $this->Mailchimp_model->addEmailToList($email, $listName, $listId, $url);

            $this->output->set_status_header('200');
            $this->output->set_content_type('application/json');

            if($response) {
              echo json_encode(['status' => true, 'csrfTokenName' => $csrfTokenName, 'csrfHash' => $csrfHash]);
            } else {
              echo json_encode(['status' => false, 'csrfTokenName' => $csrfTokenName, 'csrfHash' => $csrfHash]);
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
