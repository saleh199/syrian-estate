<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Properties extends CI_Controller {

	public function index()
	{
		$filter = $data = array();

		$this->load->model('property_model');

		if($this->input->get('status')){
			$filter['status'] = intval($this->input->get('status'));
		}

		$data['results'] = $this->property_model->with('images')->with('zone')->get_many_by($filter);
		//print "<pre>";var_dump($data['results'][0]);die;

		$this->load->view('properties', $data);
	}
}

/* End of file properties.php */
/* Location: ./application/controllers/properties.php */