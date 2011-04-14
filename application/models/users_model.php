<?php
class Users_model extends Model{
	function login()
	{
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('users');
		
		return $query;
	}
	
	function logLogin($userId, $sessionId, $ip)
	{
		$this->load->helper('date');
		$data = array(
						'sessionId' => $sessionId,
						'loginIp' => $ip,
						'lastLogin' => mdate('%Y-%m-%d %H:%m:%s')
					);
		$this->db->where('userId', $userId);
		$this->db->update('users', $data);
	}
	
	function verifyStreamLogin($userId, $sessionId, $ip)
	{
		$this->db->where('userId', $userId);
		$this->db->where('sessionId', $sessionId);
		$this->db->where('loginIp', $ip);
		$query = $this->db->get('users');
		
		return $query;
	}
}
?>