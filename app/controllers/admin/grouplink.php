<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class grouplink extends MY_Controller{

	public $auth;
	public $menu_active;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check();
		if($this->auth == NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/home/index'.CMS_SUFFIX));
		$this->menu_active = 'menu-grouplink';
	}

	public function additem(){
		$data['meta_title'] = 'Thêm nhóm link mới';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('title', 'url', 'parentid'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required');
			$this->form_validation->set_rules('data[parentid]', 'Node cha', 'trim|required|is_natural_no_zero');
			if($this->form_validation->run() == TRUE){
				$post_data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_created'] = $this->auth['id'];
				$this->db->insert('grouplink_item', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/grouplink/item'.CMS_SUFFIX, 'Thêm nhóm link mới thành công.'));
			}
		}
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('grouplink_category', NULL, 'category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/grouplink/additem';
		$this->load->view('backend/layouts/home', $data);
	}

	public function edititem($id = 0){
		$id = (int)$id;
		$item = $this->db->select('title, url, parentid')->where(array('id' => $id))->from('grouplink_item')->get()->row_array();
		if(!isset($item) || count($item) == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/grouplink/item'.CMS_SUFFIX, 'nhóm link không tồn tại.'));
		$data['meta_title'] = 'Thay đổi thông tin nhóm link';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('title', 'url', 'parentid'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required');
			$this->form_validation->set_rules('data[parentid]', 'Node cha', 'trim|required|is_natural_no_zero');
			if($this->form_validation->run() == TRUE){
				$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_updated'] = $this->auth['id'];
				$this->db->where(array('id' => $id))->update('grouplink_item', $post_data);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/grouplink/item'.CMS_SUFFIX, 'Thay đổi thông tin nhóm link thành công.'));
			}
		}
		else{
			$data['data']['post_data'] = $item;
		}
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('grouplink_category', NULL, 'category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/grouplink/edititem';
		$this->load->view('backend/layouts/home', $data);
	}

	public function item(){
		$data['meta_title'] = 'Quản lý nhóm link';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$sort = $this->lib_common->sort_field('grouplink_item');
		$page = $this->input->get('page'); $page = isset($page)?(int)$page:0;
		$parentid = $this->input->get('parentid'); $parentid = isset($parentid)?(int)$parentid:0;
		$keyword = $this->input->get('keyword');
		$config['use_page_numbers'] = TRUE;
		if($parentid > 0 && empty($keyword)){
			$config['total_rows'] = $this->db->from('grouplink_item')->where(array('parentid' => $parentid))->count_all_results();
			$config['base_url'] = CMS_BACKEND.'/grouplink/item'.CMS_SUFFIX.'?parentid='.$parentid.'&';
		}
		else if($parentid == 0 && !empty($keyword)){
			$query_sql = 'SELECT * FROM '.CMS_PREFIX.'grouplink_item WHERE (`title` LIKE ?)';
			$query_param = array('%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($query_sql, $query_param)->num_rows();
			$config['base_url'] = CMS_BACKEND.'/grouplink/item'.CMS_SUFFIX.'?keyword='.urlencode($keyword).'&';
		}
		else if($parentid > 0 && !empty($keyword)){
			$query_sql = 'SELECT * FROM '.CMS_PREFIX.'grouplink_item WHERE `parentid` = ? AND (`title` LIKE ?)';
			$query_param = array($parentid, '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($query_sql, $query_param)->num_rows();
			$config['base_url'] = CMS_BACKEND.'/grouplink/item'.CMS_SUFFIX.'?keyword='.urlencode($keyword).'&';
		}
		else{
			$config['total_rows'] = $this->db->from('grouplink_item')->count_all_results();
			$config['base_url'] = CMS_BACKEND.'/grouplink/item'.CMS_SUFFIX.'?';
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
				$data['data']['full_data'] = $this->db->from('grouplink_item')->where(array('parentid' => $parentid))->limit($config['per_page'], $page * $config['per_page'])->order_by($sort['field'].' '.$sort['sort'])->get()->result_array();
			}
			else if($parentid == 0 && !empty($keyword)){
				$query_sql = 'SELECT * FROM '.CMS_PREFIX.'grouplink_item WHERE (`title` LIKE ?) LIMIT '.($page * $config['per_page']).', '.$config['per_page'];
				$query_param = array('%'.$keyword.'%');
				$data['data']['full_data'] = $this->db->query($query_sql, $query_param)->result_array();
			}
			else if($parentid > 0 && !empty($keyword)){
				$query_sql = 'SELECT * FROM '.CMS_PREFIX.'grouplink_item WHERE `parentid` = ? AND (`title` LIKE ?) LIMIT '.($page * $config['per_page']).', '.$config['per_page'];
				$query_param = array($parentid, '%'.$keyword.'%');
				$data['data']['full_data'] = $this->db->query($query_sql, $query_param)->result_array();
			}
			else{
				$data['data']['full_data'] = $this->db->from('grouplink_item')->limit($config['per_page'], $page * $config['per_page'])->order_by($sort['field'].' '.$sort['sort'])->get()->result_array();
			}
			$data['data']['full_page'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		$data['data']['keyword'] = $keyword;
		$data['data']['sort'] = $sort;
		$data['data']['post_data']['parentid'] = $parentid;
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('grouplink_category', NULL, 'item');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/grouplink/item';
		$this->load->view('backend/layouts/home', $data);
	}

	public function addcategory(){
		$data['meta_title'] = 'Thêm danh mục nhóm link';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$this->lib_nestedset->check_empty('grouplink_category');
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('title', 'parentid', 'publish'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required');
			$this->form_validation->set_rules('data[parentid]', 'Node cha', 'trim|required|is_natural_no_zero');
			if($this->form_validation->run() == TRUE){
				$post_data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_created'] = $this->auth['id'];
				$this->db->insert('grouplink_category', $post_data);
				$this->lib_nestedset->set('grouplink_category');
				die($this->lib_common->js_redirect(CMS_BACKEND.'/grouplink/category'.CMS_SUFFIX, 'Thêm danh mục nhóm link mới thành công.'));
			}
		}
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('grouplink_category', NULL, 'category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/grouplink/addcategory';
		$this->load->view('backend/layouts/home', $data);
	}

	public function editcategory($id = 0){
		$id = (int)$id;
		$category = $this->db->select('title, parentid, publish, level')->where(array('id' => $id))->from('grouplink_category')->get()->row_array();
		if(!isset($category) || count($category) == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/grouplink/category'.CMS_SUFFIX, 'Danh mục nhóm link không tồn tại.'));
		if($category['level'] == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/grouplink/category'.CMS_SUFFIX, 'Không sửa được danh mục này.'));
		$data['meta_title'] = 'Thay đổi thông tin danh mục nhóm link';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('title', 'parentid', 'publish'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required');
			$this->form_validation->set_rules('data[parentid]', 'Node cha', 'trim|required|is_natural_no_zero|callback__check_parentid['.$id.']');
			if($this->form_validation->run() == TRUE){
				$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_updated'] = $this->auth['id'];
				$this->db->where(array('id' => $id))->update('grouplink_category', $post_data);
				$this->lib_nestedset->set('grouplink_category');
				die($this->lib_common->js_redirect(CMS_BACKEND.'/grouplink/category'.CMS_SUFFIX, 'Thay đổi thông tin danh mục nhóm link thành công.'));
			}
		}
		else{
			$data['data']['post_data'] = $category;
		}
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('grouplink_category', NULL, 'category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/grouplink/editcategory';
		$this->load->view('backend/layouts/home', $data);
	}

	public function category(){
		$data['meta_title'] = 'Quản lý danh mục nhóm link';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$this->lib_nestedset->set('grouplink_category');
		$data['data']['full_data'] = $this->lib_nestedset->data('grouplink_category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/grouplink/category';
		$this->load->view('backend/layouts/home', $data);
	}

	public function _check_parentid($parentid, $catid){
		$parentid = (int)$parentid;
		$catid = (int)$catid;
		return $this->lib_nestedset->check_parentid('grouplink_category', $parentid, $catid);
	}

}