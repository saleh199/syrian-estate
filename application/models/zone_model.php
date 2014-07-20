<?php

class zone_model extends MY_Model{

	public $_table = "zone"; // Table name
	public $primary_key = "zone_id"; // Table primary key

	public function dropdown(){
		$list = parent::dropdown($this->primary_key, "zone_name");

		return $list;
	}

	public function getZoneInfo($zone_id){
		$result = $this->as_object()->get($zone_id);
		
		return $result;
	}
}

?>