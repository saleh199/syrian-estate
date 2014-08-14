<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Properties extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->ion_auth->logged_in()){
			redirect('login', 'refresh');
		}

		if($this->ion_auth->is_admin()){
			//redirect('admin/properties');
		}
	}

	public function index()
	{
		$user_id = $this->session->userdata('user_id');

		$this->load->model('property_model');

		$results = $this->property_model->userPropertyList($user_id);

		foreach ($results as $index => $item) {
			$results[$index]->href_edit = site_url('user/properties/edit/'.$item->property_id);
		}

		$data['results'] = $results;

		$this->load->view('user/properties/list', $data);
	}
 
	public function add(){
		echo __method__;
	}

	public function edit(){
		$params = $this->uri->ruri_to_assoc(3);
		if(!isset($params['property_id'])){
			show_404();
		}

		$user_id = $this->session->userdata('user_id');

		$property_id = $params['property_id'];

		$this->load->model('property_model');
		$this->load->library('form_validation');

		$data['property_info'] = $property_info = $this->property_model->userPropertyInfo($user_id, $property_id);

		if(!$property_info){
			show_404();
		}

		$postData = array();

		$this->form_validation->set_rules('property_id', 'رقم العقار', 'required|integer');
		$this->form_validation->set_rules('title', 'عنوان الإعلان', 'trim|required');
		$this->form_validation->set_rules('property_status_id', 'حالة العقار', 'required|integer');
		$this->form_validation->set_rules('property_type_id', 'نوع العقار', 'required|integer');
		$this->form_validation->set_rules('price', 'سعر العقار', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('area', 'مساحة العقار', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('description', 'وصف العقار', 'required|trim');
		$this->form_validation->set_rules('map_lat', 'إحداثيات الموقع', 'required');
		$this->form_validation->set_rules('map_lng', 'إحداثيات الموقع', 'required');
		$this->form_validation->set_rules('map_zoom', 'إحداثيات الموقع', 'required');

		if($this->input->post()){
			$postData = $this->input->post(NULL, TRUE);
		}


		if ($this->form_validation->run() == TRUE){
			unset($postData['csrf_tkn']);
			if($this->property_model->update($property_id, $postData)){
				$data["success"] = 'تم حفظ المعلومات بنجاح';
			}
		}else{
			$data["errors"] = validation_errors();
		}

		$this->load->model('property_model');
		$this->load->model('property_status_model', 'property_status');
		$this->load->model('property_type_model', 'property_type');
		$this->load->model('zone_model', 'zone');


		$data["form_action"] = form_open('user/properties/edit/'.$property_id, array("id" => "propertyfrm", "class" => 'form-horizontal'), array("property_id" => $property_id));

		if(isset($postData["title"])){
			$property_title = $postData["title"];
		}elseif(isset($property_info->title)){
			$property_title = $property_info->title;
		}else{
			$property_title = '';
		}

		$data["input_title"] = form_input(array(
			"id" => "title",
			"name" => "title",
			"class" => "form-control",
			"value" => $property_title
		));

		if(isset($postData["property_status_id"])){
			$property_status_id = $postData["property_status_id"];
		}elseif(isset($property_info->property_status_id)){
			$property_status_id = $property_info->property_status_id;
		}else{
			$property_status_id = '';
		}

		$property_status_data = $this->property_status->dropdown();
		$data["dropdown_property_status"] = form_dropdown("property_status_id", $property_status_data, $property_status_id, 'id="property_status" class="form-control"');

		if(isset($postData["property_type_id"])){
			$property_type_id = $postData["property_type_id"];
		}elseif(isset($property_info->property_type_id)){
			$property_type_id = $property_info->property_type_id;
		}else{
			$property_type_id = '';
		}

		$property_type_data = $this->property_type->dropdown();
		$data["dropdown_property_type"] = form_dropdown("property_type_id", $property_type_data, $property_type_id, 'id="property_type" class="form-control"');

		if(isset($postData["price"])){
			$price = $postData["price"];
		}elseif(isset($property_info->price)){
			$price = $property_info->price;
		}else{
			$price = '';
		}


		$data["input_price"] = form_input(array(
			"type"	=> "text",
			"name"	=> "price",
			"id"	=> "price",
			"class"	=> "form-control",
			"placeholder" => "سعر العقار",
			"value" => $price
		));

		if(isset($postData["ref_number"])){
			$ref_number = $postData["ref_number"];
		}elseif(isset($property_info->ref_number)){
			$ref_number = $property_info->ref_number;
		}else{
			$ref_number = '';
		}


		$data["input_ref_number"] = form_input(array(
			"type"	=> "text",
			"name"	=> "ref_number",
			"id"	=> "ref_number",
			"class"	=> "form-control",
			"placeholder" => "رقم العقار",
			"value" => $ref_number
		));

		if(isset($postData["area"])){
			$area = $postData["area"];
		}elseif(isset($property_info->area)){
			$area = $property_info->area;
		}else{
			$area = '';
		}

		$data["area_input"] = form_input(array(
			"type"	=> "text",
			"name"	=> "area",
			"id"	=> "area",
			"class"	=> "form-control",
			"placeholder" => "مساحة العقار",
			"value" => $area
		));

		if(isset($postData["description"])){
			$description = $postData["description"];
		}elseif(isset($property_info->description)){
			$description = $property_info->description;
		}else{
			$description = '';
		}

		$data["input_description"] = form_textarea(array(
			"name"	=> "description",
			"id"	=> "description",
			"class"	=> "form-control",
			"placeholder" => "وصف العقار",
			"rows"	=> 4,
			"value" => $description
		));

		if(isset($postData["address"])){
			$address = $postData["address"];
		}elseif(isset($property_info->address)){
			$address = $property_info->address;
		}else{
			$address = '';
		}

		$data["input_address"] = form_textarea(array(
			"name"	=> "address",
			"id"	=> "address",
			"class"	=> "form-control",
			"placeholder" => "العنوان",
			"rows"	=> 4,
			"value" => $address
		));

		if(isset($postData["services"])){
			$services = $postData["services"];
		}elseif(isset($property_info->services)){
			$services = $property_info->services;
		}else{
			$services = '';
		}

		$data["input_services"] = form_textarea(array(
			"name"	=> "services",
			"id"	=> "services",
			"class"	=> "form-control",
			"placeholder" => "الخدمات الملحقة",
			"rows"	=> 4,
			"value" => $services
		));

		if(isset($postData["zone_id"])){
			$zone_id = $postData["zone_id"];
		}elseif(isset($property_info->zone_id)){
			$zone_id = $property_info->zone_id;
		}else{
			$zone_id = '';
		}

		$zone_data = $this->zone->dropdown();
		$data["dropdown_zone"] = form_dropdown("zone_id", $zone_data, $zone_id, 'id="zone_id" class="form-control"');

		if(isset($postData["map_lat"])){
			$map_lat = $postData["map_lat"];
		}elseif(isset($property_info->map_lat)){
			$map_lat = $property_info->map_lat;
		}else{
			$map_lat = '';
		}

		$data["hidden_map_lat"] = form_hidden("map_lat", $map_lat);

		if(isset($postData["map_lng"])){
			$map_lng = $postData["map_lng"];
		}elseif(isset($property_info->map_lng)){
			$map_lng = $property_info->map_lng;
		}else{
			$map_lng = '';
		}

		$data["hidden_map_lng"] = form_hidden("map_lng", $map_lng);

		if(isset($postData["map_zoom"])){
			$map_zoom = $postData["map_zoom"];
		}elseif(isset($property_info->map_zoom)){
			$map_zoom = $property_info->map_zoom;
		}else{
			$map_zoom = '';
		}

		$data["hidden_map_zoom"] = form_hidden("map_zoom", $map_zoom);


		$data["form_image_action"] = form_open_multipart(
			'user/properties/upload/',
			array("id" => "propertyimagefrm"),
			array("property_id" => $property_id)
		);

		$data["input_image"] = form_input(array(
			"type" => "file",
			"name" => "image_file",
			"id" => "image_file",
			"class" => "form-control"
		));

		$this->load->view('user/properties/form', $data);
	}

	public function upload(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}

		$user_id = $this->session->userdata('user_id');

		$this->load->library("form_validation");
		$this->load->model('property_image_model', 'property_image');
		$this->load->model('property_model');

		$postData = array();

		if($this->input->post()){
			$postData = $this->input->post(NULL, TRUE);
		}

		$property_id = $postData['property_id'];

		$property_info = $this->property_model->userPropertyInfo($user_id, $property_id);

		if(!$property_info){
			show_404();
		}

		$json = array();

		$this->form_validation->set_rules('image_file', 'صورة العقار', 'callback__upload_image');

		if ($this->form_validation->run() == TRUE){
			$uploadData = $this->upload->data();
			$data = array(
				"filename"	=>	$uploadData['file_name'],
				"orig_name"	=>	$uploadData['orig_name'],
				"property_id" => $property_id,
			);

			if($inserted = $this->property_image->insert($data)){
				$upload_path = $this->config->item("upload_path", 'upload');

				$property_directory = $upload_path . $property_id . '/';
				//mkdir($property_directory, 0777, TRUE);

				if(@copy($uploadData["full_path"], $property_directory . $uploadData['file_name'])){
					unlink($uploadData["full_path"]);
				}

				$json["result"] = 'success';
				$json["inserted"] = $inserted;
				$json["image_src"] = base_url('assets/upload/'.$property_id . '/'.$uploadData['file_name']);
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

	public function delete_image(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}

		$user_id = $this->session->userdata('user_id');

		$this->load->model('property_model');
		$this->load->model('property_image_model', 'property_image');

		$postData = array();

		if($this->input->post()){
			$postData = $this->input->post(NULL, TRUE);
		}

		$property_id = $postData['property_id'];

		$property_info = $this->property_model->userPropertyInfo($user_id, $property_id);

		if(!$property_info){
			show_404();
		}

		$json = array();
		$image_info = $this->property_image->get_by(array(
			"property_id" => $property_id,
			"property_image_id" => intval($this->input->post("property_image_id"))));

		if($image_info){
			if($this->property_image->delete_by(array(
				"property_id" => $property_id,
				"property_image_id" => intval($this->input->post("property_image_id"))
			))){
				$this->load->config("upload", TRUE);

				$upload_path = $this->config->item('upload_path', 'upload');

				$file_path = $upload_path . $property_id . '/' . $image_info->filename;

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

	public function _upload_image(){
		$this->load->config("upload", TRUE);
		$this->load->library('upload');

		$config = $this->config->item('upload');

		$config['upload_path']	.= 'tmp/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->upload->initialize($config);

		if(!$this->upload->do_upload('image_file')){
			$this->form_validation->set_message('_upload_image', $this->upload->error_msg[0]);
			return FALSE;
		}else{
			return TRUE;
		}
	}
}

/* End of file property.php */
/* Location: ./application/controllers/property.php */