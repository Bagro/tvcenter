<?php
class Download extends Controller{
	
	function __construct() {
        parent::Controller();

        if (!is_logged_in())
            redirect('login/index');
	}
	
	function index(){
		
	}
	
	function episode($episodeId){		
		$this->load->model('Files_model', 'fm');
		
		$query = $this->fm->GetFullFileName($episodeId);
		
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$this->SendFile($row->fullname);
		}
	}
	
	private function SendFile($path) {
	    
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