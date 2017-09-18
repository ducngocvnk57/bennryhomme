<?php if ( ! defined('BASEPATH')) exit('No direct script member allowed');

class member extends MY_Controller{

	public $auth;
	public $menu_active;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check();
		if($this->auth == NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/home/index'.CMS_SUFFIX));
		if($this->auth['group'] != 'Người quản lý') die($this->lib_common->js_redirect(CMS_BACKEND));
		$this->menu_active = 'menu-member';
	}

	public function add(){
		$data['meta_title'] = 'Thêm thành viên mới';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('username', 'password', 'email', 'fullname'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[username]', 'Tên sử dụng', 'trim|required|min_length[3]|max_length[20]|regex_match[/^([a-z0-9_])+$/i]|callback__check_username');
			$this->form_validation->set_rules('data[password]', 'Mật khẩu', 'trim|required');
			$this->form_validation->set_rules('data[email]', 'Email', 'trim|required|valid_email|callback__check_email');
			$this->form_validation->set_rules('data[fullname]', 'Tên hiển thị', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$post_data['salt'] = $this->lib_string->random(68);
				$post_data['password'] = $this->lib_string->encryption($post_data['password'], $post_data['salt']);
				$post_data['group'] = 'Người viết bài';
				$post_data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$this->db->insert('user', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/member/index'.CMS_SUFFIX, 'Thêm thành viên thành công.'));
			}
		}
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/member/add';
		$this->load->view('backend/layouts/home', $data);
	}

	public function edit($id = 0){
		$id = (int)$id;
		$member = $this->db->select('username, email, fullname')->where(array('id' => $id))->from('user')->get()->row_array();
		if(!isset($member) || count($member) == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/member/index'.CMS_SUFFIX, 'thành viên không tồn tại.'));
		$data['meta_title'] = 'Thay đổi thông tin thành viên';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('password', 'email', 'fullname'));
			$post_data['username'] = $member['username'];
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[email]', 'Email', 'trim|required|valid_email|callback__check_email['.$member['email'].']');
			$this->form_validation->set_rules('data[fullname]', 'Tên hiển thị', 'trim|required');
			if($this->form_validation->run() == TRUE){
				if(!empty($post_data['password'])){
					$post_data['salt'] = $this->lib_string->random(68);
					$post_data['password'] = $this->lib_string->encryption($post_data['password'], $post_data['salt']);
				}
				$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$this->db->where(array('id' => $id))->update('user', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/member/index'.CMS_SUFFIX, 'Thay đổi thông tin thành viên thành công.'));
			}
		}
		else{
			$data['data']['post_data'] = $member;
		}
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/member/edit';
		$this->load->view('backend/layouts/home', $data);
	}

	public function reset($id = 0){
		$id = (int)$id;
		$member = $this->db->select('username, email, fullname')->where(array('id' => $id))->from('user')->get()->row_array();
		if(!isset($member) || count($member) == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/member/index'.CMS_SUFFIX, 'thành viên không tồn tại.'));
		$post_data['salt'] = $this->lib_string->random(68);
		$post_data['password'] = $this->lib_string->encryption($member['username'], $post_data['salt']);
		$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
		$this->db->where(array('id' => $id))->update('user', $post_data);
		die($this->lib_common->js_redirect(CMS_BACKEND.'/member/index'.CMS_SUFFIX, 'Reset mật khẩu thành viên thành công.'));
	}

	public function group($id = 0){
		$id = (int)$id;
		$member = $this->db->select('group')->where(array('id' => $id))->from('user')->get()->row_array();
		if(!isset($member) || count($member) == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/member/index'.CMS_SUFFIX, 'thành viên không tồn tại.'));
		if($member['group'] == 'Người quản lý'){
			$post_data['group'] = 'Người viết bài';
		}
		else if($member['group'] == 'Người viết bài'){
			$post_data['group'] = 'Người quản lý';
		}
		$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
		$this->db->where(array('id' => $id))->update('user', $post_data);
		die($this->lib_common->js_redirect(CMS_BACKEND.'/member/index'.CMS_SUFFIX, 'Đổi chức danh thành viên thành công.'));
	}

	public function index(){
		$data['meta_title'] = 'Quản lý thành viên';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$sort = $this->lib_common->sort_field('member');
		$page = $this->input->get('page'); $page = isset($page)?(int)$page:0;
		$keyword = $this->input->get('keyword');
		$config['use_page_numbers'] = TRUE;
		if(!empty($keyword)){
			$query_sql = 'SELECT * FROM '.CMS_PREFIX.'user WHERE (`username` LIKE ? OR `email` LIKE ?)';
			$query_param = array('%'.$keyword.'%', '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($query_sql, $query_param)->num_rows();
			$config['base_url'] = CMS_BACKEND.'/member/index'.CMS_SUFFIX.'?keyword='.urlencode($keyword).'&';
		}
		else{
			$config['total_rows'] = $this->db->from('user')->count_all_results();
			$config['base_url'] = CMS_BACKEND.'/member/index'.CMS_SUFFIX.'?';
		}
		$config['per_page'] = 10;
		$total = ceil($config['total_rows']/$config['per_page']);
		$page = ($page <= 0)?1:$page;
		$page = ($page >= $total)?$total:$page;
		$config['cms_cur_page'] = $page;
		if($total > 0){
			$page = $page - 1;
			$this->pagination->initialize($config);
			if(!empty($keyword)){
				$query_sql = 'SELECT * FROM '.CMS_PREFIX.'user WHERE (`username` LIKE ? OR `email` LIKE ?) LIMIT '.($page * $config['per_page']).', '.$config['per_page'];
				$query_param = array('%'.$keyword.'%', '%'.$keyword.'%');
				$data['data']['full_data'] = $this->db->query($query_sql, $query_param)->result_array();
			}
			else{
				$data['data']['full_data'] = $this->db->from('user')->limit($config['per_page'], $page * $config['per_page'])->order_by($sort['field'].' '.$sort['sort'])->get()->result_array();
			}
			$data['data']['full_page'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		$data['data']['keyword'] = $keyword;
		$data['data']['sort'] = $sort;
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/member/index';
		$this->load->view('backend/layouts/home', $data);
	}

	public function _check_username($username = ''){
		$user = $this->db->where(array('username' => $username))->from('user')->count_all_results();
		if($user > 0){
			$this->form_validation->set_message('_check_username', 'Tên sử dụng "'.$username.'" đã tồn tại.');
			return FALSE;
		}
		return TRUE;
	}

	public function _check_email($email = '', $oldemail = ''){
		$user = $this->db->where(array('email' => $email, 'email !=' => $oldemail))->from('user')->count_all_results();
		if($user > 0){
			$this->form_validation->set_message('_check_email', 'Email "'.$email.'" đã tồn tại.');
			return FALSE;
		}
		return TRUE;
	}
}