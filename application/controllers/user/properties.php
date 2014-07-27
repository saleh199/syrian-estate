<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Properties extends CI_Controller {

	public function index()
	{
		$this->load->model('property_model');

		$results = $this->property_model->userPropertyList(1);

		foreach ($results as $index => $item) {
			$results[$index]->href_edit = site_url('user/properties/edit/'.$item->property_id);
		}

		$data['results'] = $results;

		$this->load->view('user/properties/list', $data);
	}

	public function add(){
		echo __method__;
	}

	public function edit(){
		$params = $this->uri->ruri_to_assoc(3);
		if(!isset($params['property_id'])){
			show_404();
		}

		$postData = array();

		if($this->input->post()){
			$postData = $this->input->post(NULL, TRUE);
		}

		$property_id = $params['property_id'];

		$this->load->model('property_model');
		$this->load->model('property_status_model', 'property_status');
		$this->load->model('property_type_model', 'property_type');
		$this->load->model('zone_model', 'zone');

		$property_info = $this->property_model->userPropertyInfo(1, $property_id);


		$data["form_action"] = form_open_multipart('user/properties/edit/'.$property_id, array("id" => "س", "class" => 'form-horizontal'));

		if(isset($property_info->title)){
			$property_title = $property_info->title;
		}elseif(isset($postData["title"])){
			$property_title = $postData["title"];
		}else{
			$property_title = '';
		}

		$data["input_title"] = form_input(array(
			"id" => "title",
			"name" => "title",
			"class" => "form-control",
			"value" => $property_title
		));

		if(isset($property_info->property_status_id)){
			$property_status_id = $property_info->property_status_id;
		}elseif(isset($postData["property_status_id"])){
			$property_status_id = $postData["property_status_id"];
		}else{
			$property_status_id = '';
		}

		$property_status_data = $this->property_status->dropdown();
		$data["dropdown_property_status"] = form_dropdown("property_status_id", $property_status_data, $property_status_id, 'id="property_status" class="form-control"');

		if(isset($property_info->property_type_id)){
			$property_type_id = $property_info->property_type_id;
		}elseif(isset($postData["property_type_id"])){
			$property_type_id = $postData["property_type_id"];
		}else{
			$property_type_id = '';
		}

		$property_type_data = $this->property_type->dropdown();
		$data["dropdown_property_type"] = form_dropdown("property_type_id", $property_type_data, '', 'id="property_type" class="form-control"');

		if(isset($property_info->price)){
			$price = $property_info->price;
		}elseif(isset($postData["price"])){
			$price = $postData["price"];
		}else{
			$price = '';
		}


		$data["input_price"] = form_input(array(
			"type"	=> "text",
			"name"	=> "price",
			"id"	=> "price",
			"class"	=> "form-control",
			"placeholder" => "سعر العقار",
			"value" => $price
		));

		if(isset($property_info->area)){
			$area = $property_info->area;
		}elseif(isset($postData["area"])){
			$area = $postData["area"];
		}else{
			$area = '';
		}

		$data["area_input"] = form_input(array(
			"type"	=> "text",
			"name"	=> "area",
			"id"	=> "area",
			"class"	=> "form-control",
			"placeholder" => "مساحة العقار",
			"value" => $area
		));

		if(isset($property_info->description)){
			$description = $property_info->description;
		}elseif(isset($postData["description"])){
			$description = $postData["description"];
		}else{
			$description = '';
		}

		$data["input_description"] = form_textarea(array(
			"name"	=> "description",
			"id"	=> "description",
			"class"	=> "form-control",
			"placeholder" => "وصف العقار",
			"rows"	=> 4,
			"value" => $description
		));

		if(isset($property_info->zone_id)){
			$zone_id = $property_info->zone_id;
		}elseif(isset($postData["zone_id"])){
			$zone_id = $postData["zone_id"];
		}else{
			$zone_id = '';
		}

		$zone_data = $this->zone->dropdown();
		$data["dropdown_zone"] = form_dropdown("zone_id", $zone_data, $zone_id, 'id="zone_id" class="form-control"');

		$this->load->view('user/properties/form', $data);
	}
}

/* End of file property.php */
/* Location: ./application/controllers/property.php */