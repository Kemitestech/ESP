<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/Base_module_model.php');

class Events_model extends Base_module_model {
  public $foreign_keys  = array('host_id' => 'hosts_model', 'category_id' => array(FUEL_FOLDER => 'fuel_categories_model', 'where' => array('context' => 'event')));

  function __construct() {
    parent::__construct('events');
  }

  function list_items($limit = NULL, $offset = NULL, $col = 'name', $order = 'asc', $just_count = FALSE) {
    $this->db->select('id, title,	event_date, location, SUBSTRING(description, 1, 50) AS description, thumbnail_image,	published', FALSE);
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
    $fields['main_image']['folder'] = 'images/events/';
    $fields['thumbnail_image']['folder'] = 'images/events/thumbs/';
    $fields['list_image']['folder']   = 'images/events/lists/';

    $fields['Content'] = array('type' => 'fieldset', 'class' => 'tab');
    $fields['Images'] = array('type' => 'fieldset', 'class' => 'tab');
    $fields['Event Details'] = array('type' => 'fieldset', 'class' => 'tab');
    $fields['Settings'] = array('type' => 'fieldset', 'class' => 'tab');
    $fields['Associations'] = array('type' => 'fieldset', 'class' => 'tab');

    $fields['event_starttime']['label'] = 'Start time';
    $fields['event_endtime']['label'] = 'End time';
    $fields['location']['label'] = 'Address';
    $fields['host_id']['label'] = 'Host name';

    $order = array('Content',
      'title',
      'slug',
      'description',
      'published',
      'Event Details',
      'event_date',
      'event_starttime',
      'event_endtime',
      'host_id',
      'location',
      'Images',
      'main_image',
      'thumbnail_image',
      'list_image',
      'Settings',
      'publish_date',
      'Associations',
      'category_id'
    );

    foreach($order as $key => $val)
    {
      $fields[$val]['order'] = $key + 1;
    }

    return $fields;
  }

}

class Event_model extends Base_module_record {

}
