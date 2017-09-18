<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bst extends MY_Controller{

	public $auth;
	public $menu_active;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check();
		if($this->auth == NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/home/index'.CMS_SUFFIX));
		$this->menu_active = 'menu-bst';
	}

	public function additem(){
		$data['meta_title'] = 'Thêm bộ sưu tập mới';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data['images'] = (!empty($post_data['images']))?base64_encode(json_encode($post_data['images'])):'';
			$post_data = $this->lib_post->allows($post_data, array('title', 'url_config', 'series', 'referencenumber', 'image' , 'images', 'parentid', 'labelid', 'color_product', 'size_product', 'description', 'diemnoibat', 'luuy', 'retail_price', 'our_price', 'price', 'content', 'tags', 'publish', 'viewed', 'bought', 'meta_title', 'meta_keyword', 'meta_description'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required');
			$this->form_validation->set_rules('data[parentid]', 'Node cha', 'trim|required|is_natural_no_zero');
			if($this->form_validation->run() == TRUE){
				$post_data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_created'] = $this->auth['id'];
				$this->db->insert('bst_item', $post_data);
				$this->lib_tags->insert_list($post_data['tags']);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/bst/item'.CMS_SUFFIX, 'Thêm bộ sưu tập mới thành công.'));
			}
		}
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('bst_category', NULL, 'category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/bst/additem';
		$this->load->view('backend/layouts/home', $data);
	}

	public function edititem($id = 0){
		$id = (int)$id;
		$item = $this->db->select('title, url_config, series, referencenumber, image, images, parentid, labelid, color_product, size_product, description, diemnoibat, luuy, retail_price, our_price, price, content, tags, publish, viewed, bought, meta_title, meta_keyword, meta_description')->where(array('id' => $id))->from('bst_item')->get()->row_array();
		if(!isset($item) || count($item) == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/bst/item'.CMS_SUFFIX, 'bộ sưu tập không tồn tại.'));
		$data['meta_title'] = 'Thay đổi thông tin bộ sưu tập';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data['images'] = base64_encode(json_encode($post_data['images']));
			// print_r($post_data['images']);die;
			$post_data = $this->lib_post->allows($post_data, array('title', 'url_config', 'series', 'referencenumber', 'image' , 'images', 'parentid', 'labelid', 'color_product', 'size_product', 'description', 'diemnoibat', 'luuy', 'retail_price', 'our_price', 'price', 'content', 'tags', 'publish', 'viewed', 'bought', 'meta_title', 'meta_keyword', 'meta_description'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required');
			$this->form_validation->set_rules('data[parentid]', 'Node cha', 'trim|required|is_natural_no_zero');
			if($this->form_validation->run() == TRUE){
				$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_updated'] = $this->auth['id'];
				$this->db->where(array('id' => $id))->update('bst_item', $post_data);
				$this->lib_tags->insert_list($post_data['tags']);
				die($this->lib_common->js_redirect(CMS_BACKEND.'/bst/item'.CMS_SUFFIX, 'Thay đổi thông tin bộ sưu tập thành công.'));
			}
		}
		else{
			$data['data']['post_data'] = $item;
		}
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('bst_category', NULL, 'category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/bst/edititem';
		$this->load->view('backend/layouts/home', $data);
	}

	public function item(){
		$data['meta_title'] = 'Quản lý bộ sưu tập';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$sort = $this->lib_common->sort_field('bst_item');
		$page = $this->input->get('page'); $page = isset($page)?(int)$page:0;
		$parentid = $this->input->get('parentid'); $parentid = isset($parentid)?(int)$parentid:0;
		$keyword = $this->input->get('keyword');
		$config['use_page_numbers'] = TRUE;
		if($parentid > 0 && empty($keyword)){
			$config['total_rows'] = $this->db->from('bst_item')->where(array('parentid' => $parentid))->count_all_results();
			$config['base_url'] = CMS_BACKEND.'/bst/item'.CMS_SUFFIX.'?parentid='.$parentid.'&';
		}
		else if($parentid == 0 && !empty($keyword)){
			$query_sql = 'SELECT * FROM '.CMS_PREFIX.'bst_item WHERE (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?)';
			$query_param = array('%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($query_sql, $query_param)->num_rows();
			$config['base_url'] = CMS_BACKEND.'/bst/item'.CMS_SUFFIX.'?keyword='.urlencode($keyword).'&';
		}
		else if($parentid > 0 && !empty($keyword)){
			$query_sql = 'SELECT * FROM '.CMS_PREFIX.'bst_item WHERE `parentid` = ? AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?)';
			$query_param = array($parentid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($query_sql, $query_param)->num_rows();
			$config['base_url'] = CMS_BACKEND.'/bst/item'.CMS_SUFFIX.'?keyword='.urlencode($keyword).'&';
		}
		else{
			$config['total_rows'] = $this->db->from('bst_item')->count_all_results();
			$config['base_url'] = CMS_BACKEND.'/bst/item'.CMS_SUFFIX.'?';
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
				$data['data']['full_data'] = $this->db->from('bst_item')->where(array('parentid' => $parentid))->limit($config['per_page'], $page * $config['per_page'])->order_by($sort['field'].' '.$sort['sort'])->get()->result_array();
			}
			else if($parentid == 0 && !empty($keyword)){
				$query_sql = 'SELECT * FROM '.CMS_PREFIX.'bst_item WHERE (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?) LIMIT '.($page * $config['per_page']).', '.$config['per_page'];
				$query_param = array('%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
				$data['data']['full_data'] = $this->db->query($query_sql, $query_param)->result_array();
			}
			else if($parentid > 0 && !empty($keyword)){
				$query_sql = 'SELECT * FROM '.CMS_PREFIX.'bst_item WHERE `parentid` = ? AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?) LIMIT '.($page * $config['per_page']).', '.$config['per_page'];
				$query_param = array($parentid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
				$data['data']['full_data'] = $this->db->query($query_sql, $query_param)->result_array();
			}
			else{
				$data['data']['full_data'] = $this->db->from('bst_item')->limit($config['per_page'], $page * $config['per_page'])->order_by($sort['field'].' '.$sort['sort'])->get()->result_array();
			}
			$data['data']['full_page'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		$data['data']['keyword'] = $keyword;
		$data['data']['sort'] = $sort;
		$data['data']['post_data']['parentid'] = $parentid;
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('bst_category', NULL, 'item');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/bst/item';
		$this->load->view('backend/layouts/home', $data);
	}


	public function viewpayment(){
		$data['meta_title'] = 'Quản lý đơn hàng';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		
		$sort = $this->lib_common->sort_field('payment');
		$page = $this->input->get('page'); $page = isset($page)?(int)$page:0;
		$config['use_page_numbers'] = TRUE;
		
		$config['total_rows'] = $this->db->from('payment')->count_all_results();
		$config['base_url'] = CMS_BACKEND.'/bst/viewpayment'.CMS_SUFFIX.'?';
		
		$config['per_page'] = 10;
		$total = ceil($config['total_rows']/$config['per_page']);
		$page = ($page <= 0)?1:$page;
		$page = ($page >= $total)?$total:$page;
		$config['cms_cur_page'] = $page;
		if($total > 0){
			$page = $page - 1;
			$this->pagination->initialize($config);
			
			$data['data']['full_data'] = $this->db->from('payment')->limit($config['per_page'], $page * $config['per_page'])->order_by($sort['field'].' '.$sort['sort'])->get()->result_array();
			
			$data['data']['full_page'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/bst/viewpayment';
		$this->load->view('backend/layouts/home', $data);
	}
	/*
	 * CHI TIẾT ĐƠN HÀNG
	 *****************************/
	public function detailpayment($payid = NULL){
		$data['meta_title'] = 'Chi tiết đơn';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		
		
		$data['data']['post_data']['salt'] = '1';
		$this->db->update('payment', $data['data']['post_data']);
		
		$data['data'] = NULL;
		$payid = (int)$payid;
		
		$payment_item = $this->db->from('payment')->where(array('id' => $payid))->get()->row_array(); // Đọc chuyên mục
		if(isset($payment_item) && count($payment_item)){
			$data['data']['post_data'] = $payment_item; // Gán dữ liệu ra form
			$data['data']['post_data']['created'] = gmdate('d-m-Y H:i:s', strtotime($data['data']['post_data']['created']) + 7*3600);
		}
		else{
			$this->session->set_flashdata('message_error_flash', 'Dữ liệu không tồn tại.');
			die('<script type="text/javascript">location.href=\''.ITQ_URL.'backend/bst/viewpayment'.ITQ_SUFFIX.'\';</script>');
		}
		$data['template'] = 'backend/bst/detailpayment';
		$this->load->view('backend/layouts/home', $data);
	}

	public function addcategory(){
		$data['meta_title'] = 'Thêm danh mục bộ sưu tập';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$this->lib_nestedset->check_empty('bst_category');
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('title','image' , 'icon_img', 'parentid', 'description', 'desc', 'publish', 'meta_title', 'meta_keyword', 'meta_description'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required');
			$this->form_validation->set_rules('data[parentid]', 'Node cha', 'trim|required|is_natural_no_zero');
			if($this->form_validation->run() == TRUE){
				$post_data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_created'] = $this->auth['id'];
				$this->db->insert('bst_category', $post_data);
				$this->lib_nestedset->set('bst_category');
				die($this->lib_common->js_redirect(CMS_BACKEND.'/bst/category'.CMS_SUFFIX, 'Thêm danh mục bộ sưu tập mới thành công.'));
			}
		}
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('bst_category', NULL, 'category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/bst/addcategory';
		$this->load->view('backend/layouts/home', $data);
	}

	public function editcategory($id = 0){
		$id = (int)$id;
		$category = $this->db->select('title,image, icon_img, parentid, description, desc, publish, level, meta_title, meta_keyword, meta_description')->where(array('id' => $id))->from('bst_category')->get()->row_array();
		if(!isset($category) || count($category) == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/bst/category'.CMS_SUFFIX, 'Danh mục bộ sưu tập không tồn tại.'));
		if($category['level'] == 0) die($this->lib_common->js_redirect(CMS_BACKEND.'/bst/category'.CMS_SUFFIX, 'Không sửa được danh mục này.'));
		$data['meta_title'] = 'Thay đổi thông tin danh mục bộ sưu tập';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		if($this->input->post('add')){
			$post_data = $this->input->post('data');
			$post_data = $this->lib_post->allows($post_data, array('title', 'image' , 'icon_img', 'parentid', 'description', 'desc', 'publish', 'meta_title', 'meta_keyword', 'meta_description'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required');
			$this->form_validation->set_rules('data[parentid]', 'Node cha', 'trim|required|is_natural_no_zero|callback__check_parentid['.$id.']');
			if($this->form_validation->run() == TRUE){
				$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_updated'] = $this->auth['id'];
				$this->db->where(array('id' => $id))->update('bst_category', $post_data);
				$this->lib_nestedset->set('bst_category');
				die($this->lib_common->js_redirect(CMS_BACKEND.'/bst/category'.CMS_SUFFIX, 'Thay đổi thông tin danh mục bộ sưu tập thành công.'));
			}
		}
		else{
			$data['data']['post_data'] = $category;
		}
		$data['data']['show_data']['parentid'] = $this->lib_nestedset->dropdown('bst_category', NULL, 'category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/bst/editcategory';
		$this->load->view('backend/layouts/home', $data);
	}

	public function category(){
		$data['meta_title'] = 'Quản lý danh mục bộ sưu tập';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';
		$this->lib_nestedset->set('bst_category');
		$data['data']['full_data'] = $this->lib_nestedset->data('bst_category');
		$data['menu_active'] = $this->menu_active;
		$data['template'] = 'backend/bst/category';
		$this->load->view('backend/layouts/home', $data);
	}

	public function _check_parentid($parentid, $catid){
		$parentid = (int)$parentid;
		$catid = (int)$catid;
		return $this->lib_nestedset->check_parentid('bst_category', $parentid, $catid);
	}

}