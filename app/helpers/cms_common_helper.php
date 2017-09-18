<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('common_valuepost')){
	function common_valuepost($value){
		return !empty($value)?htmlspecialchars($value):'';
	}
}
if (!function_exists('cms_common_icon_sort')){
	function cms_common_icon_sort($field = '', $sort = ''){
		if($field == $sort['field']){
			if($sort['sort'] == 'asc') return '<img src="template/backend/images/asc.png" />';
			else if($sort['sort'] == 'desc') return '<img src="template/backend/images/desc.png" />';
		}
		return '';
	}
}

if (!function_exists('cms_random_quote')){
	function cms_random_quote($parentid = 0){
		$CI =& get_instance();
		if($parentid == 0){
			$item = $CI->db->select('author, description')->from('quotes_item')->where(array('publish' => 1))->order_by('rand()')->get()->row_array();
		}
		else{
			$item = $CI->db->select('author, description')->from('quotes_item')->where(array('parentid' => $parentid,'publish' => 1))->order_by('rand()')->get()->row_array();
		}
		if(isset($item) && count($item)){
			return $item;
		}
		return NULL;
	}
}