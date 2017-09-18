<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class thuonghieu extends MY_Controller{

	public $auth;
	public $menu_active;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check();
		if($this->auth == NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/home/index'.CMS_SUFFIX));
		$this->menu_active = 'menu-thuonghieu';
	}

	public function add(){
		$data['meta_title'] = 'Thêm thương hiệu mới';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			// $post_data = $this->lib_post->allows($post_data, array('title', 'publish'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tên thương hiệu', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$post_data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_created'] = $this->auth['id'];
				$this->db->insert('thuonghieu', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/thuonghieu/index'.CMS_SUFFIX, 'Thêm thương hiệu mới thành công.'));
			}
		}
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/thuonghieu/add';
		$this->load->view('backend/layouts/home', $data);
	}

	public function edit($id = 0){
		$id = (int)$id;
		$thuonghieu = $this->db->select('title, publish')->where(array('id' => $id))->from('thuonghieu')->get()->row_array();
		if(!isset($thuonghieu) || count($thuonghieu) == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/thuonghieu/index'.CMS_SUFFIX, 'thương hiệu không tồn tại.'));
		$data['meta_title'] = 'Thay đổi thông tin thương hiệu';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			// $post_data = $this->lib_post->allows($post_data, array('title', 'publish'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tên thương hiệu', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_updated'] = $this->auth['id'];
				$this->db->where(array('id' => $id))->update('thuonghieu', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/thuonghieu/index'.CMS_SUFFIX, 'Thay đổi thông tin thương hiệu thành công.'));
			}
		}
		else{
			$data['data']['post_data'] = $thuonghieu;
		}
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/thuonghieu/edit';
		$this->load->view('backend/layouts/home', $data);
	}

	public function index(){
		$data['meta_title'] = 'Quản lý thương hiệu';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$sort = $this->lib_common->sort_field('thuonghieu');
		$page = $this->input->get('page'); $page = isset($page)?(int)$page:0;
		$keyword = $this->input->get('keyword');
		$config['use_page_numbers'] = TRUE;
		if(!empty($keyword)){
			$query_sql = 'SELECT * FROM '.CMS_PREFIX.'thuonghieu WHERE (`title` LIKE ? OR `notes` LIKE ? OR `address` LIKE ? OR `phone` LIKE ? OR `email` LIKE ?)';
			$query_param = array('%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($query_sql, $query_param)->num_rows();
			$config['base_url'] = CMS_BACKEND.'/thuonghieu/index'.CMS_SUFFIX.'?keyword='.urlencode($keyword).'&';
		}
		else{
			$config['total_rows'] = $this->db->from('thuonghieu')->count_all_results();
			$config['base_url'] = CMS_BACKEND.'/thuonghieu/index'.CMS_SUFFIX.'?';
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
				$data['data']['full_data'] = $this->db->from('thuonghieu')->limit($config['per_page'], $page * $config['per_page'])->order_by($sort['field'].' '.$sort['sort'])->get()->result_array();
			}
			$data['data']['full_page'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		$data['data']['keyword'] = $keyword;
		$data['data']['sort'] = $sort;
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/thuonghieu/index';
		$this->load->view('backend/layouts/home', $data);
	}

}