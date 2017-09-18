<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends MY_Controller{

	public $auth;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check();
	}

	public function login(){
		if($this->auth != NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/home/index'.CMS_SUFFIX));
		$data['meta_title'] = 'Đăng nhập vào hệ thống';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('login')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('username', 'password'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[username]', 'Tên sử dụng', 'trim|required|min_length[3]|max_length[20]|regex_match[/^([a-z0-9_])+$/i]|callback__check_username[]');
			$this->form_validation->set_rules('data[password]', 'Mật khẩu', 'trim|required|callback__check_password['.$post_data['username'].']');
			if($this->form_validation->run() == TRUE){
				die($this->lib_common->js_redirect(CMS_BACKEND.'/home/index'.CMS_SUFFIX, 'Đăng nhập vào hệ thống thành công'));
			}
		}
		$data['template'] = 'backend/authentication/login';
		$this->load->view('backend/layouts/login', $data);
	}

	public function forgot(){
		if($this->auth != NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/home/index'.CMS_SUFFIX));
		$data['meta_title'] = 'Quên mật khẩu';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$data['template'] = 'backend/authentication/forgot';
		$this->load->view('backend/layouts/login', $data);
	}

	public function generate_management(){
		$total_user = $this->db->where(array('group' => 'Người quản lý'))->from('user')->count_all_results();
		if($total_user > 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/authentication/login'.CMS_SUFFIX));
		$data['meta_title'] = 'Tạo tài khoản quản lý';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('username', 'password', 'email', 'fullname'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[username]', 'Tên sử dụng', 'trim|required|min_length[3]|max_length[20]|regex_match[/^([a-z0-9_])+$/i]');
			$this->form_validation->set_rules('data[password]', 'Mật khẩu', 'trim|required');
			$this->form_validation->set_rules('data[email]', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('data[fullname]', 'Tên hiển thị', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$post_data['salt'] = $this->lib_string->random(68);
				$post_data['password'] = $this->lib_string->encryption($post_data['password'], $post_data['salt']);
				$post_data['group'] = 'Người quản lý';
				$post_data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$this->db->insert('user', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/authentication/login'.CMS_SUFFIX, 'Tạo tài khoản quản lý thành công.'));
			}
		}
		$data['template'] = 'backend/authentication/generate_management';
		$this->load->view('backend/layouts/login', $data);
	}

	public function _check_username($username = ''){
		$user = $this->db->where(array('username' => $username))->from('user')->count_all_results();
		if($user == 0){
			$this->form_validation->set_message('_check_username', 'Tên sử dụng "'.$username.'" không tồn tại.');
			return FALSE;
		}
		return TRUE;
	}

	public function _check_password($password = '', $username = ''){
		if($this->_check_username($username) == TRUE){
			$user = $this->db->select('id, group, password, salt, email, fullname')->where(array('username' => $username))->from('user')->get()->row_array();
			$password = $this->lib_string->encryption($password, $user['salt']);
			if($password != $user['password']){
				$this->form_validation->set_message('_check_password', 'Mật khẩu không hợp lệ.');
				return FALSE;
			}
			if(in_array($user['group'], array('Người quản lý', 'Người viết bài')) == FALSE){
				$this->form_validation->set_message('_check_password', 'Bạn không đủ quyền để truy cập hệ thống.');
				return FALSE;
			}
			$cookie = $this->lib_string->encode_cookie(array(
				'id' => $user['id'],
				'username' => $username,
				'password' => $user['password'],
				'email' => $user['email'],
				'fullname' => $user['fullname'],
			));
			setcookie('cms_cookie_login_'.CMS_CODE, $cookie, time()+(7*24*3600), '/');
			$this->db->where(array('id' => $user['id']))->update('user', array('last_logged' => gmdate('Y-m-d H:i:s', time() + 7*3600)));
			return TRUE;
		}
		return TRUE;
	}

	public function logout(){
		if($this->auth == NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/authentication/login'.CMS_SUFFIX));
		setcookie('cms_cookie_login_'.CMS_CODE, '', time()-3600, '/'); die($this->lib_common->js_redirect(CMS_BACKEND.'/authentication/login'.CMS_SUFFIX));
	}
}