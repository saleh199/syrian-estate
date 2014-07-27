<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Properties extends CI_Controller {

	public function index()
	{
		$this->load->view('user/properties/list');
	}

	public function info(){
		print "ss";
	}
}

/* End of file property.php */
/* Location: ./application/controllers/property.php */