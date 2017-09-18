<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System extends MY_Controller{

	public $auth;
	public $menu_active;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check();
		if($this->auth == NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/home/index'.CMS_SUFFIX));
		$this->menu_active = 'menu-system';
	}

	public function index(){
		$data['meta_title'] = 'Cấu hình hệ thống';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$data['data']['field'] = $this->db->from('system')->where(array('publish' => 1))->order_by('order asc')->get()->result_array();
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$data['data']['post_data'] = $post_data;
			$post['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
			if(isset($post_data) && count($post_data)){
				foreach($post_data as $key => $val){
					$post['value'] = $val;
					$this->db->where(array('keyword' => $key))->update('system', $post);
				}
			}
			die($this->lib_common->js_redirect(CMS_BACKEND, 'Thay đổi cấu hình thành công.'));
		}
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/system/index';
		$this->load->view('backend/layouts/home', $data);
	}

	public function config(){
		$data['meta_title'] = 'Cấu hình nâng cao';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/system/config';
		$this->load->view('backend/layouts/home', $data);
	}

}