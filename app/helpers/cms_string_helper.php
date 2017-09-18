<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('helper_string_encode_cookie')){
	function helper_string_encode_cookie($cookie = ''){
		$cookie = base64_encode(json_encode($cookie));
		$salt_a = strrev(substr($cookie, 5, 5));
		$salt_b = strrev(substr($cookie, 10, 5));
		$salt_c = strrev(substr($cookie, 15, 5));
		$salt_d = strrev(substr($cookie, 20, 5));
		$salt_e = strrev(substr($cookie, 25, 5));
		$cookie = $salt_a.$salt_b.$salt_c.$salt_d.$salt_e.$cookie;
		return $cookie;
	}
}

if (!function_exists('helper_string_decode_cookie')){
	function helper_string_decode_cookie($cookie = ''){
		$cookie = substr($cookie, 25);
		$cookie = json_decode(base64_decode($cookie), TRUE);
		return $cookie;
	}
}

if(!function_exists('helper_string_cutnchar')){
	function helper_string_cutnchar($str = NULL, $n = 0){
		if(strlen($str)<$n) return $str;
		$html = substr($str,0,$n);
		$html = substr($html,0,strrpos($html,' '));
		return $html.'...';
	}
}

if(!function_exists('helper_string_removeutf8')){
	function helper_string_removeutf8($value = NULL){
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
		foreach ($chars as $key => $arr)
			foreach ($arr as $val)
				$value = str_replace($val, $key, $value);
		return $value;
	}
}

/* ==================================================== */
if(!function_exists('helper_string_alias')){
	function helper_string_alias($value = NULL){
		$value = helper_string_removeutf8($value);
		$value = preg_replace('/[^a-zA-Z0-9-]/i', '', $value);
		$value = str_replace(array(
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
			$value
		);
		$value = str_replace(array(
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
			$value
		);
		if(!empty($value)){
			if($value[strlen($value)-1] == '-'){
				$value = substr($value, 0, -1);
			}
			if($value[0] == '-'){
				$value = substr($value, 1);
			}
		}
		return strtolower($value);
	}
}

if (!function_exists('helper_string_full_image')){
	function helper_string_full_image($src = ''){
		$temp = substr($src, 0, 7);
		if(in_array($temp, array('http://', 'https:/')) == FALSE){
			return CMS_URL.$src;
		}
		return $src;
	}
}