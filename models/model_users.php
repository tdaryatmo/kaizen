<?
class Model_users extends CI_Controller {
	
	public function can_log_in(){
		
		$username = $this->input->post('useername');
		$password = md5($this->input->post('password'));
		
		$this->db->where('email',$username);
		$this->db->where('password',$password);
		$sqlquery = $this->db->get('tbl_users');
		
		if($sqlquery->num_rows() == 1){
			return true;
		} else {
			return false;
		}
	}
	
	
}
?>