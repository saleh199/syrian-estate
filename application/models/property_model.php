<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class property_model extends MY_Model
{
	public $_table = "property";
	public $primary_key = "property_id";

	public $protected_attributes = array("property_id", "status");

	public $before_create = array( "timestampInsert" ); // observer before create row
	public $before_update = array( "timestampUpdate" ); // observer before update

	public $after_get = array( "afterGet" ); // observer after get

	public $has_many = array(
		"images" => array("model" => "property_image_model", "primary_key" => "property_id")
	);

	public $belongs_to = array(
		"property_type" => array("model" => "property_type_model", "primary_key" => "property_type_id"),
		"property_status" => array("model" => "property_status_model", "primary_key" => "property_status_id"),
		"zone" => array("model" => "zone_model", "primary_key" => "zone_id"),
		"user" => array("model" => "ion_auth_model", "primary_key" => "user_id")
	);

	protected function timestampInsert($data){
		$data["date_added"] = $data["date_modified"] = time();

		if($data['ref_number'] == ''){
			$data['ref_number'] = NULL;
		}

		return $data;
	}

	protected function timestampUpdate($data){
		$data["date_modified"] = time();

		if($data['ref_number'] == ''){
			$data['ref_number'] = NULL;
		}

		return $data;
	}

	protected function afterGet($data){
		$this->load->helper("date");

		$data->date_added_human = unix_to_human($data->date_added, FALSE);
		$data->date_modified_human = unix_to_human($data->date_modified, FALSE);

		if(!property_exists($data, 'images')){
			$data->image = base_url('assets/image/not-available.jpg');
		}else{
			if(is_array($data->images) && count($data->images) > 0){
				$data->image = $data->images[0]->image_fullpath;
			}else{
				$data->image = base_url('assets/image/not-available.jpg');
			}
		}
		
		$data->google_map_static_image = site_url('property/static_img/'.$data->property_id);

		unset(
			$data->user->password,
			$data->user->salt, 
			$data->user->activation_code, 
			$data->user->forgotten_password_code, 
			$data->user->forgotten_password_time, 
			$data->user->remember_code
		);

		$data->property_view_href = site_url("property/view/" . $data->property_id);

		if($data->ref_number == NULL){
			$data->ref_number = 'غير موثوق';
		}

		return $data;
	}

	public function getPropertyList($filter, $order = array('date_added' => 'DESC'), $limit = 1000){
		$results = $this->with('images')
						->with('property_status')
						->with('property_type')
					   	->with('zone')
					   	->with('user')
					   	->order_by($order)
					   	->limit($limit)
					   	->get_many_by($filter);

		return $results;
	}

	public function getPropertyInfo($property_id){
		$results = $this->getPropertyList(array('status' => 1, 'property_id' => $property_id));

		if($results){
			return $results[0];
		}

		return array();
	}

	public function userPropertyList($user_id){
		if(!empty($user_id) && $user_id != NULL){
			$result = $this->getPropertyList(array("user_id" => intval($user_id)));

			return $result;
		}

		return array();
	}

	public function userPropertyInfo($user_id, $property_id){
		if(!empty($user_id) && $user_id != NULL){
			$results = $this->getPropertyList(array("user_id" => intval($user_id), "property_id" => intval($property_id)));

			if($results){
				return $results[0];
			}
		}

		return array();
	}

	public function getFeaturedProperties($limit = 4){
		$results = $this->getPropertyList(array("featured" => 1, "status" => 1), array('date_modified' => 'DESC'), $limit);

		if($results){
			return $results;
		}

		return array();
	}
}