<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class project_model extends MY_Model
{
	public $_table = "project";
	public $primary_key = "project_id";

	public $protected_attributes = array("project_id", "status");

	public $before_create = array( "timestampInsert" ); // observer before create row
	public $before_update = array( "timestampUpdate" ); // observer before update
	public $after_get = array( "afterGet" ); // observer after get

	public $has_many = array(
		"project_images" => array("model" => "project_image_model", "primary_key" => "project_id")
	);

	public $belongs_to = array(
		"zone" => array("model" => "zone_model", "primary_key" => "zone_id"),
	);

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

		if(!property_exists($data, 'project_images')){
			$data->image = base_url('assets/image/not-available.jpg');
		}else{
			if(is_array($data->project_images) && count($data->project_images) > 0){
				$data->image = $data->project_images[0]->image_fullpath;
			}else{
				$data->image = base_url('assets/image/not-available.jpg');
			}
		}
		
		//$data->google_map_static_image = site_url('property/static_img/'.$data->property_id);

		//$data->property_view_href = site_url("property/view/" . $data->property_id);

		return $data;
	}
}