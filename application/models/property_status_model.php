<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class property_status_model extends MY_Model
{
	public $_table = "property_status";
	public $primary_key = "property_status_id";

	public $protected_attributes = array("property_status_id");

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
		$this->_database->order_by('property_status_name' , 'ASC');
		$list = parent::dropdown($this->primary_key, "property_status_name");

		return $list;
	}

	public function getPropertyStatusName($property_status_id){
		$result = $this->as_object()->get($property_status_id);
		
		return $result->property_status_name;
	}
}