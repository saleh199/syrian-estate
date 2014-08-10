<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	public function index()
	{
		$this->load->model("zone_model");
		$this->load->model("project_model");
		$this->load->library('recaptcha');

		$data = array();

		$data['message'] = '';

		$this->form_validation->set_rules('project_name', 'اسم المشروع', 'trim|required|xss_clean');
		$this->form_validation->set_rules('zone_id', 'المنطقة', 'required|integer');
		$this->form_validation->set_rules('company_name', 'اسم الشركة', 'trim|required|xss_clean');
		$this->form_validation->set_rules('company_type', 'نوع الشركة', 'trim|required|xss_clean');
		$this->form_validation->set_rules('person_name', 'اسمك', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'البريد الإلكتروني', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('mobile', 'رقم الهاتف', 'trim|required|xss_clean');
		$this->form_validation->set_rules('recaptcha_challenge_field', 'رمز التحقق', 'callback__check_recaptcha');

		if ($this->form_validation->run() == TRUE){
			$data = array(
				"project_name" => $this->input->post("project_name"),
				"zone_id" => $this->input->post("zone_id"),
				"company_name" => $this->input->post("company_name"),
				"company_type" => $this->input->post("company_type"),
				"person_name" => $this->input->post("person_name"),
				"email" => $this->input->post("email"),
				"mobile" => $this->input->post("mobile"),
			);

			if($this->project_model->insert($data)){
				$this->session->set_flashdata('message', 'تمت إرسال طلب المشروع العقاري بنجاح');
				redirect('project/success', 'refresh');
			}else{
				$this->session->set_flashdata('message', 'حصل خطأ أثناء إرسال طلب المشروع العقاري');
				redirect('project', 'refresh');
			}
		}else{
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data["form_action"] = form_open("project", "post");

			$data["input_project_name"] = form_input(array(
				"type" => "text",
				"name" => "project_name",
				"class" => "form-control",
				"placeholder" => "اسم المشروع",
				"value" => $this->form_validation->set_value('project_name')
			));

			$zones = $this->zone_model->dropdown();
			$data["input_zone_dropdown"] = form_dropdown("zone_id", $zones, $this->form_validation->set_value('zone_id'), 'class="form-control"');

			$data["input_company_name"] = form_input(array(
				"type" => "text",
				"name" => "company_name",
				"class" => "form-control",
				"placeholder" => "اسم الشركة",
				"value" => $this->form_validation->set_value('company_name')
			));

			$company_types = array(
				" " => "اختر نوع الشركة",
				"a" => "مطورة",
				"b" => "مسوق",
				"c" => "وسيط عقاري",
				"d" => "فردي"
			);
			$data["input_company_types_dropdown"] = form_dropdown("company_type", $company_types, $this->form_validation->set_value('company_type'), 'class="form-control"');

			$data["input_person_name"] = form_input(array(
				"type" => "text",
				"name" => "person_name",
				"class" => "form-control",
				"placeholder" => "اسمك",
				"value" => $this->form_validation->set_value('person_name')
			));

			$data["input_email"] = form_input(array(
				"type" => "email",
				"name" => "email",
				"class" => "form-control",
				"placeholder" => "البريد الإلكتروني",
				"value" => $this->form_validation->set_value('email')
			));

			$data["input_mobile"] = form_input(array(
				"type" => "text",
				"name" => "mobile",
				"class" => "form-control",
				"placeholder" => "رقم الهاتف",
				"value" => $this->form_validation->set_value('mobile')
			));

			$data["input_recaptcha"] = $this->recaptcha->recaptcha_get_html(RECAPTCHA_PUBLIC_KEY);
		}

		$this->load->view('project', $data);
	}

	public function success(){
		$data['message'] = $this->session->flashdata('message');

		$this->load->view('success', $data);
	}

	public function _check_recaptcha(){
		$result = $this->recaptcha->recaptcha_check_answer(RECAPTCHA_PRIVATE_KEY,
			$this->input->ip_address(),
			$this->input->post('recaptcha_challenge_field'),
			$this->input->post('recaptcha_response_field'));

		if(!$result->is_valid){
			$this->form_validation->set_message('_check_recaptcha', 'رمز التحقق غير صحيح');
			return FALSE;
		}else{
			return TRUE;
		}
	}
}

/* End of file project.php */
/* Location: ./application/controllers/project.php */