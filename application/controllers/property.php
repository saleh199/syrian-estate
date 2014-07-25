<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends CI_Controller {

	public function addModal()
	{
		$this->load->model('property_status_model', 'property_status');
		$this->load->model('property_type_model', 'property_type');
		$this->load->model('zone_model', 'zone');

		$data["form_action"] = form_open_multipart('property/insert', array("id" => "addpropertyfrm"));

		$property_status_data = $this->property_status->dropdown();
		$data["property_status_dropdown"] = form_dropdown("property_status", $property_status_data, '', 'id="property_status" class="form-control"');

		$property_type_data = $this->property_type->dropdown();
		$data["property_type_dropdown"] = form_dropdown("property_type", $property_type_data, '', 'id="property_type" class="form-control"');

		$data["price_input"] = form_input(array(
			"type"	=> "text",
			"name"	=> "price",
			"id"	=> "price",
			"class"	=> "form-control",
			"placeholder" => "سعر العقار",
		));

		$data["description_input"] = form_textarea(array(
			"name"	=> "description",
			"id"	=> "description",
			"class"	=> "form-control",
			"placeholder" => "وصف العقار",
			"rows"	=> 4
		));

		$zone_data = $this->zone->dropdown();
		$data["zone_dropdown"] = form_dropdown("zone_id", $zone_data, '', 'id="zone_id" class="form-control"');

		$data["image_input"] = form_upload(array(
			"name"	=> "image",
			"id"	=> "image",
			"class"	=> "form-control",
			"placeholder" => "صورة العقار",
		));

		$this->load->view('property/modal/form', $data);
	}

	public function insert(){
		$this->load->library("form_validation");
		$this->load->config("upload", TRUE);

		$json = array();

		$this->form_validation->set_rules('property_status', 'حالة العقار', 'trim|required');
		$this->form_validation->set_rules('property_type', 'نوع العقار', 'trim|required');
		$this->form_validation->set_rules('price', 'سعر العقار', 'trim|required');
		$this->form_validation->set_rules('description', 'وصع العقار', 'trim|required');
		$this->form_validation->set_rules('zone_id', 'المنطقة', 'trim|required');

		if ($this->form_validation->run() == TRUE){
			$json["result"] = 'success';
		}else{
			$json["result"] = 'fail';
			$json["errors"] = $this->form_validation->error_array();
		}

		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode($json));
	}

	public function _upload_image(){

	}
}

/* End of file property.php */
/* Location: ./application/controllers/property.php */