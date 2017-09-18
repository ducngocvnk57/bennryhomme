<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Controller{
	
	public function category($parentid = 0, $page = 1){
		$parentid = (int)$parentid;
		$page = (int)$page;
		$data['parentid'] = $parentid;
		// $keyword_i = $this->input->get('keyword');
		$keyword_i = NULL;
		// $keyword = !empty($keyword_i)?explode("-", $keyword_i):'';
		$keyword = NULL;
		// print_r($keyword);die;
		$category = $this->db->from('products_category')->where(array('id' => $parentid, 'publish' => 1))->get()->row_array();
		if(!isset($category) || count($category) == 0) die($this->lib_common->php_redirect(''));
		$config['use_page_numbers'] = TRUE;
		
		
		
			$children = $this->lib_nestedset->children('products_category', array('lft >=' => $category['lft'], 'rgt <=' => $category['rgt']));
			if(!empty($keyword)) {
				$config['total_rows'] = $this->db->from('products_item')->where(array('publish' => 1, 'our_price >=' => $keyword[0] , 'our_price <=' => $keyword[1]))->where_in('parentid', $children)->count_all_results();
			}else{
				$config['total_rows'] = $this->db->from('products_item')->where(array('publish' => 1))->where_in('parentid', $children)->count_all_results();
			}
		// print_r($config['total_rows']);die;
		if($category['level'] == 2) {
			$cateid = helper_module_get_item_info('products_category', $category['parentid']);
			$alias_1 = $this->lib_string->alias($cateid['title']);
			$alias_2 = $this->lib_string->alias($category['title']);
			$alias = $alias_1.'/'.$alias_2;
		}else{
			$alias = $this->lib_string->alias($category['title']);
		}
		$config['base_url'] = $alias.'-cp'.$category['id'].'-';
		$config['per_page'] = 84;
		$total = ceil($config['total_rows']/$config['per_page']);
		$page = ($page <= 0)?1:$page;
		$page = ($page >= $total)?$total:$page;
		$config['cms_cur_page'] = $page;
		if($total > 0){
			$page = $page - 1;
			$this->pagination->initialize($config);
			if($category['rgt'] - $category['lft'] > 1){
				$data['data']['list'] = $this->db->from('products_item')->where(array('publish' => 1))->where_in('parentid', $children)->limit($config['per_page'], $page * $config['per_page'])->order_by('order desc, id asc')->get()->result_array();
			}
			else{
				if(!empty($keyword)) {
					$data['data']['list'] = $this->db->from('products_item')->where(array('parentid' => $parentid, 'publish' => 1, 'our_price >=' => $keyword[0] , 'our_price <=' => $keyword[1]))->limit($config['per_page'], $page * $config['per_page'])->order_by('order asc, id desc')->get()->result_array();
				}else{
					$data['data']['list'] = $this->db->from('products_item')->where(array('parentid' => $parentid, 'publish' => 1))->limit($config['per_page'], $page * $config['per_page'])->order_by('order desc, id desc')->get()->result_array();
				}
			}
			$data['data']['pagination'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		
		$data['post_data']['keyword'] = $keyword_i;
		$data['data']['category'] = $category;
		$data['data']['meta_title'] = (!empty($category['meta_title'])?$category['meta_title']:$category['title']).(($page > 0)?' - trang '.($page+1):'');
		$data['data']['meta_keywords'] = $category['meta_keyword'];
		$data['data']['meta_description'] = (!empty($category['meta_description'])?$category['meta_description']:$this->lib_string->cutnchar(strip_tags($category['description']), 200)).(($page > 0)?' - trang '.($page+1):'');

		if(!empty($keyword)) {
			$data['data']['canonical'] = CMS_URL.(($page == 0)?$alias.'-cp'.$category['id']:$alias.'-cp'.$category['id'].'-p'.($page+1)).CMS_SUFFIX.'?keyword='.$keyword_i;
			$data['data']['rel_prev'] = ($page > 0)?CMS_URL.$alias.'-cp'.$category['id'].'-p'.($page).CMS_SUFFIX.'?keyword='.$keyword_i:'';
			$data['data']['rel_next'] = ($page < ($total - 1))?CMS_URL.$alias.'-cp'.$category['id'].'-p'.($page+2).CMS_SUFFIX.'?keyword='.$keyword_i:'';
		}else{
			$data['data']['canonical'] = CMS_URL.(($page == 0)?$alias.'-cp'.$category['id']:$alias.'-cp'.$category['id'].'-p'.($page+1)).CMS_SUFFIX;
			$data['data']['rel_prev'] = ($page > 0)?CMS_URL.$alias.'-cp'.$category['id'].'-p'.($page).CMS_SUFFIX:'';
			$data['data']['rel_next'] = ($page < ($total - 1))?CMS_URL.$alias.'-cp'.$category['id'].'-p'.($page+2).CMS_SUFFIX:'';
		}		
		
		$data['data']['children'] = ($category['rgt'] - $category['lft'] > 1)?$this->db->select('id, title')->from('products_category')->where(array('parentid' => $parentid, 'publish' => 1))->get()->result_array():NULL;
		$data['template'] = 'frontend/products/category';
		$this->load->view('frontend/layouts/detail', $data);
	}
	
	public function thuonghieu($labelid = 0, $page = 1){
		$labelid = (int)$labelid;
		$page = (int)$page;
		$data['labelid'] = $labelid;
		$keyword_i = $this->input->get('keyword');
		$keyword = !empty($keyword_i)?explode("-", $keyword_i):'';
		// print_r($keyword);die;
		$category = $this->db->from('thuonghieu')->where(array('id' => $labelid, 'publish' => 1))->get()->row_array();
		if(!isset($category) || count($category) == 0) die($this->lib_common->php_redirect(''));
		$config['use_page_numbers'] = TRUE;
		
		
		
			if(!empty($keyword)) {
				$config['total_rows'] = $this->db->from('products_item')->where(array('publish' => 1, 'labelid' => $labelid, 'our_price >=' => $keyword[0] , 'our_price <=' => $keyword[1]))->count_all_results();
			}else{
				$config['total_rows'] = $this->db->from('products_item')->where(array('publish' => 1, 'labelid' => $labelid))->count_all_results();
			}
			
		$alias = $this->lib_string->alias($category['title']);
			
		$config['base_url'] = $alias.'-th'.$category['id'].'-';
		$config['per_page'] = 15;
		$total = ceil($config['total_rows']/$config['per_page']);
		$page = ($page <= 0)?1:$page;
		$page = ($page >= $total)?$total:$page;
		$config['cms_cur_page'] = $page;
		if($total > 0){
			$page = $page - 1;
			$this->pagination->initialize($config);
			
			$data['data']['list'] = $this->db->from('products_item')->where(array('publish' => 1, 'labelid' => $labelid))->limit($config['per_page'], $page * $config['per_page'])->order_by('id asc')->get()->result_array();
		
			$data['data']['pagination'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		
		$data['post_data']['keyword'] = $keyword_i;
		$data['data']['category'] = $category;
		$data['data']['meta_title'] = (!empty($category['meta_title'])?$category['meta_title']:$category['title']).(($page > 0)?' - trang '.($page+1):'');
		// $data['data']['meta_keywords'] = $category['meta_keyword'];
		// $data['data']['meta_description'] = (!empty($category['meta_description'])?$category['meta_description']:$this->lib_string->cutnchar(strip_tags($category['description']), 200)).(($page > 0)?' - trang '.($page+1):'');

		if(!empty($keyword)) {
			$data['data']['canonical'] = CMS_URL.(($page == 0)?$alias.'-th'.$category['id']:$alias.'-cp'.$category['id'].'-p'.($page+1)).CMS_SUFFIX.'?keyword='.$keyword_i;
			$data['data']['rel_prev'] = ($page > 0)?CMS_URL.$alias.'-th'.$category['id'].'-p'.($page).CMS_SUFFIX.'?keyword='.$keyword_i:'';
			$data['data']['rel_next'] = ($page < ($total - 1))?CMS_URL.$alias.'-th'.$category['id'].'-p'.($page+2).CMS_SUFFIX.'?keyword='.$keyword_i:'';
		}else{
			$data['data']['canonical'] = CMS_URL.(($page == 0)?$alias.'-th'.$category['id']:$alias.'-th'.$category['id'].'-p'.($page+1)).CMS_SUFFIX;
			$data['data']['rel_prev'] = ($page > 0)?CMS_URL.$alias.'-th'.$category['id'].'-p'.($page).CMS_SUFFIX:'';
			$data['data']['rel_next'] = ($page < ($total - 1))?CMS_URL.$alias.'-th'.$category['id'].'-p'.($page+2).CMS_SUFFIX:'';
		}		
		
		$data['template'] = 'frontend/products/thuonghieu';
		$this->load->view('frontend/layouts/detail', $data);
	}

	public function category_order($page = 0){
		// print_r('a');die;
		$item = $this->db->from('products_item')->where(array('publish' => 1))->order_by('id', 'desc')->limit(30)->get()->result_array();
		
		$data['data']['item'] = $item;
		$data['data']['meta_title'] = 'Sản phẩm mới nhất';
		$data['data']['meta_keywords'] = 'Sản phẩm mới nhất';
		$data['data']['meta_description'] = 'Sản phẩm mới nhất';

		$data['data']['canonical'] = CMS_URL.'san-pham-moi.html';
		
		$data['template'] = 'frontend/products/category_order';
		$this->load->view('frontend/layouts/detail', $data);
	}

	public function category_sale($page = 0){
		// print_r('a');die;
		$item = $this->db->from('products_item')->where(array('retail_price !=' => ""))->order_by('id', 'desc')->limit(30)->get()->result_array();
		
		$data['data']['item'] = $item;
		$data['data']['meta_title'] = 'Sản phẩm khuyến mãi';
		$data['data']['meta_keywords'] = 'Sản phẩm khuyến mãi';
		$data['data']['meta_description'] = 'Sản phẩm khuyến mãi';

		$data['data']['canonical'] = CMS_URL.'san-pham-khuyen-mai.html';
		
		$data['template'] = 'frontend/products/category_sale';
		$this->load->view('frontend/layouts/detail', $data);
	}

	public function item($id = 0){
		$id = (int)$id;
		$item = $this->db->from('products_item')->where(array('id' => $id, 'publish' => 1))->get()->row_array();
		$data['parentid'] = $item['parentid'];
		if(!isset($item) || count($item) == 0) die($this->lib_common->php_redirect(''));
		$category = $this->db->from('products_category')->where(array('id' => $item['parentid'], 'publish' => 1))->get()->row_array();
		if(!isset($category) || count($category) == 0) die($this->lib_common->php_redirect(''));
		$user = $this->db->select('username, fullname, author')->from('user')->where(array('id' => $item['userid_created']))->get()->row_array();	
		if(!isset($user) || count($user) == 0) die($this->lib_common->php_redirect(''));
		$view_products_item = $this->session->userdata('view_products_item_'.$item['id']);
		$item['title'] = html_entity_decode($item['title'], ENT_QUOTES, 'UTF-8');
		$item['description'] = html_entity_decode($item['description'], ENT_QUOTES, 'UTF-8');
		$item['content'] = html_entity_decode($item['content'], ENT_QUOTES, 'UTF-8');
		$alias_1 = $this->lib_string->alias($item['title']);
		$alias_2 = $this->lib_string->alias($category['title']);
		if(!isset($view_products_item) || empty($view_products_item)){
			$this->session->set_userdata('view_products_item_'.$item['id'], 'ok');
			$rand = rand(0, 5);
			$value = rand(3, 5);
			if($rand == 5){
				$this->db->set('rate_value', 'rate_value + '.$value, FALSE)->set('rate_total', 'rate_total + 1', FALSE)->where(array('id' => $id))->update('products_item');
				$item['rate_value'] = $item['rate_value'] + $value;
				$item['rate_total'] = $item['rate_total'] + 1;
			}
			$this->db->set('viewed', 'viewed + 1', FALSE)->where(array('id' => $item['id']))->update('products_item');
			$item['viewed']++;
		}
		if(!empty($item['tags'])){
			$tags = $this->lib_tags->tags($item['tags']);
			if(isset($tags) && count($tags)){
				$field = '';
				$query_param = NULL;
				$count = count($tags); 
				foreach($tags as $key => $val){
					if($count == $key+1){
						$field = $field.'`tags` LIKE ?';
					}
					else{
						$field = $field.'`tags` LIKE ? OR ';
					}
					$query_param[] = '%'.$val.'%';
				}
				$query_sql = 'SELECT * FROM '.CMS_PREFIX.'products_item WHERE ('.$field.') AND `id` != '.$item['id'].' LIMIT 0, 10';
				$data['data']['related'] = $this->db->query($query_sql, $query_param)->result_array();
			}
		}
		$data['data']['item'] = $item;
		$data['data']['category'] = $category;
		$data['data']['meta_title'] = (!empty($item['meta_title'])?$item['meta_title']:$item['title']);
		$data['data']['meta_keywords'] = $item['meta_keyword'];
		$data['data']['meta_description'] = (!empty($item['meta_description'])?$item['meta_description']:$this->lib_string->cutnchar(strip_tags($item['description']), 200));		
		$data['data']['image'] = $item['image'];
		$alias = !empty($item['url_config'])?$alias_2.'/'.$item['url_config']:$alias_2.'/'.$alias_1;
		$data['data']['canonical'] = CMS_URL.$alias.'-ap'.$item['id'].CMS_SUFFIX;
		$fullurl = current(explode('?', $this->lib_string->fullurl()));
		if($fullurl != $data['data']['canonical']) $this->lib_string->php_redirect($data['data']['canonical']);
		// print_r($fullurl);die;
		$data['data']['children'] = ($category['rgt'] - $category['lft'] > 1)?$this->db->select('id, title')->from('products_category')->where(array('parentid' => $category['id'], 'publish' => 1))->get()->result_array():NULL;
		$data['data']['same'] = $this->db->select('*')->from('products_item')->where(array('id !=' => $item['id'], 'parentid' => $category['id'], 'publish' => 1))->limit(10, 0)->order_by('id desc')->get()->result_array();
		$data['data']['user'] = $user;
		$data['data']['google_authorship'] = $user['author'];
		$data['template'] = 'frontend/products/item';
		$this->load->view('frontend/layouts/detail', $data);
	}

	

	public function search(){
		$q = $this->input->get('q'); $page = isset($q)?trim(urldecode($q)):NULL;
		$page = $this->input->get('page'); $page = isset($page)?(int)$page:0;
		// Đẩy từ khóa ra ngoài
		$data['data']['q'] = $q;
		
		$config['use_page_numbers'] = TRUE;
		$sql = 'SELECT `id` FROM `'.CMS_PREFIX.'products_item` WHERE `publish` = 1 AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?)';
		$config['total_rows'] = $this->db->query($sql, array('%'.$q.'%', '%'.$q.'%', '%'.$q.'%'))->num_rows();
		$config['base_url'] = CMS_URL.'tim-kiem-san-pham'.CMS_SUFFIX.'?q='.urlencode($q).'&';		
		$config['per_page'] = 229; // Bài viết trên 1 trang
		$config['num_links'] = 2;
		$total = ceil($config['total_rows']/$config['per_page']); // Tổng số trang theo bài viết
		$page = ($page <= 0)?1:$page; $page = ($page >= $total)?$total:$page; // Kiểm tra giới hạn
		$config['itq_cur_page'] = $page;
		if($config['total_rows'] > 0){
			$page = $page - 1;
			$this->pagination->initialize($config);
			$sql = 'SELECT * FROM `'.CMS_PREFIX.'products_item` WHERE `publish` = 1 AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?) ORDER BY `id` DESC LIMIT '.$page * $config['per_page'].', '.$config['per_page'].'';
			$data['data']['full_data'] = $this->db->query($sql, array('%'.$q.'%', '%'.$q.'%', '%'.$q.'%'))->result_array();
			$data['data']['full_page'] = $this->pagination->create_links();
		} else{
			$data['data']['full_data'] = NULL;
			$data['data']['full_page'] = NULL;
		}
		$data['data']['total_rows'] = $config['total_rows'];
		$data['data']['menu_active'] = array('module' => 'products', 'id' => 2);
		// Seo
		$data['title'] = $q;
		$data['keywords'] = $q;
		$data['description'] = $q;
		$data['image'] = '';
		$data['data']['canonical'] = CMS_URL.'tim-kiem-san-pham'.CMS_SUFFIX.'?q='.urlencode($q).(($page > 0)?'&page='.$page:'');
	
		// Giao diện
		$data['template'] = 'frontend/products/search';
		$this->load->view('frontend/layouts/detail', $data);
	}

	public function search_high(){
		// Biến ban đầu
		$parentid = $this->input->get('parentid');
		$order_by = $this->input->get('order_by');
		
		$title = helper_module_get_category_info('products_category', $parentid);
		// print_r($title);die;
		
		if($order_by == 1) {
			$order_by = 'id asc';
			$list = helper_module_list_item('products_item','id, title, image, price, retail_price, our_price',array('parentid' => $parentid), $order_by , 100, TRUE);
			// Seo
			$data['data']['meta_title'] = $title['title'].' mới nhất';
			$data['data']['meta_keywords'] = $title['title'].' mới nhất';
			$data['data']['meta_description'] = $title['title'].' mới nhất';
		}
		if($order_by == 2) {
			$order_by = 'viewed desc';
			$list = helper_module_list_item('products_item','id, title, image, price, retail_price, our_price',array('parentid' => $parentid), $order_by , 100, TRUE);
			// Seo
			$data['data']['meta_title'] = $title['title'].' được xem nhiều nhất';
			$data['data']['meta_keywords'] = $title['title'].' được xem nhiều nhất';
			$data['data']['meta_description'] = $title['title'].' được xem nhiều nhất';
		}
		if($order_by == 3) {
			$order_by = 'id asc';
			$list = helper_module_list_item('products_item','id, title, image, price, retail_price, our_price',array('parentid' => $parentid), $order_by , 100, TRUE);
			// Seo
			$data['data']['meta_title'] = $title['title'].' phổ biến nhất';
			$data['data']['meta_keywords'] = $title['title'].' phổ biến nhất';
			$data['data']['meta_description'] = $title['title'].' phổ biến nhất';
		}
		$data['data']['left_right'] = 1;
		$data['data']['list'] = $list;
		$data['data']['canonical'] = CMS_URL.'sap-xep-san-pham'.CMS_SUFFIX.'?order_by='.$order_by.'&parentid'.$parentid;
		
		// Giao diện
		$data['template'] = 'frontend/products/search-high';
		$this->load->view('frontend/layouts/detail', $data);
	}


	public function tags_detail($page = 1){
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->db->from('tags')->where(array('publish' => 1))->count_all_results();
		$config['base_url'] = 'chu-de-';
		$config['per_page'] = 68;
		$total = ceil($config['total_rows']/$config['per_page']);
		$page = ($page <= 0)?1:$page;
		$page = ($page >= $total)?$total:$page;
		$config['cms_cur_page'] = $page;
		if($total > 0){
			$page = $page - 1;
			$this->pagination->initialize($config);
			$data['data']['list'] = $this->db->from('tags')->where(array('publish' => 1))->limit($config['per_page'], $page * $config['per_page'])->order_by('id asc')->get()->result_array();
			$data['data']['pagination'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		$data['data']['meta_title'] = 'Danh sách các chủ đề đang có tại website '.$this->system['name'].(($page > 0)?' - trang '.($page+1):'');
		$data['data']['meta_keywords'] = $this->system['meta_keywords'];
		$data['data']['meta_description'] = 'Danh sách các chủ đề đang có tại website '.$this->system['name'].', hiện website đang có '.$config['total_rows'].' chủ đề'.(($page > 0)?' - trang '.($page+1):'');
		$data['data']['canonical'] = CMS_URL.(($page == 0)?'chu-de':'chu-de-p'.($page+1)).CMS_SUFFIX;
		$data['data']['rel_prev'] = ($page > 0)?CMS_URL.'chu-de-p'.($page).CMS_SUFFIX:'';
		$data['data']['rel_next'] = ($page < ($total - 1))?CMS_URL.'chu-de-p'.($page+2).CMS_SUFFIX:'';
		$data['template'] = 'frontend/products/tags_detail';
		$this->load->view('frontend/layouts/detail', $data);
	}


	public function tags($alias = '', $page = 1){
		$alias = preg_replace('/[^a-z0-9-]+/i', '', $alias);
		$page = (int)$page;
		$tag = $this->db->from('tags')->where(array('alias' => $alias, 'publish' => 1))->get()->row_array();
		if(!isset($tag) || count($tag) == 0) die($this->lib_common->php_redirect(''));
		$config['use_page_numbers'] = TRUE;
		$query_sql = 'SELECT * FROM '.CMS_PREFIX.'products_item WHERE (`tags` LIKE ?)';
		$query_param = array('%'.$tag['title'].'%');
		$config['total_rows'] = $this->db->query($query_sql, $query_param)->num_rows();
		$config['base_url'] = 'tags/'.$alias.'-';
		$config['per_page'] = 10;
		$total = ceil($config['total_rows']/$config['per_page']);
		$page = ($page <= 0)?1:$page;
		$page = ($page >= $total)?$total:$page;
		$config['cms_cur_page'] = $page;
		if($total > 0){
			$page = $page - 1;
			$this->pagination->initialize($config);
			$query_sql = 'SELECT * FROM '.CMS_PREFIX.'products_item WHERE (`tags` LIKE ?) AND `publish` = 1 ORDER BY `id` DESC LIMIT '.($page * $config['per_page']).', '.$config['per_page'];
			$query_param = array('%'.$tag['title'].'%');
			$data['data']['list'] = $this->db->query($query_sql, $query_param)->result_array();
		// print_r($data['data']['list']);die;
			$data['data']['pagination'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		$data['data']['tag'] = $tag;
		$data['data']['meta_title'] = (!empty($tag['meta_title'])?$tag['meta_title']:mb_convert_case($tag['title'], MB_CASE_TITLE, 'UTF-8').' | Tags sản phẩm').(($page > 0)?' - trang '.($page+1):'');
		$data['data']['meta_keywords'] = !empty($tag['meta_keyword'])?$tag['meta_keyword']:$tag['title'];
		$data['data']['meta_description'] = (!empty($tag['meta_description'])?$tag['meta_description']:'Tổng hợp sản phẩm thuộc chủ đề '.$tag['title'].', những sản phẩm hay về chủ đề '.$tag['title'].' dành cho bạn.').(($page > 0)?' - trang '.($page+1):'');
		$data['data']['canonical'] = CMS_URL.(($page == 0)?'tags/'.$alias:'tags/'.$alias.'-p'.($page+1)).CMS_SUFFIX;
		$data['data']['rel_prev'] = ($page > 0)?CMS_URL.'tags/'.$alias.'-p'.($page).CMS_SUFFIX:'';
		$data['data']['rel_next'] = ($page < ($total - 1))?CMS_URL.'tags/'.$alias.'-p'.($page+2).CMS_SUFFIX:'';
		$data['template'] = 'frontend/products/tags';
		$this->load->view('frontend/layouts/detail', $data);
	}
	
	
	public function addtocart($itemid = NULL){
		$itemid = (int)$itemid;
		$products_item = $this->db->from('products_item')->where(array('id' => $itemid))->get()->row_array();
		$size_van = $this->input->post('data');
		
		$size_van = $size_van?$size_van:0; 
		if(!isset($products_item)){
			$this->session->set_flashdata('message_error_flash', 'Dữ liệu không tồn tại.');
			header('Location: '.base64_decode($this->input->get('redirect')));
			die;
		}
		if(!empty($products_item['price'])) {
			$item = array(
				'id' => $products_item['id'],
				'image' => $products_item['image'],
				'title' => $products_item['title'],
				'price' => $products_item['price'],
				'number' => 1,
				'size' => $size_van['size'],
				'color' => $size_van['color'],
			);
		}else{
			$item = array(
				'id' => $products_item['id'],
				'title' => $products_item['title'],
				'image' => $products_item['image'],
				'price' => $products_item['our_price'],
				'number' => 1,
				'size' => $size_van['size'],
				'color' => $size_van['color'],
			);
		}
		if(!isset($_COOKIE['itq_cookie_cart_'.CMS_CODE])){
			$cart = array();
			$cart[] = $item;
			setcookie('itq_cookie_cart_'.CMS_CODE, json_encode($cart), time()+(7*24*3600), '/');
			die($this->lib_common->js_redirect('gio-hang.html'));
		}
		else{
			$cart = json_decode($_COOKIE['itq_cookie_cart_'.CMS_CODE], true);
			if(isset($cart)){
				foreach($cart as $key => $val){	
					if(($val['id'] == $item['id']) && ($val['size'] == $item['size']) && ($val['color'] == $item['color'])){
						$cart[$key]['number'] = $cart[$key]['number'] + 1;
						setcookie('itq_cookie_cart_'.CMS_CODE, json_encode($cart), time()+(7*24*3600), '/');
						die($this->lib_common->js_redirect('gio-hang.html'));
						// die($this->lib_common->js_redirect('gio-hang.html' , 'Cập nhật số lượng sản phẩm '.$products_item['title'].' thành công. Số lượng hiện tại là: '.$cart[$key]['number']));
					}
				}
				$cart[] = $item;
				setcookie('itq_cookie_cart_'.CMS_CODE, json_encode($cart), time()+(7*24*3600), '/');
				die($this->lib_common->js_redirect('gio-hang.html'));
				// die($this->lib_common->js_redirect('gio-hang.html' , 'Thêm sản phẩm '.$products_item['title'].' thành công.'));
			}
		}
	}
	
	public function cart(){
		$data['data']['menu_active'] = NULL;
		$data['data']['full_data'] = NULL;
		if(isset($_COOKIE['itq_cookie_cart_'.CMS_CODE])){
			$cart = json_decode($_COOKIE['itq_cookie_cart_'.CMS_CODE], true);
			if($this->input->post('btnNumber')){
			
				$number = $this->input->post('number');
				if(isset($number) && isset($cart)){
					foreach($number as $keyNumber => $valNumber){
						foreach($cart as $keyCart => $valCart){
							$valCart['id'] = $valCart['id'].$valCart['size'];
							if($keyNumber == $valCart['id']){
								$cart[$keyCart]['number'] = preg_replace('/[^0-9]+/i', '', $valNumber);
							}
						}
					}
					setcookie('itq_cookie_cart_'.CMS_CODE, json_encode($cart), time()+(7*24*3600), '/');
					$this->session->set_flashdata('message_successful_flash', 'Cập nhật số lượng thành công.');
					header('Location: '.CMS_URL.'frontend/products/cart'.CMS_SUFFIX);
					die;
				}
			}
			$data['data']['full_data'] = $cart;
		}
		else{
			die('<script type="text/javascript">alert(\'Chưa có sản phẩm trong giỏ hàng của bạn!\');location.href=\''.CMS_URL.'\';</script>');
		}
		
		$data['data']['canonical'] = CMS_URL.'-cart'.CMS_SUFFIX;
		$data['data']['meta_title'] = 'Giỏ hàng của bạn';
		$data['data']['meta_keywords'] = 'Giỏ hàng của bạn';
		$data['data']['meta_description'] = 'Giỏ hàng của bạn';
		
		// Giao diện
		$data['template'] = 'frontend/products/cart';
		$this->load->view('frontend/layouts/detail', $data);
	}
	public function payment(){
		$user_creatid = NULL;
		$user_creatid = $this->lib_authentication->check_customer();
		
		$user_info = $user_creatid['id']?$user_creatid['id']:0;
		
		$data['data']['menu_active'] = NULL;
		$data['data']['full_data'] = NULL;
		if(isset($_COOKIE['itq_cookie_cart_'.CMS_CODE])){
			$cart = json_decode($_COOKIE['itq_cookie_cart_'.CMS_CODE], true);
			$data['data']['full_data'] = $cart;
			if($this->input->post('submit')){
				$data['data']['post_data'] = $this->input->post('data');
				// print_r($data['data']['post_data']);die;
				$this->form_validation->set_rules('data[fullname]', 'Tiêu đề', 'trim|required');
				$this->form_validation->set_rules('data[phone]', 'Điện thoại', 'trim|required');
				$this->form_validation->set_rules('data[email]', 'Email', 'trim|required');
				$this->form_validation->set_rules('data[address]', 'Địa chỉ', 'trim|required');
				if($this->form_validation->run() == TRUE){
					$data['data']['post_data']['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
					$data['data']['post_data']['user_creatid'] = $user_info;
					$data['data']['post_data']['data'] = $_COOKIE['itq_cookie_cart_'.CMS_CODE];
					$this->db->insert('payment', $data['data']['post_data']);
					setcookie('itq_cookie_cart_'.CMS_CODE, json_encode($cart), time()-(7*24*3600), '/');
					die('<script type="text/javascript">alert(\'Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn được cập nhật thành công. Nếu bạn chọn thanh toán chuyển khoản vui lòng tiến hành thanh toán theo các tài khoản dưới đây. Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất. Xin cảm ơn.!\');location.href=\'http://thoitrangalo.vn/thanh-toan-c29.html\';</script>');
				}
			}
		}
		else{
			die('<script type="text/javascript">alert(\'Chưa có sản phẩm trong giỏ hàng của bạn!\');location.href=\''.CMS_URL.'\';</script>');
		}
		// Giao diện
		$data['data']['canonical'] = CMS_URL.'-payment'.CMS_SUFFIX;
		$data['template'] = 'frontend/products/payment';
		$this->load->view('frontend/layouts/detail', $data);
	}
	
	public function removetocart($itemid = 0){
		$itemid = (int)$itemid;
		$products_item = $this->db->from('products_item')->where(array('id' => $itemid))->get()->row_array();
		if(!isset($products_item)){
			$this->session->set_flashdata('message_error_flash', 'Dữ liệu không tồn tại.');
			header('Location: '.base64_decode($this->input->get('redirect')));
			die;
		}
	
	
		if(!isset($_COOKIE['itq_cookie_cart_'.CMS_CODE])){
			$this->session->set_flashdata('message_error_flash', 'Không có sản phẩm trong giỏ hàng.');
			header('Location: '.base64_decode($this->input->get('redirect')));
			die;
		}
		else{
			$cart = json_decode($_COOKIE['itq_cookie_cart_'.CMS_CODE], true);
			if(isset($cart)){
				foreach($cart as $key => $val){	
					if($val['id'] == $itemid){
						unset($cart[$key]);
						$cart = array_values($cart);
						setcookie('itq_cookie_cart_'.CMS_CODE, json_encode($cart), time()+(7*24*3600), '/');
						$this->session->set_flashdata('message_successful_flash', 'Xóa sản phẩm khỏi giỏ hàng thành công.');
						header('Location: '.base64_decode($this->input->get('redirect')));
						die;
					}
				}
			}
		}
	}
}