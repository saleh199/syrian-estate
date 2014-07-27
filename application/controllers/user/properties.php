<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Properties extends CI_Controller {

	public function index()
	{
		$this->load->model('property_model');

		$data["results"] = $this->property_model->userPropertyList(1);

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

		
	}
}

/* End of file property.php */
/* Location: ./application/controllers/property.php */