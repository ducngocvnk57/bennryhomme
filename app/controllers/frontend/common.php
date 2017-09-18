<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends MY_Controller {

	public $auth;

	public function __construct(){
		parent::__construct();
	}

	// Bầu chọn
	public function rating(){
		$table = $this->lib_string->decode_cookie($this->input->get('key'));
		$score = (int)$this->input->post('score'); $score = ($score <= 0)?1:$score; $score = ($score >= 5)?5:$score;
		$item = (int)trim(str_replace('id-', '', $this->input->post('item')));
		$rating_item = $this->session->userdata('rating_item'.$table.'_'.$item);
		if(!isset($rating_item) || empty($rating_item)){
			$this->session->set_userdata('rating_item'.$table.'_'.$item, 'ok');
			if(isset($table['table']) && !empty($table['table'])){
				$table['table'] = trim($table['table']);
				$this->db->set('rate_value', 'rate_value + '.$score, FALSE)->set('rate_total', 'rate_total + 1', FALSE)->where(array('id' => $item))->update($table['table']);
				die('Bầu chọn thành công');
			}
		}
		die('Bạn đã bầu chọn');
	}
}