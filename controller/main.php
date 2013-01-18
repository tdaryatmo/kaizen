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
	
	public function signup(){
		$this->load->view('signup');
	}
	
	public function members(){
		$this->load->view('members');
	}	
	
	public function confirmpage(){
		$this->load->view('confirmpage');
	}
	
	public function forgetpwd(){
		$this->load->view('forgetpwd');
	}
	
	public function subforgetpwd(){
		
		$this->load->library('form_validation');
		$this->load->model('mod_admin');
		$this->load->library('email', array('mailtype'=>'html'));

		
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|xss_clean');
		$email = $_POST['email'];
		
		// check if email exist
		if($this->mod_admin->checkemail($email)){
			// get data from database 
			$userData = $this->mod_admin->getAllData($email);
				
			// generate new password for user
			$pwd = substr(uniqid(),0,6);
			$useremail = $userData['email'];
			$firstname = $userData['firstname'];
		
			// send email to user		
			$this->email->from('hello@buzzinga.com','Buzzinga! Crews');
			$this->email->to($useremail);
			$this->email->subject('Your Password');
			$msg = "<p>Hello $firstname,</p>";
			$msg .= "<p>This is your password: <b>$pwd</b></p>";			
			$this->email->message($msg);
			$this->email->send();
			
			// insert new password to database
			$this->mod_admin->newPass($useremail,$pwd);
			redirect('main/login');
			
			
		} else {
			redirect('main/forgetpwd');
			echo "<script>";
			echo "alert(\"Your email is not in our database. Please type the correct one.\")";
			echo "</script>";
		}
	
	}
	
	
	public function login_validation()
	{
		$this->load->library('form_validation');
		$this->load->model('mod_admin');
				
		$this->form_validation->set_rules('username','Email', 'required|valid_email|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('password','Password', 'required|min_length[5]|md5');
		
		$email = $_POST['username'];
		
		if($this->form_validation->run()){
				// if login succeeded then set session and go to members page
				$this->mod_admin->setsession($email);
				redirect('main/members');
		} else {
			redirect('main/login');
		}
		
	}
	
	public function signup_validation()
	{
		$this->load->library('form_validation');
		// Form validation
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|xss_clean|is_unique[tbl_users.email]');
		$this->form_validation->set_rules('firstname','First Name','required|min_length[2]|max_length[100]');
		$this->form_validation->set_rules('lastname','Last Name','required|min_length[2]|max_length[100]');
		$this->form_validation->set_rules('password','Password','required|min_length[5]|matches[repassword]|md5');
		$this->form_validation->set_rules('repassword','Retype Password','required|min_length[5]|md5');
		$this->form_validation->set_message('is_unique',"That email addtess is already exist");
		
		
		if($this->form_validation->run()){
		
			$this->load->model('mod_admin');
			$this->load->library('email', array('mailtype'=>'html'));

			// get data from the form
			$email = $_POST['email'];
			$password = $_POST['password'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			
			//$this->mod_admin->inputmember($email,$password,$firstname,$lastname);			
			// 1.) generate a random key
					$key	= md5(uniqid());			
			
			// send email to user		
					$this->email->from('hello@buzzinga.com','Buzzinga Crews!');
					$this->email->to($email);
					$this->email->subject('Confirm Your Account');
					
					$msg = "<p>Hello $firstname,</p>";
					$msg .= "<p>Thank you for signing up. We would like you to confirm your account by clicking this <a href='".base_url()."main/reguser/$key'>link</a>. Have a good day!</p>";			
					$this->email->message($msg);
					//$this->email->send();
			
			// 2.) add account to temp_user
					if($this->mod_admin->add_temp_user($email,$password,$firstname,$lastname,$key)){
						 $this->email->send();
						redirect('main/confirmpage');
					}	
					
		
		} else { redirect('main/signup'); }
	}
	
	public function reguser($key){
		$this->load->model('mod_admin');
		if($this->mod_admin->is_valid_key($key)){ 
			//if the key is valid then add user to database
			if($this->mod_admin->inputmember($key)){
				$this->mod_admin->setsession($email);
				redirect('main/members');
			}
		} else echo "Sorry, this key is invalid. Pls try to sign up again.";
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
	
	public function capcaptcha()
	{
		$this->load->model('Captcha');
	    $this->mod_captcha->genCaptcha();
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('main/login');
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */