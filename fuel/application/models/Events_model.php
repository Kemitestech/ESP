<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/Base_module_model.php');

class Events_model extends Base_module_model {
  public $record_class = 'Event';
  public $foreign_keys  = array('host_id' => 'hosts_model', 'category_id' => array(FUEL_FOLDER => 'fuel_categories_model', 'where' => array('context' => 'events')));
  public $has_many = array('tags' => array(FUEL_FOLDER => 'fuel_tags_model'));
  public $unique_fields = array('slug');
  public $parsed_fields = array('description', 'description_formatted');
  public $required = array('title',
                'slug',
                'description',
                'event_startdate',
                'event_endtime',
                'host_id',
                'location',
      );

  function __construct() {
    parent::__construct('events');
  }

  function list_items($limit = NULL, $offset = NULL, $col = 'title', $order = 'asc', $just_count = FALSE) {
    $sql = 'events.id, events.title, events.event_startdate as start_date, events.location, SUBSTRING(events.description, 1, 50) AS description, events.published';
    $this->db->select($sql, FALSE);
    $data = parent::list_items($limit, $offset, $col, $order, $just_count);
    // check just_count is FALSE or else $data may not be a valid array
    if (!$just_count)
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
    $fields['list_image']['folder'] = 'images/events/lists/';
    $fields['description']['img_folder'] = 'events/';

    $fields['Content'] = array('type' => 'fieldset', 'class' => 'tab');
    $fields['Images'] = array('type' => 'fieldset', 'class' => 'tab');
    $fields['Event Details'] = array('type' => 'fieldset', 'class' => 'tab');
    $fields['Settings'] = array('type' => 'fieldset', 'class' => 'tab');
    $fields['Associations'] = array('type' => 'fieldset', 'class' => 'tab');

    $fields['event_startdate']['label'] = 'Start date';
    $fields['event_enddate']['label'] = 'End date';
    $fields['event_endtime']['label'] = 'End time';
    $fields['location']['label'] = 'Address';
    $fields['host_id']['label'] = 'Host name';

    $order = array('Content',
      'title',
      'slug',
      'description',
      'published',
      'Event Details',
      'event_startdate',
      'event_enddate',
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
      'category_id',
      'tags'
    );

    foreach($order as $key => $val) {
      $fields[$val]['order'] = $key + 1;
    }

    return $fields;
  }

  function tree() {
    return $this->_tree('foreign_keys');
  }

  public function find_upcoming($limit = NULL, $offset = NULL) {
    return $this->find_all(array('event_startdate >=' => datetime_now()), NULL, $limit, $offset);
  }
}

class Event_model extends Base_module_record {

  public function get_url() {
    return site_url('events/'.$this->slug);
  }

  public function get_main_image_path() {
    return img_path('events/'.$this->main_image);
  }

  public function get_list_image_path() {
    return img_path('events/lists/'.$this->list_image);
  }

  public function get_thumbnail_image_path() {
    return img_path('events/thumbs/'.$this->thumb_image);
  }

}
