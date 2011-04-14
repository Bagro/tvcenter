<?php
class Login extends Controller {

	function index()
	{		
		$data['script_tag'] = '<script type="text/javascript" src="'. base_url() .'/scripts/login.js"> </script>';
		$this->load->view('login/login',$data);
	}
	
	function validate()
	{		
		$ip = $this->input->ip_address();
		
		if (!$this->input->valid_ip($ip))
			$this->index();
			
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
			
			$this->users_model->logLogin($row->userId, current_sessionId(), $ip);
			
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