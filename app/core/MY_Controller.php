<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	public $system;

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Ho_Chi_Minh');

		if(!isset($this->uri->segments[1]) || $this->uri->segments[1] != CMS_BACKEND){
			$visited = $this->session->userdata('visited');
			if(!isset($visited) || empty($visited)){
				$this->session->set_userdata('visited', 'ok');
				$this->db->set('value', 'value + 1', FALSE)->where(array('keyword' => 'visited'))->update('system');
			}
		}
		$system = $this->db->select('keyword, value')->from('system')->where(array('publish' => 1))->get()->result_array();
		if(isset($system) && count($system)){
			foreach($system as $key => $val){
				$this->system[$val['keyword']] = $val['value'];
			}
		}
		if(!isset($this->uri->segments[1]) || $this->uri->segments[1] != CMS_BACKEND){
			if($this->system['close_status'] == 1){
				die($this->system['close_content']);
			}
		}
	}
}