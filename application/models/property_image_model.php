<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class property_image_model extends MY_Model
{
	public $_table = "property_image";
	public $primary_key = "property_image_id";

	public $protected_attributes = array("property_image_id");

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