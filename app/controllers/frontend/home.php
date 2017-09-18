<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index($page = 1){
		$page = (int)$page;
		
		
		if($this->input->post('search_btn')){
			$search_data = $this->input->post('data');
			// $a = translate($search_data['search_text']);
			if($search_data['source_web'] == 1) {
				echo file_get_contents('http://ordertaobao.vn/search?page_source=1&q='.urlencode($search_data['search_text']));
				// $url = 'http://s.taobao.com/search?q='.$a.'&amp;commend=all&amp;ssid=s5-e&amp;search_type=mall&amp;sourceId=tb.index&amp;spm=1.1000386.5803581.d4908513';
				// header("Location:".$url);
			}
			if($search_data['source_web'] == 2) {
				file_get_contents('http://ordertaobao.vn/search?page_source=4&q='.urlencode($search_data['search_text']));
			}
			if($search_data['source_web'] == 3) {
				// $url = 'http://se.paipai.com/comm_search?KeyWord='.$a.'&Platform=1&charSet=gbk&sf=141&ac=0&as=1&Property=128';
				// header("Location:".$url);
			}
		}
		
		// print_r($page);die;
		$list_all = helper_module_list_item('products_item', '*', array('index' => 1,'publish' => 1), 'order asc, id desc',100000);
		$config['use_page_numbers'] = TRUE;
		
		$config['total_rows'] = count($list_all);
		$config['base_url'] = CMS_URL.'index-';
		$config['per_page'] = 30;
		$total = ceil($config['total_rows']/$config['per_page']);
		$page = ($page <= 0)?1:$page;
		$page = ($page >= $total)?$total:$page;
		$config['cms_cur_page'] = $page;
		if($total > 0){
			$page = $page - 1;
			$this->pagination->initialize($config);
			
			$data['data']['list_index'] = $this->db->from('products_item')->where(array('publish' => 1))->limit($config['per_page'], $page * $config['per_page'])->order_by('id desc')->get()->result_array();
			
			$data['data']['pagination'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		// print_r($data['data']['pagination']);die;
		
		$data['data']['meta_title'] = (!empty($this->system['meta_title'])?$this->system['meta_title']:$this->system['meta_title']).(($page > 0)?' - trang '.($page+1):'');
		$data['data']['meta_keywords'] = $this->system['meta_keywords'];
		$data['data']['meta_description'] = (!empty($this->system['meta_description'])?$this->system['meta_description']:$this->lib_string->cutnchar(strip_tags($this->system['meta_description']), 200)).(($page > 0)?' - trang '.($page+1):'');		
		$data['data']['canonical'] =(($page == 0)?CMS_URL:CMS_URL.'index-p'.($page+1).CMS_SUFFIX);
		$data['data']['rel_prev'] = ($page > 0)?CMS_URL.'index-p'.($page).CMS_SUFFIX:'';
		$data['data']['rel_next'] = ($page < ($total - 1))?CMS_URL.'index-p'.($page+2).CMS_SUFFIX:'';
		
		$data['data']['google_authorship'] = $this->system['google_authorship'];
		$data['template'] = 'frontend/home/index';
		$this->load->view('frontend/layouts/home', $data);
	}

}