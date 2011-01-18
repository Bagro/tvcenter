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
	
}
?>