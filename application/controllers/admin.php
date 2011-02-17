<?php
class Admin extends Controller {

    function __construct() {
        parent::Controller();

        if (!is_logged_in() && !is_in_group(4))
            redirect('login/index');

        $this->load->model('Series_model', 'sm');        
    }

	function index(){
		
		$data['main_content'] = 'includes/blank';
		$this->load->view('includes/admintemplate', $data);
	}
	
	function verifyfiles(){
		$files = $this->sm->get_all_files();
		
		foreach($files as $file)
		{
			if(!file_exists(htmlspecialchars_decode($file->fullname, ENT_QUOTES)))
				echo $file->fullname ."<br/>";
		}
	}
}
?>