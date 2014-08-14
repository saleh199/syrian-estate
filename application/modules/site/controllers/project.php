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

		$this->load->view('project/form', $data);
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

	public function view(){
		$params = $this->uri->ruri_to_assoc(3);
		if(!isset($params['project_id'])){
			show_404();
		}

		$this->load->model("project_model");

		$data = array();

		$project_id = intval($params['project_id']);

		$data["project_info"] = $this->project_model->with('project_images')->get($project_id);

		$data["project_info"]->youtube_id = '';

		if($data["project_info"]->youtube_url){
			preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$data["project_info"]->youtube_url,$matches);
			$id = $matches[1];

			$data["project_info"]->youtube_id = $id;
		}

		$this->load->view('project/view', $data);
	}

	public function google_static_map(){
		$params = $this->uri->ruri_to_assoc(3);
		if(!isset($params['project_id'])){
			show_404();
		}

		$this->load->model("project_model");

		$project_id = intval($params['project_id']);

		$info = $this->project_model->get($project_id);

		if($info){
			$this->load->helper('file');
			$this->load->config('upload', TRUE);

			$google_static_url = 'http://maps.googleapis.com/maps/api/staticmap?markers=color:orange|label:S|'.$info->map_lat.','.$info->map_lng.'&zoom='.($info->map_zoom-1).'&size=400x400&scale=2&format=png32';
			$google_static_url_hash = md5($google_static_url);

			$image_path = $this->config->item('upload_path', 'upload') . 'projects/' . $project_id . '/'.$google_static_url_hash.'.png';

			if(file_exists($image_path)){
				$this->output->set_content_type('image/png');
				$content = read_file($image_path);
				$this->output->set_output($content);
			}else{			
				$content = file_get_contents($google_static_url);
				write_file($image_path, $content);

				$this->output->set_content_type('image/png');
				$this->output->set_output($content);
			}
		}
	}
}

/* End of file project.php */
/* Location: ./application/controllers/project.php */