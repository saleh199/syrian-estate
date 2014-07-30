<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller {

	public function index()
	{
		$this->load->model(array('property_model', 'zone_model', 'property_status_model', 'property_type_model'));

		$data = array();

		$data["form_action"] = form_open(base_url('map/search'), array("method" => 'get'));

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
}

/* End of file map.php */
/* Location: ./application/controllers/map.php */