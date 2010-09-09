<?php
class Login extends Controller {

	function index()
	{		
		$this->load->view('login/login');
	}
	
	function validate()
	{
		$this->load->model('users_model');
		$query = $this->users_model->login();
		
		if($query->num_rows == 1)
		{
			$row = $query->row();
			$user = array('username' => $row->username,
			'userid' => $row->userId,
			'groupid' => $row->groupId,
			'isloggedin' => true);
			$this->session->set_userdata($user);
			redirect('home/index');
		}
		else
			$this->index();
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
}

?>