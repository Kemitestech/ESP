<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailchimp_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function addEmailToList($emailAddress, $listName = null, $listId = null, $url) {
        if(is_null($listId)) {
            $listId = $this->getListId($listName);
        }

        if(!is_null($listName) || !is_null($listId)) {
            $data = json_encode([
                'header'=>'content-type: application/json',
                "email_address"=>$emailAddress,
                "status"=>"subscribed"
            ]);

            $result = $this->send(
                $url.'lists/'.$listId.'/members', $data
            );

            $resultArray = json_decode($result);

            if(isset($resultArray->status)) {
                if($resultArray->status == "subscribed") {
                    return true;
                }
                if(isset($resultArray->title) && $resultArray->title == 400 && trim($resultArray->title)=="Member Exists") {
                  return true;
                }
            }
        }
        return false;
    }

    private function getListId($listName, $url) {
        $listID = null;
        $lists = $this->getAllLists($url);
        $listResultArray = json_decode($lists);

        if(isset($listResultArray->status)) {
            return $listID;
        }

        if(isset($listResultArray->total_items) && $listResultArray->total_items > 0) {
            foreach($listResultArray->$lists as $list) {
              if(strtolower(str_replace(' ','', $listName)) == strtolower(str_replace(' ','', $list->name))) {
                  if(isset($list->id)) {
                    $listId = $list->id;
                    break;
                  }
              }
            }
        }
        return $listId;
    }

    private function getAllLists($url) {
        return $this->send($url.'lists?fields=lists.name,lists.id,total_items');
    }

    private function send($url, $args = null) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, "anystring:".getenv("MAILCHIMP_SECRET"));
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        if(!is_null($args)) {
          curl_setopt($ch, CURLOPT_POST, count($args));
          curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        }
        $data = curl_exec($ch);
        // $headers = curl_getinfo($ch);
        return $data;
    }
}
