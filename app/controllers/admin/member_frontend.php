<?php if ( ! defined('BASEPATH')) exit('No direct script member allowed');

class member_frontend extends MY_Controller{

	public $auth;
	public $menu_active;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check();
		if($this->auth == NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/home/index'.CMS_SUFFIX));
		if($this->auth['group'] != 'Người quản lý') die($this->lib_common->js_redirect(CMS_BACKEND));
		$this->menu_active = 'menu-member-frontend';
	}

	public function add(){
		$data['meta_title'] = 'Thêm khách hàng mới';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('user', 'password', 'email', 'fullname', 'shopname', 'phone', 'address'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[user]', 'Tên sử dụng', 'trim|required|min_length[3]|max_length[20]|regex_match[/^([a-z0-9_])+$/i]|callback__check_user');
			$this->form_validation->set_rules('data[password]', 'Mật khẩu', 'trim|required');
			$this->form_validation->set_rules('data[email]', 'Email', 'trim|required|valid_email|callback__check_email');
			$this->form_validation->set_rules('data[fullname]', 'Tên khách hàng', 'trim|required');
			$this->form_validation->set_rules('data[shopname]', 'Tên shop', 'trim|required');
			$this->form_validation->set_rules('data[address]', 'Địa chỉ', 'trim|required');
			$this->form_validation->set_rules('data[phone]', 'Số điện thoại', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$post_data['salt'] = $this->lib_string->random(68);
				$post_data['password'] = $this->lib_string->encryption($post_data['password'], $post_data['salt']);
				$post_data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$this->db->insert('user_customer', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/member_frontend/index'.CMS_SUFFIX, 'Thêm khách hàng thành công.'));
			}
		}
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/member_frontend/add';
		$this->load->view('backend/layouts/home', $data);
	}

	public function index(){
		$data['meta_title'] = 'Quản lý khách hàng';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$sort = $this->lib_common->sort_field('member_frontend');
		$page = $this->input->get('page'); $page = isset($page)?(int)$page:0;
		$keyword = $this->input->get('keyword');
		$config['use_page_numbers'] = TRUE;
		if(!empty($keyword)){
			$query_sql = 'SELECT * FROM '.CMS_PREFIX.'user WHERE (`user` LIKE ? OR `email` LIKE ?)';
			$query_param = array('%'.$keyword.'%', '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($query_sql, $query_param)->num_rows();
			$config['base_url'] = CMS_BACKEND.'/member_frontend/index'.CMS_SUFFIX.'?keyword='.urlencode($keyword).'&';
		}
		else{
			$config['total_rows'] = $this->db->from('user_customer')->count_all_results();
			$config['base_url'] = CMS_BACKEND.'/member_frontend/index'.CMS_SUFFIX.'?';
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
				$query_sql = 'SELECT * FROM '.CMS_PREFIX.'user WHERE (`user` LIKE ? OR `email` LIKE ?) LIMIT '.($page * $config['per_page']).', '.$config['per_page'];
				$query_param = array('%'.$keyword.'%', '%'.$keyword.'%');
				$data['data']['full_data'] = $this->db->query($query_sql, $query_param)->result_array();
			}
			else{
				$data['data']['full_data'] = $this->db->from('user_customer')->limit($config['per_page'], $page * $config['per_page'])->order_by($sort['field'].' '.$sort['sort'])->get()->result_array();
			}
			$data['data']['full_page'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		$data['data']['keyword'] = $keyword;
		$data['data']['sort'] = $sort;
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/member_frontend/index';
		$this->load->view('backend/layouts/home', $data);
	}
	

	public function edit($id = 0){
		$id = (int)$id;
		$member_frontend = $this->db->select('user, email, fullname, shopname, address, phone, business, source')->where(array('id' => $id))->from('user_customer')->get()->row_array();
		if(!isset($member_frontend) || count($member_frontend) == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/member_frontend/index'.CMS_SUFFIX, 'khách hàng không tồn tại.'));
		$data['meta_title'] = 'Thay đổi thông tin khách hàng';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('password', 'email', 'fullname', 'shopname', 'address', 'phone'));
			$post_data['user'] = $member_frontend['user'];
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[email]', 'Email', 'trim|required|valid_email|callback__check_email['.$member_frontend['email'].']');
			$this->form_validation->set_rules('data[fullname]', 'Tên hiển thị', 'trim|required');
			if($this->form_validation->run() == TRUE){
				if(!empty($post_data['password'])){
					$post_data['salt'] = $this->lib_string->random(68);
					$post_data['password'] = $this->lib_string->encryption($post_data['password'], $post_data['salt']);
				}
				$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$this->db->where(array('id' => $id))->update('user_customer', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/member_frontend/index'.CMS_SUFFIX, 'Thay đổi thông tin khách hàng thành công.'));
			}
		}
		else{
			$data['data']['post_data'] = $member_frontend;
		}
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/member_frontend/edit';
		$this->load->view('backend/layouts/home', $data);
	}

	public function reset($id = 0){
		$id = (int)$id;
		$member = $this->db->select('user, email, fullname')->where(array('id' => $id))->from('user_customer')->get()->row_array();
		if(!isset($member) || count($member) == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/member_frontend/index'.CMS_SUFFIX, 'thành viên không tồn tại.'));
		$post_data['salt'] = $this->lib_string->random(68);
		$post_data['password'] = $this->lib_string->encryption($member['user'], $post_data['salt']);
		$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
		$this->db->where(array('id' => $id))->update('user_customer', $post_data);
		die($this->lib_common->js_redirect(CMS_BACKEND.'/member_frontend/index'.CMS_SUFFIX, 'Reset mật khẩu khách hàng thành công.'));
	}

	public function _check_user($user = ''){
		$user = $this->db->where(array('user' => $user))->from('user_customer')->count_all_results();
		if($user > 0){
			$this->form_validation->set_message('_check_user', 'Tên sử dụng đã tồn tại.');
			return FALSE;
		}
		return TRUE;
		
	}

	public function _check_email($email = '', $oldemail = ''){
		$user = $this->db->where(array('email' => $email, 'email !=' => $oldemail))->from('user_customer')->count_all_results();
		if($user > 0){
			$this->form_validation->set_message('_check_email', 'Email "'.$email.'" đã tồn tại.');
			return FALSE;
		}
		return TRUE;
	}
}