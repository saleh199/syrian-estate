<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class project_model extends MY_Model
{
	public $_table = "project";
	public $primary_key = "project_id";

	public $protected_attributes = array("project_id");

	public $before_create = array( "timestampInsert" ); // observer before create row
	public $before_update = array( "timestampUpdate" ); // observer before update

	protected function timestampInsert($data){
		$data["date_added"] = $data["date_modified"] = time();

		return $data;
	}

	protected function timestampUpdate($data){
		$data["date_modified"] = time();

		return $data;
	}
}