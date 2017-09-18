<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bst extends MY_Controller{
	
	public function category($parentid = 0, $page = 1){
		$parentid = (int)$parentid;
		$page = (int)$page;
		$category = $this->db->from('bst_category')->where(array('id' => $parentid, 'publish' => 1))->get()->row_array();
		if(!isset($category) || count($category) == 0) die($this->lib_common->php_redirect(''));
		$config['use_page_numbers'] = TRUE;
		if($category['rgt'] - $category['lft'] > 1){
			$children = $this->lib_nestedset->children('bst_category', array('lft >=' => $category['lft'], 'rgt <=' => $category['rgt']));
			$config['total_rows'] = $this->db->from('bst_item')->where(array('publish' => 1))->where_in('parentid', $children)->count_all_results();
		}
		else{
			$config['total_rows'] = $this->db->from('bst_item')->where(array('parentid' => $parentid, 'publish' => 1))->count_all_results();
		}
		$alias = $this->lib_string->alias($category['title']);
		$config['base_url'] = $alias.'-cb'.$category['id'].'-';
		$config['per_page'] = 15;
		$total = ceil($config['total_rows']/$config['per_page']);
		$page = ($page <= 0)?1:$page;
		$page = ($page >= $total)?$total:$page;
		$config['cms_cur_page'] = $page;
		if($total > 0){
			$page = $page - 1;
			$this->pagination->initialize($config);
			if($category['rgt'] - $category['lft'] > 1){
				$data['data']['list'] = $this->db->from('bst_item')->where(array('publish' => 1))->where_in('parentid', $children)->limit($config['per_page'], $page * $config['per_page'])->order_by('id desc')->get()->result_array();
			}
			else{
				$data['data']['list'] = $this->db->from('bst_item')->where(array('parentid' => $parentid, 'publish' => 1))->limit($config['per_page'], $page * $config['per_page'])->order_by('id desc')->get()->result_array();
			}
			$data['data']['pagination'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		$data['data']['category'] = $category;
		$data['data']['meta_title'] = (!empty($category['meta_title'])?$category['meta_title']:$category['title']).(($page > 0)?' - trang '.($page+1):'');
		$data['data']['meta_keywords'] = $category['meta_keyword'];
		$data['data']['meta_description'] = (!empty($category['meta_description'])?$category['meta_description']:$this->lib_string->cutnchar(strip_tags($category['description']), 200)).(($page > 0)?' - trang '.($page+1):'');		
		$data['data']['canonical'] = CMS_URL.(($page == 0)?$alias.'-cb'.$category['id']:$alias.'-cb'.$category['id'].'-b'.($page+1)).CMS_SUFFIX;
		$data['data']['rel_prev'] = ($page > 0)?CMS_URL.$alias.'-cb'.$category['id'].'-b'.($page).CMS_SUFFIX:'';
		$data['data']['rel_next'] = ($page < ($total - 1))?CMS_URL.$alias.'-cb'.$category['id'].'-b'.($page+2).CMS_SUFFIX:'';
		$data['data']['children'] = ($category['rgt'] - $category['lft'] > 1)?$this->db->select('id, title')->from('bst_category')->where(array('parentid' => $parentid, 'publish' => 1))->get()->result_array():NULL;
		$data['template'] = 'frontend/bst/category';
		$this->load->view('frontend/layouts/detailbst', $data);
	}
	
}