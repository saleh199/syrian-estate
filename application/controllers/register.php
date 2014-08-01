<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index()
	{
		$data = array();

		$tables = $this->config->item('tables','ion_auth');

		//validate form input
		$this->form_validation->set_rules('first_name', 'الاسم الاول', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'الكنية', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'البريد الإلكتروني', 'required|valid_email|is_unique['.$tables['users'].'.email]');
		$this->form_validation->set_rules('phone', 'رقم الموبايل', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'كلمة المرور', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'تأكيد كلمة المرور', 'required');

		if ($this->form_validation->run() == true)
		{
			$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'phone'      => $this->input->post('phone'),
			);
			
		}
		if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
		{
			redirect("user/properties", 'refresh');
		}else
		{
			$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$data["form_action"] = form_open("register", array("method" => "post"));

			$data["input_firstname"] = form_input(array(
				"type" => "text",
				"name" => "first_name",
				"class" => "form-control",
				"placeholder" => "الاسم الاول",
				"value" => $this->form_validation->set_value('first_name')
			));

			$data["input_lastname"] = form_input(array(
				"type" => "text",
				"name" => "last_name",
				"class" => "form-control",
				"placeholder" => "الكنية",
				"value" => $this->form_validation->set_value('last_name')
			));

			$data["input_email"] = form_input(array(
				"type" => "text",
				"name" => "email",
				"class" => "form-control",
				"placeholder" => "البريد الإلكتروني",
				"value" => $this->form_validation->set_value('email')
			));

			$data["input_phone"] = form_input(array(
				"type" => "text",
				"name" => "phone",
				"class" => "form-control",
				"placeholder" => "رقم الموبايل",
				"value" => $this->form_validation->set_value('phone')
			));

			$data["input_password"] = form_input(array(
				"type" => "password",
				"name" => "password",
				"class" => "form-control",
				"placeholder" => "كلمة المرور"
			));

			$data["input_passwordconfirm"] = form_input(array(
				"type" => "password",
				"name" => "password_confirm",
				"class" => "form-control",
				"placeholder" => "تأكيد كلمة المرور"
			));
		}

		$this->load->view('register', $data);
	}
}

/* End of file register.php */
/* Location: ./application/controllers/register.php */