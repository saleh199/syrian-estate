<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class property_model extends MY_Model
{
	public $_table = "property";
	public $primary_key = "property_id";

	public $protected_attributes = array("property_id");

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
}