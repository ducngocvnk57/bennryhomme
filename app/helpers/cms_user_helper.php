<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('helper_user_get_info')){
	function helper_user_get_info($id = 0){
		$CI =& get_instance();
		$user = $CI->db->select('id, username, email, fullname, author')->where(array('id' => $id))->from('user')->get()->row_array();
		if(isset($user) && count($user)){
			return $user;
		}
		else{
			return NULL;
		}
	}
}