<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function view($page = 'about')
	{
		if ( ! file_exists(APPPATH.'/modules/site/views/pages/'.$page.'.php'))
		{
			show_404();
		}

		$this->load->view('pages/'.$page);
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */