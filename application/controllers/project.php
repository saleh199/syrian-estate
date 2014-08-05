<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	public function index()
	{
		$this->load->model("zone_model");
		$data = array();

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

		$this->load->view('project', $data);
	}
}

/* End of file project.php */
/* Location: ./application/controllers/project.php */