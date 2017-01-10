<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prayerrequestform extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $this->load->library('email');//loading amail library
    $dotenv = new Dotenv\Dotenv(FCPATH);//Creating new object with an argument.  Dotenv\ is unique identifier of a class
    $dotenv->load();//Using loading method from the Dotenv class to load environment variables into system environment
    $spark_post_username = getenv('SPARK_POST_USERNAME');//PHP method that gets environment variables by searching the systen environment based on the argument password_needs_rehash
    $spark_post_password = getenv('SPARK_POST_SECRET');

    $this->form_validation->set_rules('fullname', 'Full Name', 'min_length[3]|trim|alpha_numeric_spaces');//CodeIgnitor property that points to form validation class inorder to access the form validation method set_rules().
                                                                                                                    //1st parameter is name of field, the second parameter is the human readable name for the error message and the third parameter is a rule to be applied.
    $this->form_validation->set_rules('request', 'Request', 'trim|required|alpha_numeric_spaces');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('firstname', 'Firstname', 'callback_check_empty');
    //Add rules for form fields
    $csrfTokenName = $this->security->get_csrf_token_name().'';
    $csrfHash = $this->security->get_csrf_hash().'';
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
      $subject = 'Prayer request';
      $fullname = $this->input->post('fullname');
      $email = $this->input->post('email');
      $request = $this->input->post('request');

      $this->output->set_content_type('application/json');
      $this->output->set_status_header('200');//sucessfull

      //grabbing the global config so value can be set for the email configurations
      $config['protocol'] = 'smtp';//simple mail transfer protocol for.  It is an internet standard for email stransfer
      $config['charset'] = 'utf-8';//character set to utf-8; set of alowable characters
      $config['wordwrap'] = TRUE;//words can rap onto the next line at a certain point.
      $config['mailtype'] = "html";//email will contain html
      $config['crlf'] = "\r\n";//newline
      $config['newline'] = "\r\n";

      $config['smtp_host'] = 'smtp.sparkpostmail.com';//the host that is sending the prayer request form email.
      $config['smtp_user'] = $spark_post_username;//username of the account
      $config['smtp_pass'] = $spark_post_password;//password of the account is the API key
      $config['smtp_port'] = '587';//the potal to listen out for messages and connection
      $config['smtp_crypto'] = 'tls';//setting type of encryption key.

      $this->email->initialize($config);//initialises email library with the configuration settings
      $this->email->from('testing@sparkpostbox.com', $fullname);//first parameter is the address that the email will be sent from.  The second parameter is the person who sent the prayer request.
      $this->email->reply_to($email, $fullname);//Email address to reply to and the name of the person who sent prayer request.
      $this->email->to("info@cccedwardstreetparish.org");//Email address to send prayer requests to
      $this->email->subject($subject);//subject of email which is set to prayer request

      $conclusion = !empty($fullname) ? 'kind regards,' . '<br>' . $fullname : 'kind regards,' . '<br>' . 'Anonymous';

      $this->email->message('Dear Edward Street Parish,<br><br>' . $request . '<br><br>' . $conclusion);

      if(!$this->email->send()){
        echo json_encode(array('result' => 'error', 'csrfTokenName' => $csrfTokenName, 'csrfHash' => $csrfHash));
      }else{
        echo json_encode(array('result' => 'ok', 'csrfTokenName' => $csrfTokenName, 'csrfHash' => $csrfHash));
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
