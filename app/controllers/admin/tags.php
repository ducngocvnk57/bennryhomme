<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends MY_Controller{

	public $auth;
	public $menu_active;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check();
		if($this->auth == NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/home/index'.CMS_SUFFIX));
		$this->menu_active = 'menu-tags';
	}

	public function add(){
		$data['meta_title'] = 'Thêm chủ đề mới';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('title', 'description', 'publish', 'meta_title', 'meta_keyword', 'meta_description'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Chủ đề', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$post_data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_created'] = $this->auth['id'];
				$this->db->insert('tags', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/tags/index'.CMS_SUFFIX, 'Thêm chủ đề mới thành công.'));
			}
		}
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/tags/add';
		$this->load->view('backend/layouts/home', $data);
	}

	public function edit($id = 0){
		$id = (int)$id;
		$tags = $this->db->select('title, description, publish, meta_title, meta_keyword, meta_description')->where(array('id' => $id))->from('tags')->get()->row_array();
		if(!isset($tags) || count($tags) == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/tags/index'.CMS_SUFFIX, 'chủ đề không tồn tại.'));
		$data['meta_title'] = 'Thay đổi thông tin chủ đề';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('title', 'description', 'publish', 'meta_title', 'meta_keyword', 'meta_description'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Chủ đề', 'trim|required');
			if($this->form_validation->run() == TRUE){
				$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_updated'] = $this->auth['id'];
				$this->db->where(array('id' => $id))->update('tags', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/tags/index'.CMS_SUFFIX, 'Thay đổi thông tin chủ đề thành công.'));
			}
		}
		else{
			$data['data']['post_data'] = $tags;
		}
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/tags/edit';
		$this->load->view('backend/layouts/home', $data);
	}

	public function index(){
		$data['meta_title'] = 'Quản lý chủ đề';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$sort = $this->lib_common->sort_field('tags');
		$page = $this->input->get('page'); $page = isset($page)?(int)$page:0;
		$keyword = $this->input->get('keyword');
		$config['use_page_numbers'] = TRUE;
		if(!empty($keyword)){
			$query_sql = 'SELECT * FROM '.CMS_PREFIX.'tags WHERE (`title` LIKE ?)';
			$query_param = array('%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($query_sql, $query_param)->num_rows();
			$config['base_url'] = CMS_BACKEND.'/tags/index'.CMS_SUFFIX.'?keyword='.urlencode($keyword).'&';
		}
		else{
			$config['total_rows'] = $this->db->from('tags')->count_all_results();
			$config['base_url'] = CMS_BACKEND.'/tags/index'.CMS_SUFFIX.'?';
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
				$query_sql = 'SELECT * FROM '.CMS_PREFIX.'tags WHERE (`title` LIKE ?) LIMIT '.($page * $config['per_page']).', '.$config['per_page'];
				$query_param = array('%'.$keyword.'%');
				$data['data']['full_data'] = $this->db->query($query_sql, $query_param)->result_array();
			}
			else{
				$data['data']['full_data'] = $this->db->from('tags')->limit($config['per_page'], $page * $config['per_page'])->order_by($sort['field'].' '.$sort['sort'])->get()->result_array();
			}
			$data['data']['full_page'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		$data['data']['keyword'] = $keyword;
		$data['data']['sort'] = $sort;
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/tags/index';
		$this->load->view('backend/layouts/home', $data);
	}

	public function suggest($char = ''){
		$this->lib_tags->suggest($char);
	}

	public function insert(){
		$item = $this->input->post('item');
		$list = $this->input->post('list');
		$this->lib_tags->insert($item, $list);
	}
}