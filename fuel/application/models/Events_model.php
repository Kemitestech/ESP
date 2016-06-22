<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/Base_module_model.php');

class Events_model extends Base_module_model {
  public $foreign_keys  = array('category_id' => array(FUEL_FOLDER => 'fuel_categories_model'));

  function __construct() {
    parent::__construct('events');
  }

  function list_items($limit = NULL, $offset = NULL, $col = 'name', $order = 'asc', $just_count = FALSE) {
    $this->db->select('id, title,	SUBSTRING(description, 1, 50) AS description, event_date, thumbnail_image,	published', FALSE);
    $data = parent::list_items($limit, $offset, $col, $order, $just_count);
    // check just_count is FALSE or else $data may not be a valid array
    if (empty($just_count))
    {
      foreach($data as $key => $val)
      {
        $data[$key]['description'] = htmlentities($val['description'], ENT_QUOTES, 'UTF-8');
      }
    }
    return $data;
  }

  function form_fields($values = array(), $related = array()) {
    $fields = parent::form_fields($values, $related);

    // ******************* ADD CUSTOM FORM STUFF HERE *******************
    $fields['content']['img_folder'] = 'events/';
    $fields['image']['folder'] = 'images/events/';
    $fields['thumbnail_image']['folder'] = 'images/articles/thumbs/';
    $fields['list_image']['folder'] = 'images/articles/lists/';

    return $fields;
  }

}

class Event_model extends Base_module_record {

}
