<?
class Mod_admin extends CI_Model {

	
	public function inputmember($key){
		
		// get from temporary data
		$this->db->where('key',$key);
		$temp_user = $this->db->get('tbl_users_temp');
		
		if($temp_user){
			$row = $temp_user->row();
			$data = array(
					'email' => $row->email,
					'password' => $row->password,
					'firstname' => $row->firstname,
					'lastname' => $row->lastname,
					'emailtype' => $row->$emailtype,
					'gender' => $row->$gender
			);
			$insertquery = $this->db->insert('tbl_users',$data);
		}
		
		// set session
		$sesuser = $this->session->set_userdata($data);	
		
		// if insert to table user succeeded then delete temp data
		if($insertquery){			
			$this->db->where('key',$key);
			$this->db->delete('tbl_users_temp');
			return true;
		} return false;
		
	}

	public function add_temp_user($email,$password,$firstname,$lastname,$key,$emailtype,$gender){
		$data = array(
			'email' => $email,
			'password' => md5($password),
			'firstname' => $firstname,
			'lastname' => $lastname,
			'key' => $key,
			'emailtype' => $emailtype,
			'gender' => $gender
		);
		$insertquery = $this->db->insert('tbl_users_temp',$data);
	}
	
	public function is_valid_key($key){
		$this->db->where('key',$key);
		$querykey = $this->db->get('tbl_users_temp');
		
		if($querykey->num_rows()==1){ return true; } else return false;
		
	}
	
	public function setsession($email){
		$this->load->library('session');
		// get data from tbl_users
			$this->db->where('email',$email);
			$sesdata = $this->db->get('tbl_users');
			
				$row = $sesdata->row();
				$data = array(
					'email' => $row->email,
					'password' => $row->password,
					'firstname' => $row->firstname,
					'lastname' => $row->lastname,
					'emailtype' => $emailtype,
					'gender' => $gender
				);
		$sesuser = $this->session->set_userdata($data);		
	}
	
	public function checkemail($email){
		$this->db->where('email',$email);
		$temp_user = $this->db->get('tbl_users');
		
		if($temp_user->num_rows()==1) {
			return true;
		} else {
			return false;
		}
	}
	
	public function getAllData($email){
		
		// get Data from tbl_users
		$this->db->where('email',$email);
		$userData = $this->db->get('tbl_users');
		
		$row = $userData->row();
		$allData = array(
			'email' => $row->email,
			'password' => $row->password,
			'firstname' => $row->firstname,
			'lastname' => $row->lastname,
			'emailtype' => $emailtype,
			'gender' => $gender
		);

		return $allData;
		
	}
	
	public function newPass($useremail,$pwd){
		
		$newpwd = md5($pwd);
		 $this->db->query("UPDATE tbl_users SET password='$newpwd' WHERE email = '$useremail'");
		return true;

	
	}
		


}
?>