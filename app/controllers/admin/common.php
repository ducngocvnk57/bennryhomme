<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends MY_Controller {

	public $auth;

	public function __construct(){
		parent::__construct();
		$this->auth = $this->lib_authentication->check();
		if($this->auth == NULL) die($this->lib_common->js_redirect(CMS_BACKEND.'/authentication/login'.CMS_SUFFIX));
	}

	// Tinh chỉnh đối tượng
	public function set($table = '', $field = '', $id){
		$row = $this->db->select($field)->where(array('id' => $id))->from($table)->get()->row_array();
		$value = ($row[$field] == 0)?1:0;
		$this->db->where(array('id' => $id))->update($table, array($field => $value));
		echo $value;
	}

	// Sắp xếp đối tượng
	public function order($table = ''){
		$order = $this->input->post('order');
		if(isset($order) && count($order)){
			foreach($order as $key => $val){
				$this->db->where(array('id' => $key))->update($table, array('order' => $val));
			}
		}
	}

	// Xuất bản đối tượng
	public function publish($table = ''){
		$checkbox = $this->input->post('checkbox');
		if(isset($checkbox) && count($checkbox)){
			foreach($checkbox as $key => $val){
				$this->db->where(array('id' => $val))->update($table, array('publish' => 1));
			}
		}
	}

	// Dừng xuất bản đối tượng
	public function unpublish($table = ''){
		$checkbox = $this->input->post('checkbox');
		if(isset($checkbox) && count($checkbox)){
			foreach($checkbox as $key => $val){
				$this->db->where(array('id' => $val))->update($table, array('publish' => 0));
			}
		}
	}

	// Xóa đối tượng
	public function delete($table = ''){
		$checkbox = $this->input->post('checkbox');
		if(isset($checkbox) && count($checkbox)){
			foreach($checkbox as $key => $val){
				$this->db->delete($table, array('id' => $val));
			}
		}
	}

	// Xóa đối tượng category
	public function deletecategory($table = ''){
		$checkbox = $this->input->post('checkbox');
		if(isset($checkbox) && count($checkbox)){
			$error = '';
			foreach($checkbox as $key => $val){
				$data = $this->db->select('title, lft, rgt')->from($table)->where(array('id' => $val))->get()->row_array();
				if(isset($data) && count($data)){
					$chidren = $this->db->select('id')->from($table)->where(array('lft >' => $data['lft'], 'lft <' => $data['rgt']))->get()->result_array();
					if(isset($chidren) && count($chidren)){
						$error = $error . 'Không thể xóa '.$data['title'].' vì danh mục vẫn còn node con.'."\n";
					}
					else{
						$this->db->delete($table, array('id' => $val));
						$this->db->delete(str_replace('category', 'item', $table), array('parentid' => $val));
					}
				}
			}
			echo $error;
		}
	}
}