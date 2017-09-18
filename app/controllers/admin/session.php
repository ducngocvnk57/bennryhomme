<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session extends MY_Controller {

	public $auth;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check();
		if($this->auth == NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/authentication/login'.CMS_SUFFIX));
	}

	// Sắp xếp đối tượng
	public function sort($module = '', $field = ''){
		$module_field = $this->session->userdata($module.'_field');
		if($module_field == NULL){
			$this->session->set_userdata($module.'_field', 'id');
			$this->session->set_userdata($module.'_sort', 'desc');
		}
		else{
			if($module_field == $field){
				$module_sort = $this->session->userdata($module.'_sort');
				if($module_sort == 'desc'){
					$this->session->set_userdata($module.'_sort', 'asc');
				}
				else{
					$this->session->set_userdata($module.'_sort', 'desc');
				}
			}
			else{
				$this->session->set_userdata($module.'_field', $field);
				$this->session->set_userdata($module.'_sort', 'desc');
			}
		}
	}
}