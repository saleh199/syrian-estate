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

		$this->load->model('property_model');
		$this->load->library('form_validation');

		$postData = array();

		$this->form_validation->set_rules('property_id', 'رقم العقار', 'required|integer');
		$this->form_validation->set_rules('title', 'عنوان الإعلان', 'trim|required');
		$this->form_validation->set_rules('property_status_id', 'حالة العقار', 'required|integer');
		$this->form_validation->set_rules('property_type_id', 'نوع العقار', 'required|integer');
		$this->form_validation->set_rules('price', 'سعر العقار', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('area', 'مساحة العقار', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('description', 'وصف العقار', 'required|trim');
		$this->form_validation->set_rules('map_lat', 'إحداثيات الموقع', 'required');
		$this->form_validation->set_rules('map_lng', 'إحداثيات الموقع', 'required');
		$this->form_validation->set_rules('map_zoom', 'إحداثيات الموقع', 'required');

		if($this->input->post()){
			$postData = $this->input->post(NULL, TRUE);
		}

		$property_id = $params['property_id'];

		if ($this->form_validation->run() == TRUE){
			unset($postData['csrf_tkn']);
			if($this->property_model->update($property_id, $postData)){
				$data["success"] = 'تم حفظ المعلومات بنجاح';
			}
		}else{
			$data["errors"] = validation_errors();
		}

		$this->load->model('property_model');
		$this->load->model('property_status_model', 'property_status');
		$this->load->model('property_type_model', 'property_type');
		$this->load->model('zone_model', 'zone');

		$property_info = $this->property_model->userPropertyInfo(1, $property_id);


		$data["form_action"] = form_open_multipart('user/properties/edit/'.$property_id, array("id" => "propertyfrm", "class" => 'form-horizontal'), array("property_id" => $property_id));

		if(isset($postData["title"])){
			$property_title = $postData["title"];
		}elseif(isset($property_info->title)){
			$property_title = $property_info->title;
		}else{
			$property_title = '';
		}

		$data["input_title"] = form_input(array(
			"id" => "title",
			"name" => "title",
			"class" => "form-control",
			"value" => $property_title
		));

		if(isset($postData["property_status_id"])){
			$property_status_id = $postData["property_status_id"];
		}elseif(isset($property_info->property_status_id)){
			$property_status_id = $property_info->property_status_id;
		}else{
			$property_status_id = '';
		}

		$property_status_data = $this->property_status->dropdown();
		$data["dropdown_property_status"] = form_dropdown("property_status_id", $property_status_data, $property_status_id, 'id="property_status" class="form-control"');

		if(isset($postData["property_type_id"])){
			$property_type_id = $postData["property_type_id"];
		}elseif(isset($property_info->property_type_id)){
			$property_type_id = $property_info->property_type_id;
		}else{
			$property_type_id = '';
		}

		$property_type_data = $this->property_type->dropdown();
		$data["dropdown_property_type"] = form_dropdown("property_type_id", $property_type_data, '', 'id="property_type" class="form-control"');

		if(isset($postData["price"])){
			$price = $postData["price"];
		}elseif(isset($property_info->price)){
			$price = $property_info->price;
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

		if(isset($postData["area"])){
			$area = $postData["area"];
		}elseif(isset($property_info->area)){
			$area = $property_info->area;
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

		if(isset($postData["description"])){
			$description = $postData["description"];
		}elseif(isset($property_info->description)){
			$description = $property_info->description;
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

		if(isset($postData["address"])){
			$address = $postData["address"];
		}elseif(isset($property_info->address)){
			$address = $property_info->address;
		}else{
			$address = '';
		}

		$data["input_address"] = form_textarea(array(
			"name"	=> "address",
			"id"	=> "address",
			"class"	=> "form-control",
			"placeholder" => "العنوان",
			"rows"	=> 4,
			"value" => $address
		));

		if(isset($postData["services"])){
			$services = $postData["services"];
		}elseif(isset($property_info->services)){
			$services = $property_info->services;
		}else{
			$services = '';
		}

		$data["input_services"] = form_textarea(array(
			"name"	=> "services",
			"id"	=> "services",
			"class"	=> "form-control",
			"placeholder" => "الخدمات الملحقة",
			"rows"	=> 4,
			"value" => $services
		));

		if(isset($postData["zone_id"])){
			$zone_id = $postData["zone_id"];
		}elseif(isset($property_info->zone_id)){
			$zone_id = $property_info->zone_id;
		}else{
			$zone_id = '';
		}

		$zone_data = $this->zone->dropdown();
		$data["dropdown_zone"] = form_dropdown("zone_id", $zone_data, $zone_id, 'id="zone_id" class="form-control"');

		if(isset($postData["map_lat"])){
			$map_lat = $postData["map_lat"];
		}elseif(isset($property_info->map_lat)){
			$map_lat = $property_info->map_lat;
		}else{
			$map_lat = '';
		}

		$data["hidden_map_lat"] = form_hidden("map_lat", $map_lat);

		if(isset($postData["map_lng"])){
			$map_lng = $postData["map_lng"];
		}elseif(isset($property_info->map_lng)){
			$map_lng = $property_info->map_lng;
		}else{
			$map_lng = '';
		}

		$data["hidden_map_lng"] = form_hidden("map_lng", $map_lng);

		if(isset($postData["map_zoom"])){
			$map_zoom = $postData["map_zoom"];
		}elseif(isset($property_info->map_zoom)){
			$map_zoom = $property_info->map_zoom;
		}else{
			$map_zoom = '';
		}

		$data["hidden_map_zoom"] = form_hidden("map_zoom", $map_zoom);

		$this->load->view('user/properties/form', $data);
	}
}

/* End of file property.php */
/* Location: ./application/controllers/property.php */