<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
			redirect('admin/dashboard');
		}
	}

	public function index()
	{
		$data = array();

		//validate form input
		$this->form_validation->set_rules('email', 'البريد الإلكتروني', 'required');
		$this->form_validation->set_rules('password', 'كلمة المرور', 'required');

		if ($this->form_validation->run() == true)
		{
			$remember = TRUE;

			if ($this->ion_auth_model->login($this->input->post('email'), $this->input->post('password'), $remember, TRUE))
			{
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('admin/dashboard', 'refresh');
			}
			else
			{
				//if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('admin/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}else{
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data["form_action"] = form_open("admin/login", array("method" => "post", "class" => 'form-signin'));

			$data["input_email"] = form_input(array(
				"type" => "text",
				"name" => "email",
				"class" => "form-control",
				"placeholder" => "البريد الإلكتروني",
				"value" => $this->form_validation->set_value('email')
			));

			$data["input_password"] = form_input(array(
				"type" => "password",
				"name" => "password",
				"class" => "form-control",
				"placeholder" => "كلمة المرور"
			));

		}

		$this->load->view('login', $data);
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */