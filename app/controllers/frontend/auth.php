<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auth extends MY_Controller{
	public $auth;
	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check_customer();
	}
	
	public function _check_active($username = ''){
		if($this->_check_username($username) == TRUE){
			$user = $this->db->select('*')->where(array('user' => $username))->from('user_customer')->get()->row_array();
			if($user['active'] != 1){
				return FALSE;
			}
		}
		return TRUE;
	}
	public function login(){
		if(isset($this->auth) && count($this->auth)) {
			die($this->lib_common->php_redirect('', 'Bạn đã đăng nhập'));
		}
		if($this->input->post('login')){
			// print_r($this->auth);die;
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('user', 'password'));
			if($this->_check_active($post_data['user']) == FALSE) {
				die($this->lib_common->js_redirect('', 'Xin vui long kích hoạt tài khoản để sử dụng dịch vụ'));
			}else{
			
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('- ', "\\n");
			$this->form_validation->set_rules('data[user]', 'Tên sử dụng', 'trim|required|min_length[3]|max_length[20]|regex_match[/^([a-z0-9_])+$/i]|callback__check_username[]');
			$this->form_validation->set_rules('data[password]', 'Mật khẩu', 'trim|required|callback__check_password['.$post_data['user'].']');

			if($this->form_validation->run() == TRUE){
				die($this->lib_common->js_redirect('', 'Đăng nhập vào hệ thống thành công'));
			}
			}
		}
		
		if($this->input->post('submit')){ // Nhận sự kiện click button
			$post_data_re = $this->input->post('data');
			$data['data']['post_data_re'] = $post_data_re;
			$this->form_validation->set_rules('data[user]', 'Tên sử dụng', 'trim|required|min_length[3]|max_length[20]|regex_match[/^([a-z0-9_])+$/i]|callback__check_username_regiter[]');
			$this->form_validation->set_rules('data[fullname]', 'Họ tên', 'trim|required');
			$this->form_validation->set_rules('data[address]', 'Địa chỉ', 'trim|required');
			$this->form_validation->set_rules('data[phone]', 'Số điện thoại', 'trim|required');
			$this->form_validation->set_rules('data[email]', 'Email', 'trim|required|valid_email|callback__check_email_regiter[]');
			$this->form_validation->set_rules('data[password]', 'Mật khẩu', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('data[re_password]', 'Nhập lại mật khẩu', 'trim|required|matches[data[password]]');
			$this->form_validation->set_error_delimiters('- ', "\\n");
			if($this->form_validation->run() == TRUE){ // Nếu dữ liệu đẩy lên là okie
				unset($post_data_re['re_password']);
				$post_data_re['salt'] = $this->lib_string->random(68);
				$post_data_re['key_active'] = $this->lib_string->random(68);
				$post_data_re['password'] = $this->lib_string->encryption($post_data_re['password'], $post_data_re['salt']);
				$post_data_re['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$this->db->insert('user_customer', $post_data_re);
				
				// Gửi mail để kích hoạt tài khoản
				$this->lib_common->sentmail(array(
					'name' => 'Luxurybazaa',
					'from' => 'kun.manage@gmail.com',
					'password' => 'ospwfsalemyyzppx',
					'to' => $post_data_re['email'],
					'cc' => NULL,
					'subject' => 'Link xác nhận cho Email '.$post_data_re['email'],
					'message' => 'Link xác nhận: <a href="'.CMS_URL.'frontend/auth/active.html?email='.urlencode(base64_encode($post_data_re['email'])).'&active='.urlencode(base64_encode($post_data_re['key_active'])).'">'.CMS_URL.'frontend/auth/active.html?email='.urlencode(base64_encode($post_data_re['email'])).'&active='.urlencode(base64_encode($post_data_re['key_active'])).'</a>',
				));
				die($this->lib_common->js_redirect('', 'Bạn đã đăng ký tài khoản thành công, xin vui lòng kiểm tra mail để kích hoạt tài khoản.'));
			}
		}
		$data['template'] = 'frontend/auth/register';
		$this->load->view('frontend/layouts/detail', $data);
	}

	public function _check_username($username = ''){
		$user = $this->db->where(array('user' => $username))->from('user_customer')->count_all_results();
		if($user == 0){
			$this->form_validation->set_message('_check_username', 'Tên sử dụng "'.$username.'" không tồn tại.');
			return FALSE;
		}
		return TRUE;
	}
	
	public function _check_password($password = '', $username = ''){
		if($this->_check_username($username) == TRUE){
			$user = $this->db->select('*')->where(array('user' => $username))->from('user_customer')->get()->row_array();
			$password = $this->lib_string->encryption($password, $user['salt']);
			if($password != $user['password']){
				$this->form_validation->set_message('_check_password', 'Mật khẩu không hợp lệ.');
				return FALSE;
			}
			$cookie = $this->lib_string->encode_cookie($user);
			setcookie('cms_cookie_login_customer_'.CMS_CODE, $cookie, time()+(7*24*3600), '/');
			return TRUE;
		}
		return TRUE;
	}
	
	
	public function info_user(){
		$info_cookie = $this->auth;
		$id_info = isset($info_cookie['id']) ? (int)$info_cookie['id'] : 0 ;
		$email_info = isset($info_cookie['email']) ? $info_cookie['email'] : 0 ;
		$password_info = isset($info_cookie['password']) ? $info_cookie['password'] : 0 ;
		$user = $this->db->select('*')->from('user_customer')->where(array('id' => $id_info, 'email' => $email_info, 'password' => $password_info))->get()->row_array();
		if(!$user){die('<meta charset=utf-8" /><script type="text/javascript">alert("Tài khoản này chưa được đăng nhập.");location.href="'.CMS_URL.'";</script>');}
		$data['data']['user_data'] = $user;
		$data['data']['post_data'] = $user;
		unset($data['data']['post_data']['password']);
		
		if($this->input->post('chang_info')){
			$post_data = $this->input->post('data');
			$data['data']['post_data'] = $post_data;
			// print_r($post_data);die;
			if(!empty($post_data['password'])){
				$this->form_validation->set_rules('data[old_password]', 'Mật khẩu', 'trim|required|callback__check_password['.$user['user'].']');
				$this->form_validation->set_rules('data[password]', 'Mật khẩu', 'trim|required|min_length[6]');
				$this->form_validation->set_rules('data[re_password]', 'Nhập lại mật khẩu', 'trim|required|matches[data[password]]');
			}
			$this->form_validation->set_rules('data[fullname]', 'Họ tên', 'trim|required');
			$this->form_validation->set_rules('data[phone]', 'Số điện thoại', 'trim|numeric');
			$this->form_validation->set_error_delimiters('- ', "\\n");
			if($this->form_validation->run() == TRUE){
				if($post_data['password']){
					$post_data['salt'] = $this->lib_string->random(68);
					$post_data['password'] = $this->lib_string->encryption($post_data['password'], $post_data['salt']);
				} else{
					unset($post_data['password']);
					unset($post_data['re_password']);
				}
				unset($post_data['re_password']);
				unset($post_data['old_password']);
				$this->db->where(array('id' => $user['id']))->update('user_customer', $post_data);
				$user_cookie = $this->db->select('*')->from('user_customer')->where(array('id' => $user['id']))->get()->row_array();
				$cookie = $this->lib_string->encode_cookie($user_cookie);
				setcookie('cms_cookie_login_customer_'.CMS_CODE, $cookie, time()+(7*24*3600), '/');
				die($this->lib_common->js_redirect('thong-tin-tai-khoan.html','Thay đổi thông tin tài khoản thành công.'));
			}
		}
		
		$data['template'] = 'frontend/auth/info_user';
		$this->load->view('frontend/layouts/detail', $data);
	}
	
	public function _check_email_fogot($email = NULL, $old_email = NULL){
		if(!empty($old_email)){
			$count = $this->db->where(array('email' => $email, 'email !=' => $old_email))->from('user_customer')->count_all_results();
		}
		else{
			$count = $this->db->where('email', $email)->from('user_customer')->count_all_results();
		}
		if($count == 0){
			$this->form_validation->set_message('_check_email_fogot', 'Email này không tồn tại.');
			return FALSE;
		}
		return TRUE;
	}
	
	public function _check_user_regiter($user = NULL, $old_user = NULL){
		if(!empty($old_user)){
			$count = $this->db->where(array('user' => $user, 'user !=' => $old_user))->from('user_customer')->count_all_results();
		}else{
			$count = $this->db->where('user', $user)->from('user_customer')->count_all_results();
		}
		if($count > 0){
			$this->form_validation->set_message('_check_user_regiter', 'Tên sử dụng '.$user.' đã tồn tại.');
			return FALSE;
		}
		return TRUE;
	}
	
	public function _check_email_regiter($email = NULL, $old_email = NULL){
		if(!empty($old_email)){
			$count = $this->db->where(array('email' => $email, 'email !=' => $old_email))->from('user_customer')->count_all_results();
		}else{
			$count = $this->db->where('email', $email)->from('user_customer')->count_all_results();
		}
		if($count > 0){
			$this->form_validation->set_message('_check_email_regiter', 'Email '.$email.' đã tồn tại.');
			return FALSE;
		}
		return TRUE;
	}
	
	public function confirm(){
		$email = base64_decode($this->input->get('email'));
		$forgot = base64_decode($this->input->get('forgot'));
		$count = $this->db->where(array('email' => $email, 'salt' => $forgot, 'salt !=' => ''))->from('user_customer')->count_all_results();
		if($count == 1){
			$password = $this->lib_common->random_salt(10, TRUE);
			$user = $this->db->from('user_customer')->where(array('email' => $email))->get()->row_array();
			$salt = $this->lib_string->random(68);
			$this->db->where(array('email' => $email))->update('user_customer', array(
				'forgot' => '',
				'password' => $this->lib_string->encryption($password, $salt),
				'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				'salt' => $salt,
			));
			$this->lib_common->sentmail(array(
				'name' => 'Ecotrans',
				'from' => 'kun.manage@gmail.com',
				'password' => 'ospwfsalemyyzppx',
				'to' => $user['email'],
				'cc' => NULL,
				'subject' => 'Tài khoản đăng nhập cho Email '.$user['email'],
				'message' => 'Tài khoản: '.$user['email'].'<br />Mật khẩu: '.$password.'<br />LBạn nên thay đổi lại mật khẩu sau khi đăng nhập để đảm bảo an toàn cho tài khoản.',
			));
			die('<meta charset=utf-8" /><script type="text/javascript">alert("Xác nhận thành công! Mật khẩu đã được gửi vào mail của bạn");location.href=\''.CMS_URL.'\';</script>');
		}else{
			die('<meta charset=utf-8" /><script type="text/javascript">alert("Link này chỉ để sử dụng 1 lần!");location.href=\''.CMS_URL.'\';</script>');
		}
	}
	
	public function active(){
		$email = base64_decode($this->input->get('email'));
		$active = base64_decode($this->input->get('active'));
		$count = $this->db->where(array('email' => $email, 'key_active' => $active, 'key_active !=' => ''))->from('user_customer')->count_all_results();
		if($count == 1){
			$user = $this->db->from('user_customer')->where(array('email' => $email))->get()->row_array();
			$key_active = $this->lib_string->random(68);
			$this->db->where(array('email' => $email))->update('user_customer', array(
				'active' => 1,
				'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				'key_active' => $key_active,
			));
			die('<meta charset=utf-8" /><script type="text/javascript">alert("Tài khoản của quý khách đã kích hoạt thành công.");location.href=\''.CMS_URL.'\';</script>');
		}else{
			die('<meta charset=utf-8" /><script type="text/javascript">alert("Tài khoản đã kích hoạt từ trước, xin vui lòng kiểm tra lại");location.href=\''.CMS_URL.'\';</script>');
		}
	}
	
	public function register(){
		if(isset($this->auth) && count($this->auth)) {
			die($this->lib_common->php_redirect('', 'Bạn đã đăng nhập'));
		}
		if($this->input->post('login')){
			// print_r($this->auth);die;
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('user', 'password'));
			if($this->_check_active($post_data['user']) == FALSE) {
				die($this->lib_common->js_redirect('', 'Xin vui long kích hoạt tài khoản để sử dụng dịch vụ'));
			}else{
			
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('- ', "\\n");
			$this->form_validation->set_rules('data[user]', 'Tên sử dụng', 'trim|required|min_length[3]|max_length[20]|regex_match[/^([a-z0-9_])+$/i]|callback__check_username[]');
			$this->form_validation->set_rules('data[password]', 'Mật khẩu', 'trim|required|callback__check_password['.$post_data['user'].']');

			if($this->form_validation->run() == TRUE){
				die($this->lib_common->js_redirect('', 'Đăng nhập vào hệ thống thành công'));
			}
			}
		}
		
		if($this->input->post('submit')){ // Nhận sự kiện click button
			$post_data_re = $this->input->post('data');
			$data['data']['post_data_re'] = $post_data_re;
			$this->form_validation->set_rules('data[user]', 'Tên sử dụng', 'trim|required|min_length[3]|max_length[20]|regex_match[/^([a-z0-9_])+$/i]|callback__check_username_regiter[]');
			$this->form_validation->set_rules('data[fullname]', 'Họ tên', 'trim|required');
			$this->form_validation->set_rules('data[address]', 'Địa chỉ', 'trim|required');
			$this->form_validation->set_rules('data[phone]', 'Số điện thoại', 'trim|required');
			$this->form_validation->set_rules('data[email]', 'Email', 'trim|required|valid_email|callback__check_email_regiter[]');
			$this->form_validation->set_rules('data[password]', 'Mật khẩu', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('data[re_password]', 'Nhập lại mật khẩu', 'trim|required|matches[data[password]]');
			$this->form_validation->set_error_delimiters('- ', "\\n");
			if($this->form_validation->run() == TRUE){ // Nếu dữ liệu đẩy lên là okie
				unset($post_data_re['re_password']);
				$post_data_re['salt'] = $this->lib_string->random(68);
				$post_data_re['key_active'] = $this->lib_string->random(68);
				$post_data_re['password'] = $this->lib_string->encryption($post_data_re['password'], $post_data_re['salt']);
				$post_data_re['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$this->db->insert('user_customer', $post_data_re);
				
				// Gửi mail để kích hoạt tài khoản
				$this->lib_common->sentmail(array(
					'name' => 'Luxurybazaa',
					'from' => 'kun.manage@gmail.com',
					'password' => 'ospwfsalemyyzppx',
					'to' => $post_data_re['email'],
					'cc' => NULL,
					'subject' => 'Link xác nhận cho Email '.$post_data_re['email'],
					'message' => 'Link xác nhận: <a href="'.CMS_URL.'frontend/auth/active.html?email='.urlencode(base64_encode($post_data_re['email'])).'&active='.urlencode(base64_encode($post_data_re['key_active'])).'">'.CMS_URL.'frontend/auth/active.html?email='.urlencode(base64_encode($post_data_re['email'])).'&active='.urlencode(base64_encode($post_data_re['key_active'])).'</a>',
				));
				die($this->lib_common->js_redirect('', 'Bạn đã đăng ký tài khoản thành công, xin vui lòng kiểm tra mail để kích hoạt tài khoản.'));
			}
		}
		$data['template'] = 'frontend/auth/register';
		$this->load->view('frontend/layouts/detail', $data);
	}
	
	public function logout(){
		setcookie('cms_cookie_login_customer_'.CMS_CODE, '', time()-3600, '/'); 
		die($this->lib_common->php_redirect('', 'Bạn đã đăng xuất thành công.'));
	}
	
	public function forgot(){
		$data['data'] = NULL;
		if(isset($this->auth) && count($this->auth)) {
			die($this->lib_common->php_redirect('', 'Bạn đã đăng nhập'));
		}
		
		if($this->input->post('submit')){ // Nhận sự kiện click button
			$post_data_re = $this->input->post('data');
			$data['data']['post_data_re'] = $post_data_re;
			$this->form_validation->set_rules('data[user]', 'Tên sử dụng', 'trim|required|min_length[3]|max_length[20]|regex_match[/^([a-z0-9_])+$/i]|callback__check_username_regiter[]');
			$this->form_validation->set_rules('data[fullname]', 'Họ tên', 'trim|required');
			$this->form_validation->set_rules('data[address]', 'Địa chỉ', 'trim|required');
			$this->form_validation->set_rules('data[phone]', 'Số điện thoại', 'trim|required');
			$this->form_validation->set_rules('data[email]', 'Email', 'trim|required|valid_email|callback__check_email_regiter[]');
			$this->form_validation->set_rules('data[password]', 'Mật khẩu', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('data[re_password]', 'Nhập lại mật khẩu', 'trim|required|matches[data[password]]');
			$this->form_validation->set_error_delimiters('- ', "\\n");
			if($this->form_validation->run() == TRUE){ // Nếu dữ liệu đẩy lên là okie
				unset($post_data_re['re_password']);
				$post_data_re['salt'] = $this->lib_string->random(68);
				$post_data_re['key_active'] = $this->lib_string->random(68);
				$post_data_re['password'] = $this->lib_string->encryption($post_data_re['password'], $post_data_re['salt']);
				$post_data_re['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$this->db->insert('user_customer', $post_data_re);
				
				// Gửi mail để kích hoạt tài khoản
				$this->lib_common->sentmail(array(
					'name' => 'Luxurybazaa',
					'from' => 'kun.manage@gmail.com',
					'password' => 'ospwfsalemyyzppx',
					'to' => $post_data_re['email'],
					'cc' => NULL,
					'subject' => 'Link xác nhận cho Email '.$post_data_re['email'],
					'message' => 'Link xác nhận: <a href="'.CMS_URL.'frontend/auth/active.html?email='.urlencode(base64_encode($post_data_re['email'])).'&active='.urlencode(base64_encode($post_data_re['key_active'])).'">'.CMS_URL.'frontend/auth/active.html?email='.urlencode(base64_encode($post_data_re['email'])).'&active='.urlencode(base64_encode($post_data_re['key_active'])).'</a>',
				));
				die($this->lib_common->js_redirect('', 'Bạn đã đăng ký tài khoản thành công, xin vui lòng kiểm tra mail để kích hoạt tài khoản.'));
			}
		}
		
		if($this->input->post('forgot')){
			$post_data_f = $this->input->post('data');
			$data['data']['post_data_f'] = $post_data_f;
			$this->form_validation->set_rules('data[email]', 'Địa chỉ Email', 'trim|required|valid_email|callback__check_email_fogot');
			if($this->form_validation->run() == TRUE){
				$user = $this->db->select('salt')->from('user_customer')->where(array('email' => $post_data_f['email']))->get()->row_array();
				$this->lib_common->sentmail(array(
					'name' => 'Ecotrans',
					'from' => 'kun.manage@gmail.com',
					'password' => 'ospwfsalemyyzppx',
					'to' => $post_data_f['email'],
					'cc' => NULL,
					'subject' => 'Link xác nhận cho Email '.$post_data_f['email'],
					'message' => 'Link xác nhận: <a href="'.CMS_URL.'frontend/auth/confirm.html?email='.urlencode(base64_encode($post_data_f['email'])).'&forgot='.urlencode(base64_encode($user['salt'])).'">'.CMS_URL.'frontend/auth/confirm.html?email='.urlencode(base64_encode($post_data_f['email'])).'&forgot='.urlencode(base64_encode($user['salt'])).'</a>',
				));
			die($this->lib_common->js_redirect('', 'Thông tin xác nhận đang được xử lý, xin vui lòng kiểm tra mail.'));
			}
		}
		$data['template'] = 'frontend/auth/forgot';
		$this->load->view('frontend/layouts/detail', $data);
	}
}
?>