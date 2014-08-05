<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	public function index()
	{
		$this->load->model("zone_model");
		$this->load->library('recaptcha');

		$data = array();

		$this->form_validation->set_rules('project_name', 'اسم المشروع', 'trim|required|xss_clean');
		$this->form_validation->set_rules('zone_id', 'المنطقة', 'required|integer');
		$this->form_validation->set_rules('company_name', 'اسم الشركة', 'trim|required|xss_clean');
		$this->form_validation->set_rules('company_type', 'نوع الشركة', 'trim|required|xss_clean');
		$this->form_validation->set_rules('person_name', 'اسمك', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'البريد الإلكتروني', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('mobile', 'رقم الهاتف', 'trim|required|xss_clean');
		$this->form_validation->set_rules('recaptcha_challenge_field', 'رمز التحقق', 'callback__check_recaptcha');

		if ($this->form_validation->run() == TRUE){

		}else{
			
		}

		$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

		$data["form_action"] = form_open("project", "post");

		$data["input_project_name"] = form_input(array(
			"type" => "text",
			"name" => "project_name",
			"class" => "form-control",
			"placeholder" => "اسم المشروع"
		));

		$zones = $this->zone_model->dropdown();
		$data["input_zone_dropdown"] = form_dropdown("zone_id", $zones, '', 'class="form-control"');

		$data["input_company_name"] = form_input(array(
			"type" => "text",
			"name" => "company_name",
			"class" => "form-control",
			"placeholder" => "اسم الشركة"
		));

		$company_types = array(
			" " => "اختر نوع الشركة",
			"a" => "مطورة",
			"b" => "مسوق",
			"c" => "وسيط عقاري",
			"d" => "فردي"
		);
		$data["input_company_types_dropdown"] = form_dropdown("company_type", $company_types, '', 'class="form-control"');

		$data["input_person_name"] = form_input(array(
			"type" => "text",
			"name" => "person_name",
			"class" => "form-control",
			"placeholder" => "اسمك"
		));

		$data["input_email"] = form_input(array(
			"type" => "email",
			"name" => "email",
			"class" => "form-control",
			"placeholder" => "البريد الإلكتروني"
		));

		$data["input_mobile"] = form_input(array(
			"type" => "text",
			"name" => "mobile",
			"class" => "form-control",
			"placeholder" => "رقم الهاتف"
		));

		$data["input_recaptcha"] = $this->recaptcha->recaptcha_get_html(RECAPTCHA_PUBLIC_KEY);

		$this->load->view('project', $data);
	}

	public function _check_recaptcha(){
		$result = $this->recaptcha->recaptcha_check_answer(RECAPTCHA_PRIVATE_KEY,
			$this->input->ip_address(),
			$this->input->post('recaptcha_challenge_field'),
			$this->input->post('recaptcha_response_field'));

		if(!$result->is_valid){
			$this->form_validation->set_message('_check_recaptcha', $result->error);
			return FALSE;
		}else{
			return TRUE;
		}
	}
}

/* End of file project.php */
/* Location: ./application/controllers/project.php */