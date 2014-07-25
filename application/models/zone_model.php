<?php

class zone_model extends MY_Model{

	public $_table = "zone"; // Table name
	public $primary_key = "zone_id"; // Table primary key

	public $before_create = array( "timestampInsert" ); // observer before create row
	public $before_update = array( "timestampUpdate" ); // observer before 

	protected function timestampInsert($data){
		$data["date_added"] = $data["date_modified"] = time();

		return $data;
	}

	protected function timestampUpdate($data){
		$data["date_modified"] = time();

		return $data;
	}

	public function dropdown(){
		$this->_database->order_by('zone_name' , 'ASC');
		$list = parent::dropdown($this->primary_key, "zone_name");

		return $list;
	}

	public function getZoneInfo($zone_id){
		$result = $this->as_object()->get($zone_id);
		
		return $result;
	}
}

?>