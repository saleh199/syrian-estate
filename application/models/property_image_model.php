<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class property_image_model extends MY_Model
{
	public $_table = "property_image";
	public $primary_key = "property_image_id";

	public $protected_attributes = array("property_image_id");

	public $before_create = array( "timestampInsert" ); // observer before create row
	public $before_update = array( "timestampUpdate" ); // observer before update

	public $after_get = array( "afterGet" );

	protected function timestampInsert($data){
		$data["date_added"] = $data["date_modified"] = time();

		return $data;
	}

	protected function timestampUpdate($data){
		$data["date_modified"] = time();

		return $data;
	}

	protected function afterGet($data) {
		$this->load->config('upload', TRUE);

		if(!file_exists($this->config->item('upload_path', 'upload') . $data->property_id . '/' . $data->filename)){
			$data->image_fullpath = base_url('assets/image/not-available.jpg');
		}else{
			$data->image_fullpath = base_url('assets/upload/' . $data->property_id . '/' . $data->filename);
		}
		
		return $data;
	}
}