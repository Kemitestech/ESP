<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/Base_module_model.php');

class Quotations_model extends Base_module_model {

	public $filters = array('bible_verse');
	public $filters_join = 'or';
	public $required = array('description','bible_verse');
	public $parsed_fields = array('description');


	function __construct()
    {
        parent::__construct('quotations');
    }

	function list_items($limit = NULL, $offset = NULL, $col = 'name', $order = 'asc', $just_count = FALSE)
	{
		$this->db->select('id, SUBSTRING(description, 1, 50) AS description, bible_verse, date_added, published', FALSE);
        $data = parent::list_items($limit, $offset, $col, $order, $just_count);

		if (empty($just_count))
        {
          foreach($data as $key => $val)
          {
            $data[$key]['description'] = htmlentities($val['description'], ENT_QUOTES, 'UTF-8');
          }
        }
        return $data;
	}

	function tree()
	{
		return $this->_tree('has_many');
	}

}

class Quotation_model extends Base_module_record {

}
