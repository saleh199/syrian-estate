<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public $user_group = 2;

	public function __construct(){
		parent::__construct();

		if(!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){
			redirect('admin/login');
		}

		$params = $this->uri->ruri_to_assoc(3);

		$this->user_group = $params['user_group'];

		$group_info = $this->ion_auth_model->group($this->user_group)->result();
		$group_info = $group_info[0];

		$this->list_btn = site_url('admin/user/'.$group_info->name);
		$this->delete_btn = site_url('admin/user/'.$group_info->name.'/delete');
		$this->update_btn = site_url('admin/user/'.$group_info->name.'/update/');
		$this->insert_btn = site_url('admin/user/'.$group_info->name.'/insert');
	}

	public function index()
	{
		$filter = $data = array();

		$this->load->model('ion_auth_model');

		if($this->input->get('id')){
			$filter['id'] = intval($this->input->get('id'));
		}

		$data['message'] = ($this->session->flashdata('message')) ? '' : $this->session->flashdata('message');

		$query = $this->ion_auth_model->order_by('id', 'DESC')->users($this->user_group);

		$data["results"] = $query->result();

		$data['delete_btn'] = $this->delete_btn;
		$data['update_btn'] = $this->update_btn;
		$data['insert_btn'] = $this->insert_btn;

		$this->load->view('user/list', $data);
	}

	public function update(){
		$params = $this->uri->ruri_to_assoc(3);
		$id = $params['id'];

		$data = array();

		$this->load->model('ion_auth_model');
		$this->load->library('form_validation');

		$user_info = $this->ion_auth_model->user($id);

		$user_info = $user_info->result()[0];

		$this->form_validation->set_rules('id', 'رقم المستخدم', 'required|integer');
		$this->form_validation->set_rules('first_name', 'الاسم الاول', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'الكنية', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'البريد الإلكتروني', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'رقم الهاتف', 'trim|required|xss_clean');
		

		if($this->input->post('password')){
			$this->form_validation->set_rules('password', 'كلمة المرور', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', 'تأكيد كلمة المرور', 'trim|required|xss_clean|matches[password]');			
		}


		if ($this->form_validation->run() == TRUE){
			$update_data = array(
				"first_name" => $this->input->post('first_name', TRUE),
				"last_name" => $this->input->post('last_name'),
				"email" => $this->input->post('email'),
				"phone" => $this->input->post('phone'),
			);
			
			//$this->ion_auth_model->protected_attributes = array();
			if($this->ion_auth_model->update($id, $update_data)){
				redirect($this->list_btn, 'refresh');
			}

		}else{
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data["form_action"] = form_open($this->update_btn . '/' . $id, array("id" => "userfrm"), array("id" => $id));

			$data["input_first_name"] = form_input(array(
				"id" => "first_name",
				"name" => "first_name",
				"class" => "form-control",
				"placeholder" => "الاسم الاول",
				"value" => $this->form_validation->set_value('first_name', $user_info->first_name)
			));

			$data["input_last_name"] = form_input(array(
				"id" => "last_name",
				"name" => "last_name",
				"class" => "form-control",
				"placeholder" => "الكنية",
				"value" => $this->form_validation->set_value('last_name', $user_info->last_name)
			));


			$data["input_email"] = form_input(array(
				"type" => "email",
				"id" => "email",
				"name" => "email",
				"class" => "form-control",
				"rows" => 4,
				"placeholder" => "البريد الإلكتروني",
				"value" => $this->form_validation->set_value('email', $user_info->email)
			));

			$data["input_phone"] = form_input(array(
				"name"	=> "phone",
				"id"	=> "phone",
				"class"	=> "form-control",
				"placeholder" => "رقم الهاتف",
				"rows"	=> 4,
				"value" => $this->form_validation->set_value('phone', $user_info->phone)
			));


			$data["input_password"] = form_password(array(
				"name"	=> "password",
				"id"	=> "password",
				"class"	=> "form-control",
				"placeholder" => "كلمة المرور",
			));

			$data["input_password_confirm"] = form_password(array(
				"name"	=> "password_confirm",
				"id"	=> "password_confirm",
				"class"	=> "form-control",
				"placeholder" => "تأكيد كلمة المرور",
			));

		}

		$this->load->view('user/form', $data);
	}

	public function insert(){

		$data = array();

		$this->load->model('ion_auth_model');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('first_name', 'الاسم الاول', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'الكنية', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'البريد الإلكتروني', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('phone', 'رقم الهاتف', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'كلمة المرور', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'تأكيد كلمة المرور', 'trim|required|xss_clean|matches[password]');


		if ($this->form_validation->run() == TRUE){
			$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
			$password = $this->input->post('password');
			$email = $this->input->post('email');

			$insert_data = array(
				"first_name" => $this->input->post('first_name', TRUE),
				"last_name" => $this->input->post('last_name', TRUE),
				"phone" => $this->input->post('phone')
			);
			
			//$this->ion_auth_model->protected_attributes = array();
			if($this->ion_auth->register($username, $password, $email, $insert_data)){
				redirect($this->list_btn, 'refresh');
			}

		}else{
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data["form_action"] = form_open($this->insert_btn, array("id" => "userfrm"));

			$data["input_first_name"] = form_input(array(
				"id" => "first_name",
				"name" => "first_name",
				"class" => "form-control",
				"placeholder" => "الاسم الاول",
				"value" => $this->form_validation->set_value('first_name')
			));

			$data["input_last_name"] = form_input(array(
				"id" => "last_name",
				"name" => "last_name",
				"class" => "form-control",
				"placeholder" => "الكنية",
				"value" => $this->form_validation->set_value('last_name')
			));


			$data["input_email"] = form_input(array(
				"type" => "email",
				"id" => "email",
				"name" => "email",
				"class" => "form-control",
				"rows" => 4,
				"placeholder" => "البريد الإلكتروني",
				"value" => $this->form_validation->set_value('email')
			));

			$data["input_phone"] = form_input(array(
				"name"	=> "phone",
				"id"	=> "phone",
				"class"	=> "form-control",
				"placeholder" => "رقم الهاتف",
				"rows"	=> 4,
				"value" => $this->form_validation->set_value('phone')
			));


			$data["input_password"] = form_password(array(
				"name"	=> "password",
				"id"	=> "password",
				"class"	=> "form-control",
				"placeholder" => "كلمة المرور",
			));

			$data["input_password_confirm"] = form_password(array(
				"name"	=> "password_confirm",
				"id"	=> "password_confirm",
				"class"	=> "form-control",
				"placeholder" => "تأكيد كلمة المرور",
			));

		}

		$this->load->view('user/form', $data);
	}

}

/* End of file properties.php */
/* Location: ./application/controllers/user.php */