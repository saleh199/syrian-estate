<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class property_type_model extends MY_Model
{
	public $_table = "property_type";
	public $primary_key = "property_type_id";

	public $protected_attributes = array("property_type_id");

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
		$this->_database->order_by('property_type_name' , 'ASC');
		$list = parent::dropdown($this->primary_key, "property_type_name");
		$list = array('' => 'اختر نوع العقار') + $list;

		return $list;
	}

	public function getPropertyTypeName($property_type_id){
		$result = $this->as_object()->get($property_type_id);
		
		return $result->property_type_name;
	}
}