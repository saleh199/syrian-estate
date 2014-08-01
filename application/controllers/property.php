<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends CI_Controller {

	public function addModal()
	{
		$this->load->model('property_status_model', 'property_status');
		$this->load->model('property_type_model', 'property_type');
		$this->load->model('zone_model', 'zone');

		$data["form_action"] = form_open_multipart('property/insert', array("id" => "addpropertyfrm"));

		$property_status_data = $this->property_status->dropdown();
		$data["property_status_dropdown"] = form_dropdown("property_status_id", $property_status_data, '', 'id="property_status" class="form-control"');

		$property_type_data = $this->property_type->dropdown();
		$data["property_type_dropdown"] = form_dropdown("property_type_id", $property_type_data, '', 'id="property_type" class="form-control"');

		$data["price_input"] = form_input(array(
			"type"	=> "text",
			"name"	=> "price",
			"id"	=> "price",
			"class"	=> "form-control",
			"placeholder" => "سعر العقار",
		));

		$data["description_input"] = form_textarea(array(
			"name"	=> "description",
			"id"	=> "description",
			"class"	=> "form-control",
			"placeholder" => "وصف العقار",
			"rows"	=> 4
		));

		$zone_data = $this->zone->dropdown();
		$data["zone_dropdown"] = form_dropdown("zone_id", $zone_data, '', 'id="zone_id" class="form-control"');

		$data["image_input"] = form_upload(array(
			"name"	=> "image",
			"id"	=> "image",
			"class"	=> "form-control",
			"placeholder" => "صورة العقار",
		));

		$this->load->view('property/modal/form', $data);
	}

	public function view(){
		$params = $this->uri->ruri_to_assoc(3);
		if(!isset($params['property_id'])){
			show_404();
		}

		$data = array();

		$this->load->model("property_model");

		$property_id = intval($params['property_id']);

		$data["property_info"] = $info = $this->property_model->getPropertyInfo($property_id);

		$this->load->view('property/view', $data);
	}

	public function insert(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}

		$this->load->library("form_validation");
		$this->load->model('property_model');
		$this->load->model('property_image_model', 'property_image');

		$json = array();

		$this->form_validation->set_rules('property_status_id', 'حالة العقار', 'trim|required');
		$this->form_validation->set_rules('property_type_id', 'نوع العقار', 'trim|required');
		$this->form_validation->set_rules('price', 'سعر العقار', 'trim|required');
		$this->form_validation->set_rules('description', 'وصع العقار', 'trim|required');
		$this->form_validation->set_rules('zone_id', 'المنطقة', 'trim|required');
		$this->form_validation->set_rules('image', 'صورة العقار', 'callback__upload_image');

		if ($this->form_validation->run() == TRUE){
			$uploadData = $this->upload->data();
			$data = $this->input->post(NULL, TRUE);
			unset($data[$this->config->item("csrf_token_name")]);

			$data["user_id"] = 1;
			if($inserted = $this->property_model->insert($data)) {
				$data = array(
					"filename"	=>	$uploadData['file_name'],
					"orig_name"	=>	$uploadData['orig_name'],
					"property_id" => $inserted,
				);

				if($this->property_image->insert($data)){
					$upload_path = $this->config->item("upload_path", 'upload');

					$property_directory = $upload_path . $inserted . '/';
					mkdir($property_directory, 0777, TRUE);

					if(@copy($uploadData["full_path"], $property_directory . $uploadData['file_name'])){
						unlink($uploadData["full_path"]);
					}
				}

				$json["result"] = 'success';
				$json["inserted"] = $inserted;
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

	public function google_static_map(){
		$params = $this->uri->ruri_to_assoc(3);
		if(!isset($params['property_id'])){
			show_404();
		}

		$this->load->model("property_model");

		$property_id = intval($params['property_id']);

		$info = $this->property_model->getPropertyInfo($property_id);

		if($info){
			$this->load->helper('file');
			$this->load->config('upload', TRUE);
			$image_path = $this->config->item('upload_path', 'upload') . $property_id . '/static_image.png';

			if(file_exists($image_path)){
				$this->output->set_content_type('image/png');
				$content = read_file($image_path);
				$this->output->set_output($content);
			}else{
				$google_static_url = 'http://maps.googleapis.com/maps/api/staticmap?markers=color:orange|label:S|'.$info->map_lat.','.$info->map_lng.'&zoom='.($info->map_zoom-1).'&size=200x200&scale=2&format=png32';
				
				$content = file_get_contents($google_static_url);
				write_file($image_path, $content);

				$this->output->set_content_type('image/png');
				$this->output->set_output($content);
			}
		}
	}

	public function _upload_image(){
		$this->load->config("upload", TRUE);
		$this->load->library('upload');

		$config = $this->config->item('upload');

		$config['upload_path']	.= 'tmp/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->upload->initialize($config);

		if(!$this->upload->do_upload('image')){
			$this->form_validation->set_message('_upload_image', $this->upload->error_msg[0]);
			return FALSE;
		}else{
			return TRUE;
		}
	}
}

/* End of file property.php */
/* Location: ./application/controllers/property.php */