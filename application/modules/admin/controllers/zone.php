<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zone extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){
			redirect('admin/login');
		}
	}

	public function index()
	{
		$filter = $data = array();

		$this->load->model('zone_model');

		//var_dump($this->session->flashdata('message'));die;


		$data['message'] = $this->session->flashdata('message');


		$data['results'] = $this->zone_model->order_by('zone_name', 'ASC')->get_many_by($filter);
		//print "<pre>";var_dump($data['results'][0]);die;

		$this->load->view('zone/list', $data);
	}

	public function update(){
		$params = $this->uri->ruri_to_assoc(3);
		if(!isset($params['zone_id'])){
			show_404();
		}

		$zone_id = $params['zone_id'];

		$data = array();

		$this->load->model('zone_model');
		$this->load->library('form_validation');
		$this->load->model('zone_model', 'zone');

		$zone_info = $this->zone_model->get(array("zone_id" => $zone_id));
		
		if(!$zone_info){
			show_404();
		}

		$zone_info = $zone_info;

		$this->form_validation->set_rules('zone_id', 'رقم المنطقة', 'required|integer');
		$this->form_validation->set_rules('zone_name', 'اسم المنطقة', 'trim|required');
		$this->form_validation->set_rules('map_lat', 'إحداثيات الموقع', 'required');
		$this->form_validation->set_rules('map_lng', 'إحداثيات الموقع', 'required');
		$this->form_validation->set_rules('map_zoom', 'إحداثيات الموقع', 'required');

		if ($this->form_validation->run() == TRUE){
			$update_data = array(
				"zone_name" => $this->input->post('zone_name', TRUE),
				"map_lat" => $this->input->post('map_lat'),
				"map_lng" => $this->input->post('map_lng'),
				"map_zoom" => $this->input->post('map_zoom'),
			);
			
			//$this->zone_model->protected_attributes = array();
			if($this->zone_model->update($zone_id, $update_data)){
				redirect('admin/zone', 'refresh');
			}

		}else{

			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data["form_action"] = form_open('admin/zone/update/'.$zone_id, array("id" => "zonefrm"), array("zone_id" => $zone_id));

			$data["input_zonename"] = form_input(array(
				"id" => "zone_name",
				"name" => "zone_name",
				"class" => "form-control",
				"placeholder" => "اسم المنطقة",
				"value" => $this->form_validation->set_value('zone_name', $zone_info->zone_name)
			));

			$data["input_map_lat"] = form_input(array(
				"type" => "hidden",
				"id" => "map_lat",
				"name" => "map_lat",
				"class" => "form-control",
				"value" => $this->form_validation->set_value('map_lat', $zone_info->map_lat)
			));

			$data["input_map_lng"] = form_input(array(
				"type" => "hidden",
				"id" => "map_lng",
				"name" => "map_lng",
				"class" => "form-control",
				"value" => $this->form_validation->set_value('map_lng', $zone_info->map_lng)
			));

			$data["input_map_zoom"] = form_input(array(
				"type" => "hidden",
				"id" => "map_zoom",
				"name" => "map_zoom",
				"class" => "form-control",
				"value" => $this->form_validation->set_value('map_zoom', $zone_info->map_zoom)
			));
		}

		$this->load->view('zone/form', $data);
	}

	public function insert(){

		$data = array();

		$this->load->model('zone_model');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('zone_name', 'اسم المنطقة', 'trim|required');
		$this->form_validation->set_rules('map_lat', 'إحداثيات الموقع', 'required');
		$this->form_validation->set_rules('map_lng', 'إحداثيات الموقع', 'required');
		$this->form_validation->set_rules('map_zoom', 'إحداثيات الموقع', 'required');

		if ($this->form_validation->run() == TRUE){
			$insert_data = array(
				"zone_name" => $this->input->post('zone_name', TRUE),
				"map_lat" => $this->input->post('map_lat'),
				"map_lng" => $this->input->post('map_lng'),
				"map_zoom" => $this->input->post('map_zoom'),
			);
			
			if($this->zone_model->insert($insert_data)){
				redirect('admin/zone', 'refresh');
			}

		}else{
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data["form_action"] = form_open('admin/zone/insert', array("id" => "zonefrm"));

			$data["input_zonename"] = form_input(array(
				"id" => "zone_name",
				"name" => "zone_name",
				"class" => "form-control",
				"placeholder" => "اسم المنطقة",
				"value" => $this->form_validation->set_value('zone_name')
			));

			$data["input_map_lat"] = form_input(array(
				"type" => "hidden",
				"id" => "map_lat",
				"name" => "map_lat",
				"class" => "form-control",
				"value" => $this->form_validation->set_value('map_lat')
			));

			$data["input_map_lng"] = form_input(array(
				"type" => "hidden",
				"id" => "map_lng",
				"name" => "map_lng",
				"class" => "form-control",
				"value" => $this->form_validation->set_value('map_lng')
			));

			$data["input_map_zoom"] = form_input(array(
				"type" => "hidden",
				"id" => "map_zoom",
				"name" => "map_zoom",
				"class" => "form-control",
				"value" => $this->form_validation->set_value('map_zoom')
			));
		}

		$this->load->view('zone/form', $data);
	}

	public function delete(){
		if(!$this->input->get('zone_id')){
			show_404();
		}

		$zone_id = intval($this->input->get('zone_id'));

		$this->load->model("zone_model");

		$query = $this->db->select('zone_id')->from('property')->where("zone_id", $zone_id)->get();
		$query_project = $this->db->select('zone_id')->from('project')->where("zone_id", $zone_id)->get();

		if($query->num_rows() == 0 && $query_project->num_rows() == 0){
			if($this->zone_model->delete($zone_id)){
				$this->session->set_flashdata('message', 'تم حذف المنطقة بنجاح');
			}else{
				$this->session->set_flashdata('message', 'حدث خطأ أثناء عملية الحذف');
			}
		}else{
			$this->session->set_flashdata('message', 'لا يمكن حذف مطنقة تحتوي على عقارات مضافة');
		}

		redirect('admin/zone', 'refresh');
	}
}

/* End of file zone.php */
/* Location: ./application/controllers/zone.php */