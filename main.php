<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->login();
	}
	
	public function login()
	{
		$this->load->view('login');
	}
	
	public function members(){
		$this->load->view('members');
	}	
	
	public function login_validation()
	{
		$this->load->library('form_validation');
				
		$this->form_validation->set_rules('username','Email', 'required|valid_email|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('password','Password', 'required|min_length[5]|md5');
		
		if($this->form_validation->run()){
			$data = array(
				'email' => $this->input->post('username'),
				'is_logged_in' => 1
			);
			$this->session->set_userdata($data);
			redirect('main/members');
		} else {
			$this->load->view('login');
		}
		
	}
	public function validate_credentials()
	{
		$this->load->model('model_users');
		if($this->model_users->can_log_in()){
			return true;
		} else {
			$this->form_validation->set_message('validate_credentials','Incorect username/password');
			return false;
		}
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */