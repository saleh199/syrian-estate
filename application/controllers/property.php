<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends CI_Controller {

	public function addModal()
	{
		$this->load->view('property/modal/form');
	}
}

/* End of file property.php */
/* Location: ./application/controllers/property.php */