<?

class Users extends CI_Model{

	public function is_member($fb_user){
		//print_r($fb_user);
		$this->db->where('email',$fb_user['email']);
		$query = $this->db->get('tbl_users');
		if($query->num_rows()==1){ 
			return true;
		} else {
			return false;
		}
		
	}
	
	public function log_in($fb_user){
		$data = array(
			'is_logged_in' => 1,
			'email' => $fb_user['email'],
			'firstname' => $fb_user['first_name'],
			'lastname' => $fb_user['last_name'],
			'gender' => $fb_user['gender'],
			'fb_id' => $fb_user['id']
		);
			$this->session->set_userdata($data);
	}
	
	public function sign_up_fb($fb_user){
		$data = array(
			'firstname' => $fb_user['first_name'],
			'lastname' => $fb_user['last_name'],
			'email' => $fb_user['email'],
			'fb_id' => $fb_user['id'],
			'gender' => $fb_user['gender']
		);
		$this->db->insert('tbl_users',$data);
	}
	
}

?>