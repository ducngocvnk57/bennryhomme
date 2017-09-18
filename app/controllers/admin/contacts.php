<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends MY_Controller{

	public $auth;
	public $menu_active;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check();
		if($this->auth == NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/home/index'.CMS_SUFFIX));
		$this->menu_active = 'menu-contacts';
	}

	public function add(){
		$data['meta_title'] = 'Thêm liên hệ mới';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('fullname', 'notes', 'address', 'phone', 'email', 'publish'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[fullname]', 'Tên liên hệ', 'trim|required');
			$this->form_validation->set_rules('data[address]', 'Địa chỉ', 'trim|required');
			$this->form_validation->set_rules('data[phone]', 'Điện thoại', 'trim|required');
			if(!empty($post_data['email'])){
				$this->form_validation->set_rules('data[email]', 'Email', 'trim|valid_email');
			}
			if($this->form_validation->run() == TRUE){
				$post_data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_created'] = $this->auth['id'];
				$this->db->insert('contacts', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/contacts/index'.CMS_SUFFIX, 'Thêm liên hệ mới thành công.'));
			}
		}
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/contacts/add';
		$this->load->view('backend/layouts/home', $data);
	}

	public function edit($id = 0){
		$id = (int)$id;
		$contacts = $this->db->select('fullname, notes, address, phone, email, publish')->where(array('id' => $id))->from('contacts')->get()->row_array();
		if(!isset($contacts) || count($contacts) == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/contacts/index'.CMS_SUFFIX, 'liên hệ không tồn tại.'));
		$data['meta_title'] = 'Thay đổi thông tin liên hệ';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('fullname', 'notes', 'address', 'phone', 'email', 'publish'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[fullname]', 'Tên liên hệ', 'trim|required');
			$this->form_validation->set_rules('data[address]', 'Địa chỉ', 'trim|required');
			$this->form_validation->set_rules('data[phone]', 'Điện thoại', 'trim|required');
			if(!empty($post_data['email'])){
				$this->form_validation->set_rules('data[email]', 'Email', 'trim|valid_email');
			}
			if($this->form_validation->run() == TRUE){
				$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_updated'] = $this->auth['id'];
				$this->db->where(array('id' => $id))->update('contacts', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/contacts/index'.CMS_SUFFIX, 'Thay đổi thông tin liên hệ thành công.'));
			}
		}
		else{
			$data['data']['post_data'] = $contacts;
		}
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/contacts/edit';
		$this->load->view('backend/layouts/home', $data);
	}

	public function index(){
		$data['meta_title'] = 'Quản lý liên hệ';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$sort = $this->lib_common->sort_field('contacts');
		$page = $this->input->get('page'); $page = isset($page)?(int)$page:0;
		$keyword = $this->input->get('keyword');
		$config['use_page_numbers'] = TRUE;
		if(!empty($keyword)){
			$query_sql = 'SELECT * FROM '.CMS_PREFIX.'contacts WHERE (`fullname` LIKE ? OR `notes` LIKE ? OR `address` LIKE ? OR `phone` LIKE ? OR `email` LIKE ?)';
			$query_param = array('%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($query_sql, $query_param)->num_rows();
			$config['base_url'] = CMS_BACKEND.'/contacts/index'.CMS_SUFFIX.'?keyword='.urlencode($keyword).'&';
		}
		else{
			$config['total_rows'] = $this->db->from('contacts')->count_all_results();
			$config['base_url'] = CMS_BACKEND.'/contacts/index'.CMS_SUFFIX.'?';
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
				$data['data']['full_data'] = $this->db->query($query_sql, $query_param)->result_array();
			}
			else{
				$data['data']['full_data'] = $this->db->from('contacts')->limit($config['per_page'], $page * $config['per_page'])->order_by($sort['field'].' '.$sort['sort'])->get()->result_array();
			}
			$data['data']['full_page'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		$data['data']['keyword'] = $keyword;
		$data['data']['sort'] = $sort;
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/contacts/index';
		$this->load->view('backend/layouts/home', $data);
	}

}