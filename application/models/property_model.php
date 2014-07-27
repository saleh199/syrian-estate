<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class property_model extends MY_Model
{
	public $_table = "property";
	public $primary_key = "property_id";

	public $protected_attributes = array("property_id");

	public $before_create = array( "timestampInsert" ); // observer before create row
	public $before_update = array( "timestampUpdate" ); // observer before update

	public $after_get = array( "afterGet" ); // observer after get

	public $has_many = array(
		"images" => array("model" => "property_image_model")
	);

	public $belongs_to = array(
		"property_type" => array("model" => "property_type_model", "primary_key" => "property_type_id"),
		"property_status" => array("model" => "property_status_model", "primary_key" => "property_status_id"),
		"zone" => array("model" => "zone_model", "primary_key" => "zone_id")
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

		if(count($data->images) == 0){
			$data->image = base_url('assets/image/not-available.jpg');
		}else{
			$data->image = $data->images[0]->image_fullpath;
		}

		return $data;
	}

	public function userPropertyList($user_id){
		if(!empty($user_id) && $user_id != NULL){
			$result = $this->with('images')->with('property_status')->with('property_type')->with('zone')->order_by('date_added', 'DESC')->get_many_by(array("user_id" => intval($user_id)));

			return $result;
		}

		return array();
	}

	public function userPropertyInfo($user_id, $property_id){
		if(!empty($user_id) && $user_id != NULL){
			$result = $this->with('images')->with('property_status')->with('property_type')->with('zone')->get_by(array("user_id" => intval($user_id), "property_id" => intval($property_id)));

			return $result;
		}

		return array();
	}
}