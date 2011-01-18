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
?>