<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){
			redirect('admin/login');
		}
	}

	public function index()
	{
		$this->load->view('dashboard');
	}

	function logout()
	{
		$logout = $this->ion_auth->logout();

		redirect('admin/login', 'refresh');
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */