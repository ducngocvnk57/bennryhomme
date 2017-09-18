<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_Authentication{

	private $CI;

	public function __construct(){
		$this->CI =& get_instance();
	}
	
	public function check(){
		if(isset($_COOKIE['cms_cookie_login_'.CMS_CODE])){
			$cookie = $this->CI->lib_string->decode_cookie($_COOKIE['cms_cookie_login_'.CMS_CODE]);
			if(isset($cookie['id']) && isset($cookie['username']) && isset($cookie['password']) && isset($cookie['email']) && isset($cookie['fullname'])){
				$user = $this->CI->db->select('id, group')->where(array('username' => $cookie['username'], 'password' => $cookie['password']))->from('user')->get()->row_array();
				if(isset($user) && count($user)){
					$this->CI->db->where(array('id' => $cookie['id']))->update('user', array('updated_logged' => gmdate('Y-m-d H:i:s', time() + 7*3600)));
					$cookie['group'] = $user['group'];
					return $cookie;
				}
			}
		}
		setcookie('cms_cookie_login_'.CMS_CODE, '', time()-3600, '/');
		return NULL;
	}
	
	public function check_customer(){
		if(isset($_COOKIE['cms_cookie_login_customer_'.CMS_CODE])){
			$cookie = $this->CI->lib_string->decode_cookie($_COOKIE['cms_cookie_login_customer_'.CMS_CODE]);
			if(isset($cookie['id']) && isset($cookie['user']) && isset($cookie['password']) && isset($cookie['email']) && isset($cookie['fullname'])){
				$user = $this->CI->db->select('*')->where(array('user' => $cookie['user'], 'password' => $cookie['password']))->from('user_customer')->get()->row_array();
				if(isset($user) && count($user)){
					$this->CI->db->where(array('id' => $cookie['id']))->update('user_customer', array('updated_logged' => gmdate('Y-m-d H:i:s', time() + 7*3600)));
					return $cookie;
				}
			}
		}
		setcookie('cms_cookie_login_customer_'.CMS_CODE, '', time()-3600, '/');
		return NULL;
	}

}