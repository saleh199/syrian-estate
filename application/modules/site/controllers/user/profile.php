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

	public function edit(){
		$id = $this->session->userdata('user_id');
		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required|xss_clean');

		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name'  => $this->input->post('last_name'),
			'phone'      => $this->input->post('phone'),
		);

		if ($this->form_validation->run() === TRUE) {
			$this->ion_auth->update($user->id, $data);

			$this->session->set_flashdata('message', "تم تعديل معلومات الحساب");

			redirect('user/profile/edit', 'refresh');
		}

		$data['errors'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		$data["form_action"] = form_open('user/profile/edit', array("id" => "profilefrm", "class" => 'form-horizontal'));

		$data['input_first_name'] = form_input(array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
			'class' => "form-control",
			'placeholder' => 'الاسم الاول'
		));
		$data['input_last_name'] = form_input(array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
			'class' => "form-control",
			'placeholder' => 'الكنية'
		));
		$data['input_phone'] = form_input(array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
			'class' => "form-control",
			'placeholder' => 'رقم الموبايل'
		));

		$this->load->view('user/edit', $data);
	}

	function logout()
	{
		$logout = $this->ion_auth->logout();

		redirect('/', 'refresh');
	}
}

/* End of file property.php */
/* Location: ./application/controllers/property.php */