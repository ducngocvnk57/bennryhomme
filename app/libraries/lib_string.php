<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_String{

	private $CI;

	public function __construct(){
		$this->CI =& get_instance();
	}
	
	public function random($leng = 10, $char = FALSE){
		if($char == FALSE) $s = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
		else $s = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		mt_srand((double)microtime() * 1000000);
		$salt = '';
		for ($i=0; $i<$leng; $i++){
			$salt = $salt . substr($s, (mt_rand()%(strlen($s))), 1);
		}
		return $salt;
	}
	
	public function encryption($password = '', $salt = ''){
		return md5($salt.md5($salt.$password.$salt).$salt);
	}
	
	public function encode_cookie($cookie = ''){
		$cookie = base64_encode(json_encode($cookie));
		$salt_a = strrev(substr($cookie, 5, 5));
		$salt_b = strrev(substr($cookie, 10, 5));
		$salt_c = strrev(substr($cookie, 15, 5));
		$salt_d = strrev(substr($cookie, 20, 5));
		$salt_e = strrev(substr($cookie, 25, 5));
		$cookie = $salt_a.$salt_b.$salt_c.$salt_d.$salt_e.$cookie;
		return $cookie;
	}
	
	public function decode_cookie($cookie = ''){
		$cookie = substr($cookie, 25);
		$cookie = json_decode(base64_decode($cookie), TRUE);
		return $cookie;
	}

	public function removeutf8($str = NULL){
		$chars = array(
			'a'	=>	array('ấ','ầ','ẩ','ẫ','ậ','Ấ','Ầ','Ẩ','Ẫ','Ậ','ắ','ằ','ẳ','ẵ','ặ','Ắ','Ằ','Ẳ','Ẵ','Ặ','á','à','ả','ã','ạ','â','ă','Á','À','Ả','Ã','Ạ','Â','Ă'),
			'e' =>	array('ế','ề','ể','ễ','ệ','Ế','Ề','Ể','Ễ','Ệ','é','è','ẻ','ẽ','ẹ','ê','É','È','Ẻ','Ẽ','Ẹ','Ê'),
			'i'	=>	array('í','ì','ỉ','ĩ','ị','Í','Ì','Ỉ','Ĩ','Ị'),
			'o'	=>	array('ố','ồ','ổ','ỗ','ộ','Ố','Ồ','Ổ','Ô','Ộ','ớ','ờ','ở','ỡ','ợ','Ớ','Ờ','Ở','Ỡ','Ợ','ó','ò','ỏ','õ','ọ','ô','ơ','Ó','Ò','Ỏ','Õ','Ọ','Ô','Ơ'),
			'u'	=>	array('ứ','ừ','ử','ữ','ự','Ứ','Ừ','Ử','Ữ','Ự','ú','ù','ủ','ũ','ụ','ư','Ú','Ù','Ủ','Ũ','Ụ','Ư'),
			'y'	=>	array('ý','ỳ','ỷ','ỹ','ỵ','Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
			'd'	=>	array('đ','Đ'),
			'-'	=>	array(' '),
		);
		foreach ($chars as $key => $arr){
			foreach ($arr as $val){
				$str = str_replace($val, $key, $str);
			}
		}
		return $str;
	}

	public function alias($str = NULL){
		$str = $this->removeutf8($str);
		$str = preg_replace('/[^a-zA-Z0-9-]/i', '', $str);
		$str = str_replace(array(
			'------------------',
			'-----------------',
			'----------------',
			'---------------',
			'--------------',
			'-------------',
			'------------',
			'-----------',
			'----------',
			'---------',
			'--------',
			'-------',
			'------',
			'-----',
			'----',
			'---',
			'--',
			),
			'-',
			$str
		);
		$str = str_replace(array(
			'------------------',
			'-----------------',
			'----------------',
			'---------------',
			'--------------',
			'-------------',
			'------------',
			'-----------',
			'----------',
			'---------',
			'--------',
			'-------',
			'------',
			'-----',
			'----',
			'---',
			'--',
			),
			'-',
			$str
		);
		if(!empty($str)){
			if($str[strlen($str)-1] == '-'){
				$str = substr($str, 0, -1);
			}
			if($str[0] == '-'){
				$str = substr($str, 1);
			}
		}
		return strtolower($str);
	}
	public function cutnchar($str = NULL, $n = 0){
		if(strlen($str)<$n) return $str;
		$html = substr($str,0,$n);
		$html = substr($html,0,strrpos($html,' '));
		return $html.'...';
	}

	public function php_redirect($url){
		header('Location: '.$url);
		die;
	}

	public function fullurl(){
		$currentURL = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		$currentURL .= $_SERVER["SERVER_NAME"];
		if($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443"){
			$currentURL .= ":".$_SERVER["SERVER_PORT"];
		}
		$currentURL .= $_SERVER["REQUEST_URI"];
		return $currentURL.((!empty($_SERVER['QUERY_STRING']))?('?'.$_SERVER['QUERY_STRING']):'');
	}
	
}