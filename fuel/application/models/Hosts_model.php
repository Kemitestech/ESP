<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/Base_module_model.php');

class Hosts_model extends Base_module_model {
  public $parsed_fields = array('description', 'description_formatted');
  public $required = array('name', 'address');
  public $unique_fields = array('name');
  
  function __construct() {
    parent::__construct('hosts');
  }

  function list_items($limit = NULL, $offset = NULL, $col = 'name', $order = 'asc', $just_count = FALSE) {
    $this->db->select('id, name, address, SUBSTRING(description, 1, 50) AS description, published', FALSE);
    $data = parent::list_items($limit, $offset, $col, $order, $just_count);
    // check just_count is FALSE or else $data may not be a valid array
    if (empty($just_count)) {

      foreach($data as $key => $val) {
        $data[$key]['description'] = htmlentities($val['description'], ENT_QUOTES, 'UTF-8');
      }
    }

    return $data;
  }

}

class Host_model extends Base_module_record {

}
