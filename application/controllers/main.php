<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->login();
		//$this->Fbconnect();
		
	}
	
	public function login()
	{
		$this->load->view('login');
	}

	public function advsearch(){
	
		// Session check
		if($this->session->userdata('is_logged_in')==1){
			// Yes you may proceed!
			$this->load->view('advsearch');
		} else {
			echo "Please Log in..!";
			$this->load->view('login');
		}
	}

        public function confirmreset()
        {
                $this->load->view('confirmreset');
        }

	public function search()
        {
                $this->load->view('search');
        }
	
	public function signup(){

			// captcha
		$this->load->helper('captcha');
	
		$vcap = array(
			'word' => '',
			'img_path' => './captcha/',
			'img_url' => base_url().'captcha/',
			'font_path' => './system/fonts/texb.ttf',
			'img_width' => '150',
			'img_height' => '30',
			'expiration' => 7200
    	);
		$cap = create_captcha($vcap);
		$data = array(
			'captcha_time' => $cap['time'],
			'word' => $cap['word']
		);
			//'ip_address' => $this->input->ip_address(),

		$this->session->set_userdata($data);
		$data['cap_img'] = $cap['image'];

		$this->load->view('signup',$data);
	}
	
	public function members(){
		$this->load->library('fbconnect'); 
	
		// Session check
		if($this->session->userdata('is_logged_in')==1){
			// Yes you may proceed!
			$this->load->view('members');
		} else {
			echo "Please Log in..!";
			$this->load->view('login');
		}
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
			$this->email->from('noreply@buzzinga.com','Buzzinga Crew!');
			$this->email->to($useremail);
			$this->email->subject('Your Password');
			$msg = "<p>Hello $firstname,</p>";
			$msg .= "<p>This is your password: <b>$pwd</b></p>";			
			$this->email->message($msg);
			$this->email->send();

			// insert new password to database
			$this->mod_admin->newPass($useremail,$pwd);
			//$this->login();
			$this->load->view('confirmreset');
		} else {
			echo "<script>javascript:alert('Your email is not in our database. Please type the correct one'); window.location = '/kaizen/main/forgetpwd'</script>";
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
				$this->members();
		} else {
			$this->login();
		}
		
	}
	
	public function signup_validation()
	{
		$this->load->library('form_validation');
		$this->load->helper('captcha');
		
		// Form validation
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|xss_clean|is_unique[tbl_users.email]');
		$this->form_validation->set_rules('emailtype','Type of Email','required');
		$this->form_validation->set_rules('firstname','First Name','required|min_length[2]|max_length[100]');
		$this->form_validation->set_rules('lastname','Last Name','required|min_length[2]|max_length[100]');
		$this->form_validation->set_rules('gender','Gender','required');
		$this->form_validation->set_rules('password','Password','required|min_length[5]|matches[repassword]|md5');
		$this->form_validation->set_rules('repassword','Retype Password','required|min_length[5]|md5');
		$this->form_validation->set_message('is_unique',"That email address is already exist");
		$this->form_validation->set_rules('captcha','Security Code','trim|required|callback_check_captcha');
		
		
		if($this->form_validation->run()){
		
			$this->load->model('mod_admin');
			$this->load->library('email', array('mailtype'=>'html'));

			// get data from the form
			$email = $_POST['email'];
			$password = $_POST['password'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$emailtype = $_POST['emailtype'];
			$gender = $_POST['gender'];
			
			//$this->mod_admin->inputmember($email,$password,$firstname,$lastname);			
			// 1.) generate a random key
					$key	= md5(uniqid());			
			
			// send email to user		
					$this->email->from('noreply@buzzinga.com','Buzzinga Crew!');
					$this->email->to($email);
					$this->email->subject('Confirm Your Account');
					
					$msg = "<p>Hello $firstname,</p>";
					$msg .= "<p>Thank you for signing up. We would like you to confirm your account by clicking this <a href='".base_url()."main/reguser/$key'>link</a>. Have a good day!</p>";			
					$this->email->message($msg);
					//$this->email->send();
					//echo $msg;
			
			// 2.) add account to temp_user
					if($this->mod_admin->add_temp_user($email,$password,$firstname,$lastname,$key,$emailtype,$gender)){
						 $this->email->send();
						 $this->confirmpage();
					}	else {
							echo "Error, please contact webmaster <admin@buzzinga.com>";
					}					
		
		} else { $this->signup(); }
	}
	
	public function reguser($key){
		$this->load->model('mod_admin');
		if($this->mod_admin->is_valid_key($key)){ 
			//if the key is valid then add user to database
			if($this->mod_admin->inputmember($key)){
				//$this->mod_admin->setsession($email);
				$this->members();
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
		$this->login();
	}
	
	public function check_captcha()
	{

		$expiration = time()-7200; // two hour limit
		$cap = $this->input->post('captcha');

		if($this->session->userdata('word')==$cap AND $this->session->userdata('captcha_time')>$expiration){ return true; }
		else {
			$this->form_validation->set_message('check_captcha','Security number does not match.');
			return false;
		}
	}
	





	public function fbrequest(){
		$this->load->library('Fbconnect');

		$data = array(
			'scope' => 'read_stream,user_about_me,email,read_friendlists,user_birthday,user_education_history,user_work_history',
			//'scope' => 'email',
			'redirect_uri' => site_url('main/set_fblogin')
		);


		redirect($this->fbconnect->getLoginUrl($data));
	}

	public function set_fblogin(){
		//echo "yay I'm in!";

		$this->load->library('fbconnect');
		$this->load->model('users');
		
		$fb_user = $this->fbconnect->user;
		//if($this->fbconnect->user){ // if data exist
		//	echo "<pre>";
		//	print_r($this->fbconnect->user);
		////	echo "</pre>";
		//}

		// if user is a fb user
		if($this->fbconnect->user){
			if($this->users->is_member($fb_user)){
				$this->users->log_in($fb_user);
				$this->members();
			} else {
			// if not signup from facebook and login	
				$this->users->sign_up_fb($fb_user);
				$this->users->log_in($fb_user);
				$this->members();
			}
		} else {
			//echo "could not login!";
			echo "<pre>";
			print_r($this->fbconnect->user);
			echo "</pre>";
		}

	}

	
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */

