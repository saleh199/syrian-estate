<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){
			redirect('admin/login');
		}
	}

	public function index()
	{
		$filter = $data = array();

		$this->load->model('project_model');
		$this->load->model('zone_model');

		if($this->input->get('status')){
			$filter['status'] = intval($this->input->get('status'));
		}

		if($this->input->get('project_id')){
			$filter['project_id'] = intval($this->input->get('project_id'));
		}

		if($this->input->get('zone_id')){
			$filter['zone_id'] = intval($this->input->get('zone_id'));
		}

		$data['message'] = ($this->session->flashdata('message')) ? '' : $this->session->flashdata('message');

		$zones = $this->zone_model->dropdown();
		$data['zones_dropdown'] = form_dropdown("zone_id",$zones, ($this->input->get('zone_id')) ? $filter['zone_id'] : '', 'class="form-control" onchange="$(\'#searchfrm\').submit()"');

		$data['results'] = $this->project_model->with('project_images')->with('zone')->order_by('project_id', 'DESC')->get_many_by($filter);
		//print "<pre>";var_dump($data['results'][0]);die;

		$this->load->view('project/list', $data);
	}

	public function update(){
		$params = $this->uri->ruri_to_assoc(3);
		if(!isset($params['project_id'])){
			show_404();
		}

		$project_id = $params['project_id'];

		$data = array();

		$this->load->model('project_model');
		$this->load->library('form_validation');
		$this->load->model('zone_model', 'zone');

		$data['project_info'] = $project_info = $this->project_model->with('project_images')->get($project_id);
		
		if(!$project_info){
			show_404();
		}

		$this->form_validation->set_rules('project_id', 'رقم العقار', 'required|integer');
		$this->form_validation->set_rules('project_name', 'اسم المشروع', 'trim|required');
		$this->form_validation->set_rules('description', 'وصف المشروع', 'required|trim');
		$this->form_validation->set_rules('address', 'عنوان المشروع', 'required|trim');
		$this->form_validation->set_rules('services', 'خدمات المشروع', 'required|trim');
		$this->form_validation->set_rules('area', 'مساحة المشروع', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('map_lat', 'إحداثيات الموقع', 'required');
		$this->form_validation->set_rules('map_lng', 'إحداثيات الموقع', 'required');
		$this->form_validation->set_rules('map_zoom', 'إحداثيات الموقع', 'required');

		if ($this->form_validation->run() == TRUE){
			$update_data = array(
				"project_name" => $this->input->post('project_name', TRUE),
				"area" => $this->input->post('area'),
				"description" => $this->input->post('description', TRUE),
				"address" => $this->input->post('address', TRUE),
				"services" => $this->input->post('services', TRUE),
				"zone_id" => $this->input->post('zone_id'),
				"map_lat" => $this->input->post('map_lat'),
				"map_lng" => $this->input->post('map_lng'),
				"map_zoom" => $this->input->post('map_zoom'),
				//"status" => $this->input->post('status'),
				"youtube_url" => $this->input->post('youtube_url'),
				"company_name" => $this->input->post('company_name'),
				"company_type" => $this->input->post('company_type'),
				"person_name" => $this->input->post('person_name'),
				"email" => $this->input->post('email'),
				"mobile" => $this->input->post('mobile'),
			);
			
			$this->project_model->protected_attributes = array();
			if($this->project_model->update($project_id, $update_data)){
				redirect('admin/project', 'refresh');
			}

		}else{
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data["form_action"] = form_open('admin/project/update/'.$project_id, array("id" => "projectfrm"), array("project_id" => $project_id));

			$data["input_project_name"] = form_input(array(
				"id" => "project_name",
				"name" => "project_name",
				"class" => "form-control",
				"placeholder" => "اسم المشروع",
				"value" => $this->form_validation->set_value('project_name', $project_info->project_name)
			));

			$data["input_area"] = form_input(array(
				"id" => "area",
				"name" => "area",
				"class" => "form-control",
				"placeholder" => "مساحة المشروع",
				"value" => $this->form_validation->set_value('area', $project_info->area)
			));

			$data["input_description"] = form_textarea(array(
				"id" => "description",
				"name" => "description",
				"class" => "form-control",
				"rows" => 4,
				"placeholder" => "وصف المشروع",
				"value" => $this->form_validation->set_value('description', $project_info->description)
			));

			$data["input_address"] = form_textarea(array(
				"name"	=> "address",
				"id"	=> "address",
				"class"	=> "form-control",
				"placeholder" => "عنوان المشروع",
				"rows"	=> 4,
				"value" => $this->form_validation->set_value('address', $project_info->address)
			));

			$data["input_services"] = form_textarea(array(
				"name"	=> "services",
				"id"	=> "services",
				"class"	=> "form-control",
				"placeholder" => "الخدمات الملحقة",
				"rows"	=> 4,
				"value" => $this->form_validation->set_value('services', $project_info->services)
			));

			$data["input_youtube_url"] = form_textarea(array(
				"name"	=> "youtube_url",
				"id"	=> "youtube_url",
				"class"	=> "form-control",
				"placeholder" => "عنوان الفيديو (Youtube)",
				"rows"	=> 2,
				"value" => $this->form_validation->set_value('youtube_url', $project_info->youtube_url)
			));

			$data["input_company_name"] = form_input(array(
				"id" => "company_name",
				"name" => "company_name",
				"class" => "form-control",
				"placeholder" => "اسم الشركة",
				"value" => $this->form_validation->set_value('company_name', $project_info->company_name)
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
				"placeholder" => "اسم التواصل",
				"value" => $this->form_validation->set_value('person_name', $project_info->person_name)
			));

			$data["input_mobile"] = form_input(array(
				"type" => "text",
				"name" => "mobile",
				"class" => "form-control",
				"placeholder" => "رقم الهاتف",
				"value" => $this->form_validation->set_value('mobile', $project_info->mobile)
			));

			$data["input_email"] = form_input(array(
				"type" => "email",
				"name" => "email",
				"class" => "form-control",
				"placeholder" => "البريد الإلكتروني",
				"value" => $this->form_validation->set_value('email', $project_info->email)
			));

			$zone_data = $this->zone->dropdown();
			$data["dropdown_zone"] = form_dropdown("zone_id", $zone_data, $this->form_validation->set_value('zone_id', $project_info->zone_id), 'id="zone_id" class="form-control"');

			$data["input_map_lat"] = form_input(array(
				"type" => "hidden",
				"id" => "map_lat",
				"name" => "map_lat",
				"class" => "form-control",
				"value" => $this->form_validation->set_value('map_lat', $project_info->map_lat)
			));

			$data["input_map_lng"] = form_input(array(
				"type" => "hidden",
				"id" => "map_lng",
				"name" => "map_lng",
				"class" => "form-control",
				"value" => $this->form_validation->set_value('map_lng', $project_info->map_lng)
			));

			$data["input_map_zoom"] = form_input(array(
				"type" => "hidden",
				"id" => "map_zoom",
				"name" => "map_zoom",
				"class" => "form-control",
				"value" => $this->form_validation->set_value('map_zoom', $project_info->map_zoom)
			));

/*			$data["input_status_1"] = form_radio(array(
				"name" => "status",
				"value" => "1",
				"checked" => $this->form_validation->set_value('status', $project_info->status) == 1
			));

			$data["input_status_2"] = form_radio(array(
				"name" => "status",
				"value" => "2",
				"checked" => $this->form_validation->set_value('status', $project_info->status) == 2
			));*/

			$data["form_image_action"] = form_open_multipart(
				'admin/project/upload',
				array("id" => "projectimagefrm"),
				array("project_id" => $project_info->project_id)
			);

			$data["input_image"] = form_input(array(
				"type" => "file",
				"name" => "image_file",
				"id" => "image_file",
				"class" => "form-control"
			));

		}

		$this->load->view('project/form', $data);
	}

	public function set_status(){
		if(!$this->input->get('project_id')){
			show_404();
		}

		$json = array();

		$project_id = intval($this->input->get('project_id'));
		$status = intval($this->input->get('status'));

		$this->load->model("project_model");

		$update_data = array(
			"status" => $status,
		);

		$this->project_model->protected_attributes = array();

		if($this->project_model->update($project_id, $update_data)){
			$json['result'] = 'success';
		}else{
			$json['result'] = 'fail';
		}

		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode($json));
	}

	public function delete(){
		if(!$this->input->get('project_id')){
			show_404();
		}

		$project_id = intval($this->input->get('project_id'));

		$this->load->model("project_model");

		if($this->project_model->delete($project_id)){
			$this->session->set_flashdata('message', 'تم حذف العقار بنجاح');
		}else{
			$this->session->set_flashdata('message', 'حدث خطأ أثناء عملية الحذف');
		}

		redirect('admin/project');
	}

	public function upload(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}

		$this->load->library("form_validation");
		$this->load->model('project_image_model', 'project_image');
		$this->load->model('project_model');

		$project_id = intval($this->input->post('project_id'));

		$project_info = $this->project_model->get($project_id);

		if(!$project_info){
			show_404();
		}

		$json = array();

		$this->form_validation->set_rules('image_file', 'الصورة', 'callback__upload_image');

		if ($this->form_validation->run() == TRUE){
			$uploadData = $this->upload->data();
			$data = array(
				"filename"	=>	$uploadData['file_name'],
				"orig_name"	=>	$uploadData['orig_name'],
				"project_id" => $project_id,
			);

			if($inserted = $this->project_image->insert($data)){
				$upload_path = $this->config->item("upload_path", 'upload');

				$project_directory = $upload_path . 'projects/' . $project_id . '/';

				if(!is_dir($project_directory)){
					@mkdir($project_directory, 0777, TRUE);
				}

				if(@copy($uploadData["full_path"], $project_directory . $uploadData['file_name'])){
					unlink($uploadData["full_path"]);
				}

				$json["result"] = 'success';
				$json["inserted"] = $inserted;
				$json["image_src"] = base_url('assets/upload/projects/'.$project_id . '/'.$uploadData['file_name']);
			}else{
				$json["result"] = 'fail';
				$json["errors"] = array('alert' => 'حدث خطأ أثناء عملية الإضافة');
			}
		}else{
			$json["result"] = 'fail';
			$json["errors"] = $this->form_validation->error_array();
		}

		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode($json));
	}

	public function _upload_image(){
		$this->load->config("upload", TRUE);
		$this->load->library('upload');

		$config = $this->config->item('upload');

		$config['upload_path']	.= 'tmp/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		if(!is_dir($config['upload_path'])){
			@mkdir($config['upload_path'], 0777, TRUE);
		}

		$this->upload->initialize($config);

		if(!$this->upload->do_upload('image_file')){
			$this->form_validation->set_message('_upload_image', $this->upload->error_msg[0]);
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function delete_image(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}

		$this->load->model('project_model');
		$this->load->model('project_image_model', 'project_image');

		$postData = array();

		if($this->input->post()){
			$postData = $this->input->post(NULL, TRUE);
		}

		$project_id = $postData['project_id'];

		$project_info = $this->project_model->get($project_id);

		if(!$project_info){
			show_404();
		}

		$json = array();
		$image_info = $this->project_image->get_by(array(
			"project_id" => $project_id,
			"project_image_id" => intval($this->input->post("project_image_id"))));

		if($image_info){
			if($this->project_image->delete_by(array(
				"project_id" => $project_id,
				"project_image_id" => intval($this->input->post("project_image_id"))
			))){
				$this->load->config("upload", TRUE);

				$upload_path = $this->config->item('upload_path', 'upload');

				$file_path = $upload_path . 'projects/' . $project_id . '/' . $image_info->filename;

				if(file_exists($file_path)){
					unlink($file_path);
				}

				$json['result'] = 'success';
			}else{
				$json['result'] = 'fail';
			}
		}else{
			$json['result'] = 'fail';
		}

		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode($json));
	}
}

/* End of file project.php */
/* Location: ./application/controllers/project.php */