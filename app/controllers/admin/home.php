<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public $auth;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check();
		if($this->auth == NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/authentication/login'.CMS_SUFFIX));
	}

	public function index(){
		$data['meta_title'] = 'Hệ thống';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$data['template'] = 'backend/home/index';
		$this->load->view('backend/layouts/home', $data);
	}
}