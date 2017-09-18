<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller{

	public $auth;
	public $menu_active;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check();
		if($this->auth == NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/home/index'.CMS_SUFFIX));
		$this->menu_active = 'menu-account';
	}

	public function information(){
		$account = $this->db->select('fullname, email, author')->where(array('id' => $this->auth['id']))->from('user')->get()->row_array();
		if(!isset($account) || count($account) == 0) die($this->lib_common->js_redirect(CMS_BACKEND, 'Tài khoản không tồn tại.'));
		$data['meta_title'] = 'Thay đổi thông tin tài khoản';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('fullname', 'email', 'author'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[email]', 'Email', 'trim|required|valid_email|callback__check_email');
			if($this->form_validation->run() == TRUE){
				$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$this->db->where(array('id' => $this->auth['id']))->update('user', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND, 'Thay đổi thông tin tài khoản thành công.'));
			}
		}
		else{
			$data['data']['post_data'] = $account;
		}
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/account/information';
		$this->load->view('backend/layouts/home', $data);
	}

	public function password(){
		$account = $this->db->select('fullname, email, author')->where(array('id' => $this->auth['id']))->from('user')->get()->row_array();
		if(!isset($account) || count($account) == 0) die($this->lib_common->js_redirect(CMS_BACKEND, 'Tài khoản không tồn tại.'));
		$data['meta_title'] = 'Thay đổi thông tin tài khoản';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('oldpassword', 'newpassword', 'renewpassword'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[oldpassword]', 'Mật khẩu cũ', 'trim|required|callback__check_oldpassword');
			$this->form_validation->set_rules('data[newpassword]', 'Mật khẩu mới', 'trim|required');
			$this->form_validation->set_rules('data[renewpassword]', 'Xác nhận mật khẩu mới', 'trim|required||matches[data[newpassword]]');
			if($this->form_validation->run() == TRUE){
				$newpassword = $post_data['newpassword'];
				$post_data = NULL;
				$post_data['salt'] = $this->lib_string->random(68);
				$post_data['password'] = $this->lib_string->encryption($newpassword, $post_data['salt']);
				$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$this->db->where(array('id' => $this->auth['id']))->update('user', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND, 'Thay đổi mật khẩu thành công.'));
			}
		}
		else{
			$data['data']['post_data'] = $account;
		}
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/account/password';
		$this->load->view('backend/layouts/home', $data);
	}

	public function _check_email($email = NULL){
		$count = $this->db->where(array('email' => $email, 'email !=' => $this->auth['email']))->from('user')->count_all_results();
		if($count > 0){
			$this->form_validation->set_message('_check_email', 'Email '.$email.' đã tồn tại.');
			return FALSE;
		}
		return TRUE;
	}

	public function _check_oldpassword($oldpassword = NULL){
		$user = $this->db->from('user')->where(array('id' => $this->auth['id']))->get()->row_array();
		$oldpassword = $this->lib_string->encryption($oldpassword, $user['salt']);
		if($user['password'] != $oldpassword){
			$this->form_validation->set_message('_check_oldpassword', '%s không chính xác');
			return FALSE;
		}
		return TRUE;
	}
}