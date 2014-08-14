<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->model("project_model");
		$this->load->model("property_model");


		$data["featured"] = $this->property_model->getFeaturedProperties();

		$data['projects'] = $this->project_model->with('project_images')->get_many_by(array('status' => 1));

		$this->load->view('home', $data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */