<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prayerrequestform extends CI_Controller {

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
    //Add rules for form fields
    $this->form_validation->set_rules('fullname', 'Full Name', 'max_length[30]|alpha_numeric_spaces|trim');//CodeIgnitor property that points to form validation class inorder to access the form validation method set_rules().                                                                                                    //1st parameter is name of field, the second parameter is the human readable name for the error message and the third parameter is a rule to be applied.
    $this->form_validation->set_rules('request', 'Request', 'max_length[700]|required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
    $this->form_validation->set_rules('firstname', 'Firstname', 'callback_check_empty');

    //the run() checks if any form validation rules are broken
    if($this->form_validation->run() == FALSE) {

        $this->output->set_status_header('400');//setting header status to 200 which means form request was successful
        $this->output->set_content_type('application/json');//setting the content type to application json


        $this->data['message'] = validation_errors();//Creating a key called message and setting it to the returned value of the validation_errors() method
        echo json_encode([
         'message' => $this->data['message'],
         'csrfTokenName' => $csrfTokenName,
         'csrfHash' => $csrfHash
        ]);//converts array into json format to display message on the client side
    }
    //get the value of the form fields and store it in each variable
    else {
      $this->output->set_content_type('application/json');
      $this->output->set_status_header('200');//sucessfull

      $subject = 'Prayer request';
      $fullname = $this->input->post('fullname');
      $email = $this->input->post('email');
      $request = $this->input->post('request');
      $variedname = empty($fullname) ? 'Anonymous' : $fullname;
      $textMessage = "Dear Edward Street Parish,\n\n{$request}\n\nkind regards,\n{$variedname}";
      $conclusion = !empty($fullname) ? 'kind regards,' . '<br>' . $fullname : 'kind regards,' . '<br>' . 'Anonymous';
      $promise = $sparkPost->transmissions->post(array(
        'content' => array(
          'from' => array('name' => 'Prayer Request', 'email' => 'prayer_request@cccedwardstreetparish.org'),
          'subject' => "{$subject}",
          'html' => "Dear Edward Street Parish,<br><br>{$request}<br><br>{$conclusion}",
          'text' => $textMessage,
          'reply_to' => "{$email}"
        ),
        'recipients' => array( 
            array( 
              'address' => array('name' => 'Emmanuel', 'email' => 'prayer_request@cccedwardstreetparish.org')
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

//custom validation check_empty method will pass the value of the firstname field that the spam bot could have entered
  public function check_empty($string) {
   if(empty($string)) {
    return true;//Spam bot has not entered this field
   } else {
    $this->form_validation->set_message('check_empty', 'The {field} field should be no longer than 50 characters');
    return false;//Spam bot has entered field
   }
  }
}
