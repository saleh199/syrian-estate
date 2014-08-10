<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->model("property_model");

		$data["featured"] = $this->property_model->getFeaturedProperties();

		$this->load->view('home', $data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */