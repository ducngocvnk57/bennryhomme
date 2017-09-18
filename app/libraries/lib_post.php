<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_Post{

	private $CI;

	public function __construct(){
		$this->CI =& get_instance();
	}
	
	// Cho phép các trường dữ liệu được qua
	public function allows($data = NULL, $param = NULL){
		$temp = NULL;
		if(isset($param) && count($param)){
			foreach($param as $key => $val){
				$data[$val] = !isset($data[$val])?'':$data[$val];
				$temp[$val] = $data[$val];
			}
		}
		return $temp;
	}

}