<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_Common{

	private $CI;

	public function __construct(){
		$this->CI =& get_instance();
	}
	
	public function js_redirect($url = '', $alert = ''){
		$alert = !empty($alert)?'alert(\''.$alert.'\'); ':'';
		return CMS_META.'<script type="text/javascript">'.$alert.'location.href=\''.CMS_URL.$url.'\';</script>';
	}
	
	public function php_redirect($url = '', $alert = ''){
		header("Location:".CMS_URL.$url);
		die;
	}
	
	public function sort_field($module = ''){
		$field = $this->CI->session->userdata($module.'_field');
		if($field == NULL){
			$field = 'id';
			$this->CI->session->set_userdata($module.'_field', 'id');
		}
		$sort = $this->CI->session->userdata($module.'_sort');
		if($sort == NULL){
			$sort = 'desc';
			$this->CI->session->set_userdata($module.'_sort', 'desc');
		}
		return array(
			'field' => $field,
			'sort' => $sort,
		);
	}
	
	public function sentmail($param = array()){
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => $param['from'],
			'smtp_pass' => $param['password'],
			'charset' => 'utf-8',
			'newline' => "\r\n",
			'mailtype' => 'html',
		);
		$this->CI->load->library('email', $config);
		$this->CI->email->set_newline("\r\n");
		$this->CI->email->from($param['from'], $param['name']);
		$this->CI->email->to($param['to']);
		$this->CI->email->cc($param['cc']);
		$this->CI->email->subject($param['subject']);
		$this->CI->email->message($param['message']);
		$this->CI->email->send();
		/* if (!$this->email->send()) show_error($this->email->print_debugger()); else echo 'Your e-mail has been sent!'; */
	}
	
	public function random_salt($leng = 10, $char = FALSE) {
		if($char == FALSE) $s = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
		else $s = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		mt_srand((double)microtime() * 1000000);
		$salt = '';
		for ($i=0; $i<$leng; $i++){
			$salt = $salt . substr($s, (mt_rand()%(strlen($s))), 1);
		}
		return $salt;
	}
}