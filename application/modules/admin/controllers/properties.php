<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Properties extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){
			redirect('admin/login');
		}
	}

	public function index()
	{
		$filter = $data = array();

		$this->load->model('property_model');
		$this->load->model('zone_model');

		if($this->input->get('status')){
			$filter['status'] = intval($this->input->get('status'));
		}

		if($this->input->get('property_id')){
			$filter['property_id'] = intval($this->input->get('property_id'));
		}

		if($this->input->get('zone_id')){
			$filter['zone_id'] = intval($this->input->get('zone_id'));
		}

		$data['message'] = ($this->session->flashdata('message')) ? '' : $this->session->flashdata('message');

		$zones = $this->zone_model->dropdown();
		$data['zones_dropdown'] = form_dropdown("zone_id",$zones, ($this->input->get('zone_id')) ? $filter['zone_id'] : '', 'class="form-control" onchange="$(\'#searchfrm\').submit()"');

		$data['results'] = $this->property_model->with('images')->with('zone')->order_by('property_id', 'DESC')->get_many_by($filter);
		//print "<pre>";var_dump($data['results'][0]);die;

		$this->load->view('properties/list', $data);
	}

	public function update(){
		$params = $this->uri->ruri_to_assoc(3);
		if(!isset($params['property_id'])){
			show_404();
		}

		$property_id = $params['property_id'];

		$data = array();

		$this->load->model('property_model');
		$this->load->library('form_validation');
		$this->load->model('property_status_model', 'property_status');
		$this->load->model('property_type_model', 'property_type');
		$this->load->model('zone_model', 'zone');

		$property_info = $this->property_model->getPropertyList(array("property_id" => $property_id));
		
		if(!$property_info){
			show_404();
		}

		$property_info = $property_info[0];

		$this->form_validation->set_rules('property_id', 'رقم العقار', 'required|integer');
		$this->form_validation->set_rules('title', 'عنوان الإعلان', 'trim|required');
		$this->form_validation->set_rules('property_status_id', 'حالة العقار', 'required|integer');
		$this->form_validation->set_rules('property_type_id', 'نوع العقار', 'required|integer');
		$this->form_validation->set_rules('price', 'سعر العقار', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('area', 'مساحة العقار', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('description', 'وصف العقار', 'required|trim');
		$this->form_validation->set_rules('map_lat', 'إحداثيات الموقع', 'required');
		//$this->form_validation->set_rules('map_lng', 'إحداثيات الموقع', 'required');
		//$this->form_validation->set_rules('map_zoom', 'إحداثيات الموقع', 'required');

		if($this->input->post('ref_number') && $this->input->post('ref_number') !== ''){
			$this->form_validation->set_rules('ref_number', 'رقم العقار', 'xss_clean|required|callback__check_ref_number|is_unique[property.ref_number]');
		}

		if ($this->form_validation->run() == TRUE){
			$update_data = array(
				"title" => $this->input->post('title', TRUE),
				"property_status_id" => $this->input->post('property_status_id'),
				"property_type_id" => $this->input->post('property_type_id'),
				"price" => $this->input->post('price'),
				"area" => $this->input->post('area'),
				"description" => $this->input->post('description', TRUE),
				"address" => $this->input->post('address', TRUE),
				"services" => $this->input->post('services', TRUE),
				"zone_id" => $this->input->post('zone_id'),
				"map_lat" => $this->input->post('map_lat'),
				"map_lng" => $this->input->post('map_lng'),
				"map_zoom" => $this->input->post('map_zoom'),
				"status" => $this->input->post('status'),
				"featured" => $this->input->post('featured'),
				"ref_number" => $this->input->post('ref_number'),
			);
			
			$this->property_model->protected_attributes = array();
			if($this->property_model->update($property_id, $update_data)){
				redirect('admin/properties', 'refresh');
			}

		}else{
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data["form_action"] = form_open('admin/properties/update/'.$property_id, array("id" => "propertyfrm"), array("property_id" => $property_id));

			$data["input_title"] = form_input(array(
				"id" => "title",
				"name" => "title",
				"class" => "form-control",
				"placeholder" => "عنوان الإعلان",
				"value" => $this->form_validation->set_value('title', $property_info->title)
			));

			$property_status_data = $this->property_status->dropdown();
			$data["dropdown_property_status"] = form_dropdown("property_status_id", $property_status_data, $this->form_validation->set_value('property_status_id', $property_info->property_status_id), 'id="property_status" class="form-control"');

			$property_type_data = $this->property_type->dropdown();
			$data["dropdown_property_type"] = form_dropdown("property_type_id", $property_type_data, $this->form_validation->set_value('property_type_id', $property_info->property_type_id), 'id="property_type" class="form-control"');

			$data["input_price"] = form_input(array(
				"id" => "price",
				"name" => "price",
				"class" => "form-control",
				"placeholder" => "السعر",
				"value" => $this->form_validation->set_value('price', $property_info->price)
			));

			$data["ref_number_input"] = form_input(array(
				"type"	=> "text",
				"name"	=> "ref_number",
				"id"	=> "ref_number",
				"class"	=> "form-control",
				"placeholder" => "رقم العقار",
				"value" => $this->form_validation->set_value('ref_number', $property_info->ref_number)
			));

			$data["input_area"] = form_input(array(
				"id" => "area",
				"name" => "area",
				"class" => "form-control",
				"placeholder" => "مساحة العقار",
				"value" => $this->form_validation->set_value('area', $property_info->area)
			));

			$data["input_description"] = form_textarea(array(
				"id" => "description",
				"name" => "description",
				"class" => "form-control",
				"rows" => 4,
				"placeholder" => "وصف العقار",
				"value" => $this->form_validation->set_value('description', $property_info->description)
			));

			$data["input_address"] = form_textarea(array(
				"name"	=> "address",
				"id"	=> "address",
				"class"	=> "form-control",
				"placeholder" => "العنوان",
				"rows"	=> 4,
				"value" => $this->form_validation->set_value('address', $property_info->address)
			));

			$data["input_services"] = form_textarea(array(
				"name"	=> "services",
				"id"	=> "services",
				"class"	=> "form-control",
				"placeholder" => "الخدمات الملحقة",
				"rows"	=> 4,
				"value" => $this->form_validation->set_value('services', $property_info->services)
			));

			$zone_data = $this->zone->dropdown();
			$data["dropdown_zone"] = form_dropdown("zone_id", $zone_data, $this->form_validation->set_value('zone_id', $property_info->zone_id), 'id="zone_id" class="form-control"');

			$data["input_map_lat"] = form_input(array(
				"type" => "hidden",
				"id" => "map_lat",
				"name" => "map_lat",
				"class" => "form-control",
				"value" => $this->form_validation->set_value('map_lat', $property_info->map_lat)
			));

			$data["input_map_lng"] = form_input(array(
				"type" => "hidden",
				"id" => "map_lng",
				"name" => "map_lng",
				"class" => "form-control",
				"value" => $this->form_validation->set_value('map_lng', $property_info->map_lng)
			));

			$data["input_map_zoom"] = form_input(array(
				"type" => "hidden",
				"id" => "map_zoom",
				"name" => "map_zoom",
				"class" => "form-control",
				"value" => $this->form_validation->set_value('map_zoom', $property_info->map_zoom)
			));

			$data["input_status_1"] = form_radio(array(
				"name" => "status",
				"value" => "1",
				"checked" => $this->form_validation->set_value('status', $property_info->status) == 1
			));

			$data["input_status_2"] = form_radio(array(
				"name" => "status",
				"value" => "2",
				"checked" => $this->form_validation->set_value('status', $property_info->status) == 2
			));

			$data["input_featured_1"] = form_radio(array(
				"name" => "featured",
				"value" => "1"
			));

			$data["input_featured_2"] = form_radio(array(
				"name" => "featured",
				"value" => "2"
			));

		}

		$this->load->view('properties/form', $data);
	}

	public function delete(){
		if(!$this->input->get('property_id')){
			show_404();
		}

		$property_id = intval($this->input->get('property_id'));

		$this->load->model("property_model");

		if($this->property_model->delete($property_id)){
			$upload_path = $this->config->item("upload_path", 'upload');

			$property_directory = $upload_path . $property_id . '/';

			if(is_dir($property_directory)){
				delete_files($property_directory, TRUE);
				rmdir($property_directory);
			}

			$this->session->set_flashdata('message', 'تم حذف العقار بنجاح');
		}else{
			$this->session->set_flashdata('message', 'حدث خطأ أثناء عملية الحذف');
		}

		redirect('admin/properties');
	}

	public function _check_ref_number(){
		$ref_number = $this->input->post('ref_number', TRUE);

		$query = $this->db->select('ref_number')->from('property_reference')->where(array('ref_number' => $ref_number))->get();

		if ($query->num_rows() > 0){
			return TRUE;
		}else{
			$this->form_validation->set_message('_check_ref_number', 'رقم العقار غير مسجل بسجل المصالح العقارية');
			return FALSE;
		}
	}
}

/* End of file properties.php */
/* Location: ./application/controllers/properties.php */