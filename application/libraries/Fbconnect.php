<?

include(APPPATH.'libraries/facebook/facebook.php');

class Fbconnect extends Facebook {

	public $user = null;
	public $user_id = null;
	public $fb = false;
	public $fbSession = false;
	public $appkey = 0;

	public function Fbconnect(){
			
		$ci =& get_instance();
		$ci->config->load('facebook', TRUE);
		$config = $ci->config->item('facebook');
		parent::__construct($config);
		//$_REQUEST = $_GET;
		//parse_str(substr(strrchr($_SERVER['REQUEST_URI'], �?�), 1), $_REQUEST);
		
		$this->user_id = $this->getUser();
		$me = null;
		if($this->user_id){
			try{
				$me = $this->api('/me');
				$this->user = $me;
			} catch(FacebookApiException $e){
				error_log($e);	
				$this->user = null;
			}
		}
		
	}

	public function send_back($val){
		return $val;
	}
	
	public function test(){
	
		$ci =& get_instance();
		
		$ci->load->helper('url');
		echo base_url();
	
	}	

}

?>
