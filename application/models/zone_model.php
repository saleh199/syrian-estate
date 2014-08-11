<?php

class zone_model extends MY_Model{

	public $_table = "zone"; // Table name
	public $primary_key = "zone_id"; // Table primary key

	public $before_create = array( "timestampInsert" ); // observer before create row
	public $before_update = array( "timestampUpdate" ); // observer before 
	public $after_get = array( "afterGet" ); // observer after get

	protected function timestampInsert($data){
		$data["date_added"] = $data["date_modified"] = time();

		return $data;
	}

	protected function timestampUpdate($data){
		$data["date_modified"] = time();

		return $data;
	}

	protected function afterGet($data){
		$this->load->helper("date");

		$data->date_added_human = unix_to_human($data->date_added, FALSE);
		$data->date_modified_human = unix_to_human($data->date_modified, FALSE);

		return $data;
	}

	public function dropdown(){
		$this->_database->order_by('zone_name' , 'ASC');
		$list = parent::dropdown($this->primary_key, "zone_name");
		$list = array('' => 'اختر المنطقة') + $list;

		return $list;
	}

	public function getZoneInfo($zone_id){
		$result = $this->as_object()->get($zone_id);
		
		return $result;
	}
}

?>