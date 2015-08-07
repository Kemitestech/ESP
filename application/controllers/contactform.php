<?php

class Contactform extends CI_Controlller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
    	//set validation rules
    	echo ('hi')

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