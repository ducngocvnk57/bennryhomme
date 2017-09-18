<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends MY_Controller{

	public $auth;
	public $menu_active;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check();
		if($this->auth == NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/home/index'.CMS_SUFFIX));
		$this->menu_active = 'menu-articles';
	}

	public function additem(){
		$data['meta_title'] = 'Thêm bài viết mới';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('title', 'image', 'parentid', 'description', 'content', 'tags', 'publish', 'meta_title', 'meta_keyword', 'meta_description'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required');
			$this->form_validation->set_rules('data[parentid]', 'Node cha', 'trim|required|is_natural_no_zero');
			if($this->form_validation->run() == TRUE){
				$post_data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_created'] = $this->auth['id'];
				$this->db->insert('articles_item', $post_data);
				$this->lib_tags->insert_list($post_data['tags']);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/articles/item'.CMS_SUFFIX, 'Thêm bài viết mới thành công.'));
			}
		}
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('articles_category', NULL, 'category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/articles/additem';
		$this->load->view('backend/layouts/home', $data);
	}

	public function edititem($id = 0){
		$id = (int)$id;
		$item = $this->db->select('title, image, parentid, description, content, tags, publish, meta_title, meta_keyword, meta_description')->where(array('id' => $id))->from('articles_item')->get()->row_array();
		if(!isset($item) || count($item) == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/articles/item'.CMS_SUFFIX, 'bài viết không tồn tại.'));
		$data['meta_title'] = 'Thay đổi thông tin bài viết';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('title', 'image', 'parentid', 'description', 'content', 'tags', 'publish', 'meta_title', 'meta_keyword', 'meta_description'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required');
			$this->form_validation->set_rules('data[parentid]', 'Node cha', 'trim|required|is_natural_no_zero');
			if($this->form_validation->run() == TRUE){
				$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_updated'] = $this->auth['id'];
				$this->db->where(array('id' => $id))->update('articles_item', $post_data);
				$this->lib_tags->insert_list($post_data['tags']);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/articles/item'.CMS_SUFFIX, 'Thay đổi thông tin bài viết thành công.'));
			}
		}
		else{
			$data['data']['post_data'] = $item;
		}
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('articles_category', NULL, 'category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/articles/edititem';
		$this->load->view('backend/layouts/home', $data);
	}

	public function item(){
		$data['meta_title'] = 'Quản lý bài viết';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$sort = $this->lib_common->sort_field('articles_item');
		$page = $this->input->get('page'); $page = isset($page)?(int)$page:0;
		$parentid = $this->input->get('parentid'); $parentid = isset($parentid)?(int)$parentid:0;
		$keyword = $this->input->get('keyword');
		$config['use_page_numbers'] = TRUE;
		if($parentid > 0 && empty($keyword)){
			$config['total_rows'] = $this->db->from('articles_item')->where(array('parentid' => $parentid))->count_all_results();
			$config['base_url'] = CMS_BACKEND.'/articles/item'.CMS_SUFFIX.'?parentid='.$parentid.'&';
		}
		else if($parentid == 0 && !empty($keyword)){
			$query_sql = 'SELECT * FROM '.CMS_PREFIX.'articles_item WHERE (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?)';
			$query_param = array('%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($query_sql, $query_param)->num_rows();
			$config['base_url'] = CMS_BACKEND.'/articles/item'.CMS_SUFFIX.'?keyword='.urlencode($keyword).'&';
		}
		else if($parentid > 0 && !empty($keyword)){
			$query_sql = 'SELECT * FROM '.CMS_PREFIX.'articles_item WHERE `parentid` = ? AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?)';
			$query_param = array($parentid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($query_sql, $query_param)->num_rows();
			$config['base_url'] = CMS_BACKEND.'/articles/item'.CMS_SUFFIX.'?keyword='.urlencode($keyword).'&';
		}
		else{
			$config['total_rows'] = $this->db->from('articles_item')->count_all_results();
			$config['base_url'] = CMS_BACKEND.'/articles/item'.CMS_SUFFIX.'?';
		}
		$config['per_page'] = 10;
		$total = ceil($config['total_rows']/$config['per_page']);
		$page = ($page <= 0)?1:$page;
		$page = ($page >= $total)?$total:$page;
		$config['cms_cur_page'] = $page;
		if($total > 0){
			$page = $page - 1;
			$this->pagination->initialize($config);
			if($parentid > 0 && empty($keyword)){
				$data['data']['full_data'] = $this->db->from('articles_item')->where(array('parentid' => $parentid))->limit($config['per_page'], $page * $config['per_page'])->order_by($sort['field'].' '.$sort['sort'])->get()->result_array();
			}
			else if($parentid == 0 && !empty($keyword)){
				$query_sql = 'SELECT * FROM '.CMS_PREFIX.'articles_item WHERE (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?) LIMIT '.($page * $config['per_page']).', '.$config['per_page'];
				$query_param = array('%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
				$data['data']['full_data'] = $this->db->query($query_sql, $query_param)->result_array();
			}
			else if($parentid > 0 && !empty($keyword)){
				$query_sql = 'SELECT * FROM '.CMS_PREFIX.'articles_item WHERE `parentid` = ? AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?) LIMIT '.($page * $config['per_page']).', '.$config['per_page'];
				$query_param = array($parentid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
				$data['data']['full_data'] = $this->db->query($query_sql, $query_param)->result_array();
			}
			else{
				$data['data']['full_data'] = $this->db->from('articles_item')->limit($config['per_page'], $page * $config['per_page'])->order_by($sort['field'].' '.$sort['sort'])->get()->result_array();
			}
			$data['data']['full_page'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		$data['data']['keyword'] = $keyword;
		$data['data']['sort'] = $sort;
		$data['data']['post_data']['parentid'] = $parentid;
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('articles_category', NULL, 'item');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/articles/item';
		$this->load->view('backend/layouts/home', $data);
	}

	public function addcategory(){
		$data['meta_title'] = 'Thêm danh mục bài viết';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$this->lib_nestedset->check_empty('articles_category');
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('title', 'image', 'parentid', 'description', 'desc', 'publish', 'meta_title', 'meta_keyword', 'meta_description'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required');
			$this->form_validation->set_rules('data[parentid]', 'Node cha', 'trim|required|is_natural_no_zero');
			if($this->form_validation->run() == TRUE){
				$post_data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_created'] = $this->auth['id'];
				$this->db->insert('articles_category', $post_data);
				$this->lib_nestedset->set('articles_category');
				die($this->lib_common->js_redirect(CMS_BACKEND.'/articles/category'.CMS_SUFFIX, 'Thêm danh mục bài viết mới thành công.'));
			}
		}
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('articles_category', NULL, 'category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/articles/addcategory';
		$this->load->view('backend/layouts/home', $data);
	}

	public function editcategory($id = 0){
		$id = (int)$id;
		$category = $this->db->select('title, image ,parentid, description, desc, publish, level, meta_title, meta_keyword, meta_description')->where(array('id' => $id))->from('articles_category')->get()->row_array();
		if(!isset($category) || count($category) == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/articles/category'.CMS_SUFFIX, 'Danh mục bài viết không tồn tại.'));
		if($category['level'] == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/articles/category'.CMS_SUFFIX, 'Không sửa được danh mục này.'));
		$data['meta_title'] = 'Thay đổi thông tin danh mục bài viết';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('title', 'image', 'parentid', 'description', 'desc', 'publish', 'meta_title', 'meta_keyword', 'meta_description'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required');
			$this->form_validation->set_rules('data[parentid]', 'Node cha', 'trim|required|is_natural_no_zero|callback__check_parentid['.$id.']');
			if($this->form_validation->run() == TRUE){
				$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_updated'] = $this->auth['id'];
				$this->db->where(array('id' => $id))->update('articles_category', $post_data);
				$this->lib_nestedset->set('articles_category');
				die($this->lib_common->js_redirect(CMS_BACKEND.'/articles/category'.CMS_SUFFIX, 'Thay đổi thông tin danh mục bài viết thành công.'));
			}
		}
		else{
			$data['data']['post_data'] = $category;
		}
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('articles_category', NULL, 'category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/articles/editcategory';
		$this->load->view('backend/layouts/home', $data);
	}

	public function category(){
		$data['meta_title'] = 'Quản lý danh mục bài viết';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$this->lib_nestedset->set('articles_category');
		$data['data']['full_data'] = $this->lib_nestedset->data('articles_category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/articles/category';
		$this->load->view('backend/layouts/home', $data);
	}

	public function _check_parentid($parentid, $catid){
		$parentid = (int)$parentid;
		$catid = (int)$catid;
		return $this->lib_nestedset->check_parentid('articles_category', $parentid, $catid);
	}

}