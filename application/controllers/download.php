<?php
class Download extends Controller{
	
	function __construct() {
        parent::Controller();

        if ( $this->router->fetch_method() != 'stream' && !is_logged_in())
            redirect('login/index');
	}
	
	function index(){
		
	}
	
	function episode($episodeId){		
		$this->load->model('Files_model', 'fm');
		$userId = current_userid();
		
		$query = $this->fm->GetFullFileName($episodeId);
		
		$ip = $this->input->ip_address();
		
		if (!$this->input->valid_ip($ip))
			return;
		
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$this->fm->RegisterDownload($userId, $row->fileId, $ip);
			$this->SendFile($row->fullname);
		}
	}
		
	function stream($request){
		$ip = $this->input->ip_address();
		
		if (!$this->input->valid_ip($ip))
			redirect('login/index');
			
		$requestArray = explode('_', $request);
		
		$this->load->model('users_model', 'um');
		
		$userId = $requestArray[2];
		$sessionId =  $requestArray[1];
		$query = $this->um->verifyStreamLogin($userId, $sessionId, $ip);
		
		if($query->num_rows() <= 0)
			redirect('login/index');
				
		$this->load->model('Files_model', 'fm');
		
		$query = $this->fm->GetFullFileName($requestArray[0]);
		
		$ip = $this->input->ip_address();
		
		if (!$this->input->valid_ip($ip))
			return;
		
		if($query->num_rows() > 0)
		{
			$row = $query->row();			
			$this->SendFile($row->fullname, true);
		}
	}
	
	private function SendFile($path, $stream=false) {
	    ob_end_clean();
		$path = htmlspecialchars_decode($path, ENT_QUOTES);
	    if (!is_file($path) || connection_status()!=0)
	        return(FALSE);

	    //to prevent long file from getting cut off from     //max_execution_time

	    set_time_limit(0);

	    $name=basename($path);

	    //filenames in IE containing dots will screw up the
	    //filename unless we add this

	    if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
	        $name = preg_replace('/\./', '%2e', $name, substr_count($name, '.') - 1);

	    //required, or it might try to send the serving     //document instead of the file

	    header("Cache-Control: ");
	    header("Pragma: ");
		if($stream)
		{
			if(strtoupper(substr($name, strlen($name) - 3, 3)) == 'MKV')
				header("Content-Type: video/x-matroska");
			elseif(strtoupper(substr($name, strlen($name) - 3, 3)) == 'AVI')
				header("Content-Type: video/x-xvid");
		}
		else
			header("Content-Type: application/octet-stream");
			
	    header("Content-Length: " .(string)(filesize($path)) );
	    header('Content-Disposition: attachment; filename="'.$name.'"');
	    header("Content-Transfer-Encoding: binary\n");

	    if($file = fopen($path, 'rb')){
	        while( (!feof($file)) && (connection_status()==0) ){
	            print(fread($file, 1024*8));
	            flush();
	        }
	        fclose($file);
	    }
	    return((connection_status()==0) and !connection_aborted());
	}	
}
?>