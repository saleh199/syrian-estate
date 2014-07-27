<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Properties extends CI_Controller {

	public function index()
	{
		$this->load->view('user/properties/list');
	}

	public function add(){
		echo __method__;
	}

	public function edit($property_id = 0){
		echo __method__;
	}
}

/* End of file property.php */
/* Location: ./application/controllers/property.php */