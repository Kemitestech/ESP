<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');//to ensure that CodeIgnitor has booted up

class Mailchimp_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function addEmailToList($emailAddress, $listName = null, $listId = null, $url) {
        if(is_null($listId)) {//if the third parameter is null
            $listId = $this->getListId($listName);//$listId is assigned the getListId();
        }

        if(!is_null($listName) || !is_null($listId)) {//if is not null
          //Create a json format with key value pairs for the post request
            $data = json_encode([
                'header'=>'content-type: application/json',
                "email_address"=>$emailAddress,
                "status"=>"subscribed"
            ]);

            //first parameter is api end point to add subsciber to list and the second is the post fields in the format of json and will be checked in the send method
            $result = $this->send(
                $url.'lists/'.$listId.'/members', $data
            );

            $resultArray = json_decode($result);//the decode the response

            if(isset($resultArray->status)) {//if this key exists (status) in the json decoded $result=="subscribed" then return true
              //remenber that the send method returns a json format response that can be checked for the key status
                if($resultArray->status == "subscribed") {
                    return true;
                }
                //checks if the title and the status key is set and the trimmed version of the title is == "Members Exists".  If so then return false
                if(isset($resultArray->title) && isset($resultArray->status) && trim($resultArray->title)=="Member Exists") {
                  return false;
                }
                if(isset($resultArray->title) && $resultArray->title == 400 && trim($resultArray->title)=="Member Exists") {
                  return true;
                }
            }
        }
        return false;
    }

  //$listName and $url is passed to getListId method
    private function getListId($listName, $url) {
        $listID = null;
        $lists = $this->getAllLists($url);//get all lists in the form of json based on url.  base url for the API.
        $listResultArray = json_decode($lists);//decode the json list

        //
        if(isset($listResultArray->status)) {//accessing the status key of the array that is returned by getAllLists();.  If the status key exist then there was an error with response
            return $listID;//if the status key if set then $listID
        }

        if(isset($listResultArray->total_items) && $listResultArray->total_items > 0) {//checking if the totalitems key in the array exists and if the value is greater than 0.
            foreach($listResultArray->$lists as $list) {//loop through the total number of lists
              if(strtolower(str_replace(' ','', $listName)) == strtolower(str_replace(' ','', $list->name))) {//comparing $listName passed to getListId() to $list-> name key.
                  if(isset($list->id)) {//if the ID key of the list has a value
                    $listId = $list->id;//then $list->id will be assigned to listId
                    break;
                  }
              }
            }
        }
        return $listId;//return the listIs which will be null or contain the value
    }

    //gets all the list of the subscription lists
    private function getAllLists($url) {
        return $this->send($url.'lists?fields=lists.name,lists.id,total_items');//anything after ? is the query parameters
    }

    private function send($url, $args = null) {
        $ch = curl_init($url);// curl_init() starts curl session. Is a method client library for working with URLs
        //options for curl options
        //$ch variable needs to be passed in each option
        curl_setopt($ch, CURLOPT_USERPWD, "anystring:".getenv("MAILCHIMP_SECRET"));//Set username and password.
        curl_setopt($ch, CURLOPT_HEADER, false);//Tells curl to not include the header in the body output for the request
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//Effects what curl_exec returns.  Returns the actual response if set to true.
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//verifies if the hostname of the url has authentic ssl certificate

        if(!is_null($args)) {//set curl options if $arg is not null
          curl_setopt($ch, CURLOPT_POST, count($args));//_POST sets the request to a post request and the third parameter is the number of post fields for the request
          curl_setopt($ch, CURLOPT_POSTFIELDS, $args);//_POSTFIELDS set the field values and the third argument is the array of post fields
        }
        $data = curl_exec($ch);//executes the request
        // $headers = curl_getinfo($ch);
        return $data;//json response is stored in data
    }
}
