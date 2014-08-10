<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller {

	public function index()
	{
		$this->load->model(array('property_model', 'zone_model', 'property_status_model', 'property_type_model'));

		$data = array();

		$data["form_action"] = form_open(base_url('map/search'), array("method" => 'get', "id"=>"mapsearchfrm"));

		$zoneData = $this->zone_model->dropdown();
		$data["dropdown_zone"] = form_dropdown(
			"zone_id",
			$zoneData,
			'',
			'id="zone_id" class="form-control"'
		);

		$propertyTypeData = $this->property_type_model->dropdown();
		$data["dropdown_property_type"] = form_dropdown(
			"property_type_id",
			$propertyTypeData,
			'',
			'id="property_type_id" class="form-control"'
		);

		$propertyStatusData = $this->property_status_model->dropdown();
		$data["dropdown_property_status"] = form_dropdown(
			"property_status_id",
			$propertyStatusData,
			'',
			'id="property_status_id" class="form-control"'
		);

		$data['input_max_price'] = form_input(array(
			'type' => 'number',
			'name' => 'max_price',
			'class' => 'form-control',
			'placeholder' => 'أعلى سعر'
		));

		$data['input_min_price'] = form_input(array(
			'type' => 'number',
			'name' => 'min_price',
			'class' => 'form-control',
			'placeholder' => 'أقل سعر'
		));


		$this->load->view('map', $data);
	}

	public function search(){
		if(!$this->input->is_ajax_request()){
			//show_404();
		}

		$this->load->model('property_model');

		$json = array();
		$filter = array();

		$inputData = $this->input->get(NULL, TRUE);

		if(isset($inputData["property_type_id"]) && intval($inputData["property_type_id"]) > 0){
			$filter["property_type_id"] = intval($inputData["property_type_id"]);
		}

		if(isset($inputData["property_status_id"]) && intval($inputData["property_status_id"])){
			$filter["property_status_id"] = intval($inputData["property_status_id"]);
		}

		if(isset($inputData["zone_id"]) && intval($inputData["zone_id"])){
			$filter["zone_id"] = intval($inputData["zone_id"]);
		}

		if(isset($inputData["min_price"]) && intval($inputData["min_price"])){
			$filter["price >= "] = intval($inputData["min_price"]);
		}

		if(isset($inputData["max_price"]) && intval($inputData["max_price"])){
			$filter["price <= "] = intval($inputData["max_price"]);
		}

		$filter["status"] = 1;

		$json["results"] = $this->property_model->with('images')->get_many_by($filter);

		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode($json));
	}
}

/* End of file map.php */
/* Location: ./application/controllers/map.php */