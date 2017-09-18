<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class articles_post extends MY_Controller{

	public $auth;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check_customer();
		if(!$this->auth){
			die('<meta charset=utf-8" /><script type="text/javascript">location.href=\''.CMS_URL.'\';</script>');
			$data['template'] = 'frontend/articles_post/form-item';
		}
	}
	
	public function additem(){
		if($this->input->post('submit')){
			$post_data = $this->input->post('data');
			$username_creat = helper_module_get_user_info('user_customer',$this->auth['id']);
			$post_data['username_creat'] = $username_creat['user'];
			$post_data = $this->lib_post->allows($post_data, array('address_received','phone_received','shop_received','email_received','description','commodity_type','send_date','value_send_date','username_creat'));
			$data['data']['post_data'] = $post_data;
			$this->form_validation->set_rules('data[address_received]', 'Địa chỉ nhận hàng', 'trim|required');
			$this->form_validation->set_rules('data[phone_received]', 'Số điện thoại người nhận', 'trim|required');
			$this->form_validation->set_rules('data[shop_received]', 'Tên cửa hàng nhận', 'trim|required');
			$this->form_validation->set_rules('data[commodity_type]', 'Loại hàng hóa', 'trim|required');
			$this->form_validation->set_rules('data[send_date]', 'Captcha', 'trim|required|callback__check_date');
			$this->form_validation->set_rules('txtCaptcha', 'Captcha', 'trim|required|callback__check_captcha');
			$this->form_validation->set_error_delimiters('<p class="error-item">', '</p>');
			
			if($this->form_validation->run() == TRUE){
				$post_data['value_send_date'] = strtotime($post_data['send_date']);
				$post_data['send_date'] = gmdate('Y-m-d H:i:s', strtotime($post_data['send_date']) + 7*3600);
				$post_data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_created'] = $this->auth['id'];
				$this->db->insert('affairs_item', $post_data);
				die($this->lib_common->js_redirect('danh-sach-yeu-cau-da-gui.html', 'Gửi yêu cầu thành công.'));
			}
		}
		
		$data['data']['meta_title'] = 'Gửi yêu cầu';
		$data['data']['meta_keywords'] = 'Gửi yêu cầu mới';
		$data['data']['meta_description'] = 'Gửi yêu cầu mới';	
		$data['data']['canonical'] = CMS_URL.'gui-yeu-cau.html';
		$data['template'] = 'frontend/articles_post/form-item';
		$this->load->view('frontend/layouts/home', $data);
	}
	
	
	public function edititem($id = 0){
		$auth = $this->auth;
		$id = (int)$id;
		$item = $this->db->select('id, address_received, phone_received, shop_received, description, commodity_type, send_date, email_received, value_send_date, username_creat')->where(array('id' => $id, 'userid_created' => $auth['id']))->from('affairs_item')->get()->row_array();
		if(!$item) die('<meta charset=utf-8" /><script type="text/javascript">alert("Yêu cầu này không tồn tại.");location.href="danh-sach-yeu-cau-da-gui.html";</script>');
		if($this->input->post('submit')){
			$post_data = $this->input->post('data');
			$username_creat = helper_module_get_user_info('user_customer',$this->auth['id']);
			$post_data['username_creat'] = $username_creat['user'];
			$post_data = $this->lib_post->allows($post_data, array('address_received','phone_received','shop_received','description','commodity_type','send_date','email_received','value_send_date','username_creat'));
			$data['data']['post_data'] = $post_data;
			
			$this->form_validation->set_rules('data[address_received]', 'Địa chỉ nhận hàng', 'trim|required');
			$this->form_validation->set_rules('data[phone_received]', 'Số điện thoại người nhận', 'trim|required');
			$this->form_validation->set_rules('data[shop_received]', 'Tên cửa hàng nhận', 'trim|required');
			$this->form_validation->set_rules('data[commodity_type]', 'Loại hàng hóa', 'trim|required');
			$this->form_validation->set_rules('data[send_date]', 'Captcha', 'trim|required|callback__check_date');
			$this->form_validation->set_rules('txtCaptcha', 'Captcha', 'trim|required|callback__check_captcha');
			$this->form_validation->set_error_delimiters('<p class="error-item">', '</p>');
			
			if($this->form_validation->run() == TRUE){
				$post_data['value_send_date'] = strtotime($post_data['send_date']);
				// print_r($post_data['value_send_date']);die;
				$post_data['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$post_data['userid_updated'] = $this->auth['id'];
				$this->db->where(array('id' => $id))->update('affairs_item', $post_data);
				die($this->lib_common->js_redirect('danh-sach-yeu-cau-da-gui.html', 'Sửa yêu cầu thành công.'));
			}
		} else{
			$data['data']['post_data'] = $item;
		}
		
		$data['data']['meta_title'] = 'Sửa yêu cầu';
		$data['data']['meta_keywords'] = 'Sửa yêu cầu';
		$data['data']['meta_description'] = 'Sửa yêu cầu';	
		$data['data']['canonical'] = CMS_URL.'sua-yeu-cau.html';
		$data['template'] = 'frontend/articles_post/form-item';
		$this->load->view('frontend/layouts/home', $data);
	}
	
	public function viewpayment($id = 0){
		$auth = $this->auth;
		$id = (int)$id;
		$item = $this->db->select('*')->where(array('id' => $id, 'userid_created' => $auth['id']))->from('affairs_item')->get()->row_array();
		if(!$item) die('<meta charset=utf-8" /><script type="text/javascript">alert("Yêu cầu này không tồn tại.");location.href="danh-sach-yeu-cau-da-gui.html";</script>');
		if(empty($item['code_send'])) die('<meta charset=utf-8" /><script type="text/javascript">alert("Yêu cầu này không tồn tại.");location.href="danh-sach-yeu-cau-da-gui.html";</script>');
		$data['data']['full_data'] = $item;
		$data['data']['meta_title'] = 'Xem đơn hàng';
		$data['data']['meta_keywords'] = 'Xem đơn hàng';
		$data['data']['meta_description'] = 'Xem đơn hàng';	
		$data['data']['canonical'] = CMS_URL.'xem-don-hang.html';
		$data['template'] = 'frontend/articles_post/viewpayment';
		$this->load->view('frontend/layouts/home', $data);
	}

	public function delitem($id = 0){
		$id = (int)$id;
		$item = $this->db->select('id')->where(array('id' => $id))->from('affairs_item')->get()->row_array();
		if(!$item) die('<meta charset=utf-8" /><script type="text/javascript">alert("Yêu cầu này không tồn tại.");location.href="danh-sach-yeu-cau-da-gui.html";</script>');
		$this->db->delete('affairs_item', array('id' => $id));
		
		die($this->lib_common->js_redirect('danh-sach-yeu-cau-da-gui.html', 'Xóa yêu cầu thành công.'));
	}

	public function item(){
		
		$auth = $this->auth;
		$page = $this->input->get('page'); $page = isset($page)?(int)$page:0;
		$parentid = $this->input->get('parentid'); $parentid = isset($parentid)?(int)$parentid:0;
		$keyword = $this->input->get('keyword');
		
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->db->from('affairs_item')->where(array('userid_created' => $auth['id']))->count_all_results();
		$config['base_url'] = CMS_URL.'danh-sach-yeu-cau-da-gui'.CMS_SUFFIX.'?';
		
		$config['per_page'] = 100;
		$total = ceil($config['total_rows']/$config['per_page']);
		$page = ($page <= 0)?1:$page;
		$page = ($page >= $total)?$total:$page;
		$config['cms_cur_page'] = $page;
		
		if($parentid > 0 && empty($keyword)){
			$config['total_rows'] = $this->db->from('affairs_item')->where(array('parentid' => $parentid, 'userid_created' => $auth['id']))->count_all_results();
			$config['base_url'] = CMS_URL.'danh-sach-yeu-cau-da-gui'.CMS_SUFFIX.'?parentid='.$parentid.'&';
		} else if($parentid == 0 && !empty($keyword)){
			$query_sql = 'SELECT * FROM '.CMS_PREFIX.'affairs_item WHERE `userid_created` = ? AND (`code_send` LIKE ?)';
			$query_param = array($auth['id'], '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($query_sql, $query_param)->num_rows();
			$config['base_url'] = CMS_URL.'danh-sach-yeu-cau-da-gui'.CMS_SUFFIX.'?keyword='.urlencode($keyword).'&';
		} else if($parentid > 0 && !empty($keyword)){
			$query_sql = 'SELECT * FROM '.CMS_PREFIX.'affairs_item WHERE `userid_created` = ? AND `parentid` = ? AND (`code_send` LIKE ?)';
			$query_param = array($auth['id'], $parentid, '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($query_sql, $query_param)->num_rows();
			$config['base_url'] = CMS_URL.'danh-sach-yeu-cau-da-gui'.CMS_SUFFIX.'?keyword='.urlencode($keyword).'&';
		} else{
			$config['total_rows'] = $this->db->from('affairs_item')->where(array('userid_created' => $auth['id']))->count_all_results();
			$config['base_url'] = CMS_URL.'danh-sach-yeu-cau-da-gui'.CMS_SUFFIX.'?';
		}
		
		if($total > 0){
			$page = $page - 1;
			$this->pagination->initialize($config);
			if($parentid > 0 && empty($keyword)){
				$data['data']['full_data'] = $this->db->from('affairs_item')->where(array('parentid' => $parentid, 'userid_created' => $auth['id']))->limit($config['per_page'], $page * $config['per_page'])->order_by('id desc')->get()->result_array();
			} else if($parentid == 0 && !empty($keyword)){
				$query_sql = 'SELECT * FROM '.CMS_PREFIX.'affairs_item WHERE `userid_created` = ? AND (`code_send` LIKE ?) LIMIT '.($page * $config['per_page']).', '.$config['per_page'];
				$query_param = array($auth['id'], '%'.$keyword.'%');
				$data['data']['full_data'] = $this->db->query($query_sql, $query_param)->result_array();
			} else if($parentid > 0 && !empty($keyword)){
				$query_sql = 'SELECT * FROM '.CMS_PREFIX.'affairs_item WHERE `userid_created` = ? `parentid` = ? AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?) LIMIT '.($page * $config['per_page']).', '.$config['per_page'];
				$query_param = array($auth['id'], $parentid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
				$data['data']['full_data'] = $this->db->query($query_sql, $query_param)->result_array();
			} else{
				$data['data']['full_data'] = $this->db->from('affairs_item')->where(array('userid_created' => $auth['id']))->limit($config['per_page'], $page * $config['per_page'])->order_by('id desc')->get()->result_array();
			}
			
			$data['data']['pagination'] = $this->pagination->create_links();
			$data['data']['total_rows'] = $config['total_rows'];
			$data['data']['per_page'] = $config['per_page'];
			$data['data']['page'] = $page;
		}
		$data['meta_title'] = 'Quản lý yêu cầu';
		$data['meta_keywords'] = 'Quản lý yêu cầu';
		$data['meta_description'] = 'Quản lý yêu cầu';
		
		$data['template'] = 'frontend/articles_post/list';
		$this->load->view('frontend/layouts/home', $data);
	}
	
	public function _check_date($date = ''){
		$in_date = gmdate('Y-m-d H:i:s', time() + 7*3600);
		$in_date = strtotime($in_date);
		$date = strtotime($date);
		if($date <= $in_date){
			$this->form_validation->set_message('_check_date', 'Ngày gửi phải lớn hơn ngày hiện tại.');
			return FALSE;
		}
		return TRUE;
	}
	
	public function _check_captcha($captcha = NULL){
		$captcha_result = $this->session->userdata('captcha_result');
		if(isset($captcha_result) && !empty($captcha_result)){
			if($captcha != $captcha_result['captcha_result_value']){
				$this->form_validation->set_message('_check_captcha', 'Mã Capcha không đúng.');
				return FALSE;
			}
		}
		else{
			$this->form_validation->set_message('_check_captcha', 'Mã Capcha không tồn tại.');
			return FALSE;
		}
		return TRUE;
	}

}