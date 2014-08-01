<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->ion_auth->logged_in()){
			redirect('login', 'refresh');
		}

		if($this->ion_auth->is_admin()){
			//redirect('admin/properties');
		}
	}

	public function password(){

		$user_id = $this->session->userdata('user_id');

		$this->form_validation->set_rules('old_password', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new_password', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == TRUE){
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old_password'), $this->input->post('new_password'));

			if ($change)
			{
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('user/profile/password', 'refresh');
			}

		}else{
			$data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data["form_action"] = form_open('user/profile/password', array("id" => "profilefrm", "class" => 'form-horizontal'));

			$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$data['input_old_password'] = form_input(array(
				'name' => 'old_password',
				'id'   => 'old_password',
				'type' => 'password',
				'class' => "form-control"
			));
			$data['input_new_password'] = form_input(array(
				'name' => 'new_password',
				'id'   => 'new_password',
				'type' => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
				'class' => "form-control"
			));
			$data['input_new_password_confirm'] = form_input(array(
				'name' => 'new_confirm',
				'id'   => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
				'class' => "form-control"
			));
		}


		$this->load->view('user/password', $data);
	}

	function logout()
	{
		$logout = $this->ion_auth->logout();

		redirect('/', 'refresh');
	}
}

/* End of file property.php */
/* Location: ./application/controllers/property.php */