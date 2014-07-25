<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends CI_Controller {

	public function addModal()
	{
		$this->load->model('property_status_model', 'property_status');
		$this->load->model('property_type_model', 'property_type');
		$this->load->model('zone_model', 'zone');

		$data["form_action"] = form_open_multipart('property/insert', array("id" => "addpropertyfrm"));

		$property_status_data = $this->property_status->dropdown();
		$data["property_status_dropdown"] = form_dropdown("property_status", $property_status_data, '', 'class="form-control"');

		$property_type_data = $this->property_type->dropdown();
		$data["property_type_dropdown"] = form_dropdown("property_type", $property_type_data, '', 'class="form-control"');

		$data["price_input"] = form_input(array(
			"type"	=> "text",
			"name"	=> "price",
			"class"	=> "form-control",
			"placeholder" => "سعر العقار",
		));

		$data["description_input"] = form_textarea(array(
			"name"	=> "description",
			"class"	=> "form-control",
			"placeholder" => "وصف العقار",
			"rows"	=> 4
		));

		$zone_data = $this->zone->dropdown();
		$data["zone_dropdown"] = form_dropdown("zone", $zone_data, '', 'class="form-control"');

		$data["image_input"] = form_upload(array(
			"name"	=> "image",
			"class"	=> "form-control",
			"placeholder" => "صورة العقار",
		));

		$this->load->view('property/modal/form', $data);
	}

	public function insert(){

	}
}

/* End of file property.php */
/* Location: ./application/controllers/property.php */