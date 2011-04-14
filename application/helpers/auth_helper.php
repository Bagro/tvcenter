<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('is_logged_in'))
{
	function is_logged_in()
	{
		$CI =& get_instance();
		$isloggedin = $CI->session->userdata('isloggedin');
		
		if(isset($isloggedin))
			return $isloggedin;
		
		return false;
	}
}

if ( ! function_exists('current_userid'))
{
	function current_userid()
	{
		$CI =& get_instance();
		$userId = $CI->session->userdata('userid');

		if(isset($userId))
			return $userId;

		return 0;
	}
}

if ( ! function_exists('is_in_group'))
{
	function is_in_group($groupId)
	{
		$CI =& get_instance();
		$usrGroupId = $CI->session->userdata("groupid");

		if(isset($usrGroupId) && $usrGroupId == $groupId)
			return true;
			
		return false;
	}
}

if ( ! function_exists('current_sessionId'))
{
	function current_sessionId(){
		$CI =& get_instance();
		$sessionId = $CI->session->userdata('session_id');
		
		if(isset($sessionId))
			return $sessionId;
		
		return false;
	}
}
?>