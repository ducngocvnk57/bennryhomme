<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('helper_module_get_category_info')){
	function helper_module_get_category_info($table = '', $id = 0){
		$CI =& get_instance();
		$user = $CI->db->select('id, title, parentid')->where(array('id' => $id))->from($table)->get()->row_array();
		if(isset($user) && count($user)){
			return $user;
		}
		else{
			return NULL;
		}
	}
}
if (!function_exists('helper_module_get_item_info')){
	function helper_module_get_item_info($table = '', $id = 0){
		$CI =& get_instance();
		$user = $CI->db->select('*')->where(array('id' => $id))->from($table)->get()->row_array();
		if(isset($user) && count($user)){
			return $user;
		}
		else{
			return NULL;
		}
	}
}
if (!function_exists('helper_module_get_parentid')){
	function helper_module_get_parentid($table = '', $id = 0){
		$CI =& get_instance();
		$user = $CI->db->select('parentid')->where(array('parentid' => $id))->from($table)->get()->row_array();
		if(isset($user) && count($user)){
			return $user;
		}
		else{
			return NULL;
		}
	}
}

if(!function_exists('isZero')){
	function isZero($s) {
		return !(int)$s;
	}
}
if(!function_exists('beforeIsZero')){
	function beforeIsZero($i,$part) {
		for ($x = $i-1; $x >= 0; $x--) {
			if (!isZero($part[$x])) {
				return false;
			}
		}
		return true;
	}
}
if(!function_exists('readNumber')){
	function readNumber($number) {
		$number = (string)$number;
		$numberLang = array('không', 'một', 'hai', 'ba', 'bốn', 'năm', 'sáu', 'bảy', 'tám', 'chín');
		$numberVL = array('tỉ','triệu','nghìn','');
		if ($number == 0) {
			return $numberLang[0];
		}
		$len = 12;
		$numberStr = sprintf('%0'.$len.'d',$number);
		$part = array(
			substr($numberStr,0,3), // tỉ
			substr($numberStr,3,3), // nghìn
			substr($numberStr,6,3), // trăm
			substr($numberStr,9,3), // đơn vị
		);
		$read = array();
		for ($i=0; $i<4; $i++) {
			if (isZero($part[$i])) continue;
			$subNum = $part[$i];
			for ($j=0; $j<3; $j++) {
				switch ($j) {
					case 0:
						if (!isZero($subNum[0]) || !beforeIsZero($i,$part)) {
							$read[] = $numberLang[$subNum[0]];
							$read[] = 'trăm';
						}
						break;
					case 1:
						if (isZero($subNum[1])) {
							if (!beforeIsZero($i,$part) || !isZero($subNum[0])) {
								if (!isZero($subNum[2])) {
									$read[] = 'lẻ';
								}
							}
							else {
								break;
							}
						}
						else {
							if ($subNum[1] == 1) {
								$read[] = 'mười';
							}
							else {
								$read[] = $numberLang[$subNum[1]];
								$read[] = 'mươi';
							}
						}
						break;
					case 2:
						if ($subNum[1] > 1 && $subNum[2] == 1) {
							$read[] = 'mốt';
							break;
						}
						elseif (!isZero($subNum[1]) && $subNum[2] == 5) {
							$read[] = 'lăm';
						}
						
						elseif ((!isZero($subNum[0]) || !isZero($subNum[1])) && $subNum[2] == 0) {
							$read[] = '';
						}
						
						else {
							$read[] = $numberLang[$subNum[2]];
						}
						break;
				}
			}
			$read[] = $numberVL[$i];
		}
		return implode(' ',$read);
	}
}
if (!function_exists('helper_module_count_item01')){
	function helper_module_count_item01($table = '', $arr){
		$CI =& get_instance();
		$count = $CI->db->where($arr)->from($table)->count_all_results();
		return $count;
	}
}

if (!function_exists('helper_module_count_item')){
	function helper_module_count_item($table = '', $parentid = 0){
		$CI =& get_instance();
		$count = $CI->db->where(array('parentid' => $parentid))->from($table)->count_all_results();
		return $count;
	}
}

if (!function_exists('helper_module_count_comment_item')){
	function helper_module_count_comment_item($parentid = ''){
		$CI =& get_instance();
		$count = $CI->db->where(array('parentid' => $parentid))->from('comment')->count_all_results();
		return $count;
	}
}

if (!function_exists('helper_module_menu')){
	function helper_module_menu($parentid = 0){
		$CI =& get_instance();
		$menu = '';
		$data = $CI->db->select('id, title, module, moduleid, url, extensions')->from('menu_item')->where(array('parentid' => $parentid, 'publish' => 1))->order_by('order asc')->get()->result_array();
		if(isset($data) && count($data)){
			foreach($data as $key => $val){
				if(!empty($val['url'])){
					$menu = $menu.'<li class="main"><div class="line-menu"></div><a class="main" href="'.$val['url'].'" title="'.htmlspecialchars($val['title']).'" '.$val['extensions'].'>'.$val['title'].'</a></li>';
				}
				else if(!empty($val['module']) && $val['moduleid'] > 0){
					if($val['module'] == 'products') {
						$menu = $menu.helper_module_menu_products_item($val['module'].'_category', $val['moduleid'], '', 'li');
					}else{
						$menu = $menu.helper_module_menu_item($val['module'].'_category', $val['moduleid'], '', 'li');
					}
				}
			}
		}
		if($parentid == 2) {
		$menu = !empty($menu)?'<ul class="main">'.$menu.'<li class="main search-menu">
						<a class="icon"></a>
						<ul class="item">
							<li class="item">
								<div class="sub-menu-wrapper sub-menu-search hover">
									<div class="sub-menu">
										<form name="search-box" action="tim-kiem-san-pham.html" class="form-search-box">
											<input type="text" name="q" class="search-textbox ui-autocomplete-input" placeholder="Bạn cần tìm gì?" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
											<input type="submit" class="search-button" value="">
										</form>
									</div>
								</div>
							</li>
						</ul>
					</li></ul>':$menu;
		}else{
		$menu = !empty($menu)?'<ul class="main">'.$menu.'</ul>':$menu;
		}
		return $menu;
	}
}

if(!function_exists('helper_module_menu_item')){
	function helper_module_menu_item($table = '', $parentid = 0, $module = '', $type = 'ul'){
		$CI =& get_instance();
		$data = $CI->db->select('id, title, parentid, lft, rgt')->from($table)->where(array('publish' => 1))->get()->result_array();
		$menu = '';
		$tempMain = '';
		// Main menu
		if(isset($data) && count($data)){
			foreach($data as $keyMain => $valMain){
				if($type == 'li'){
					$temp = 'id';
				}
				else if($type == 'ul'){
					$temp = 'parentid';
				}
				if($valMain[$temp] == $parentid){
					$tempMain = $tempMain . '<li class="main"><a class="main" href="'.helper_string_alias($valMain['title']).'-c'.$valMain['id'].CMS_SUFFIX.'" title="'.htmlspecialchars($valMain['title']).'">'.$valMain['title'].'</a>';
					// Item menu
					if($valMain['rgt'] - $valMain['lft'] > 1){
						$tempItem = '';
						foreach($data as $keyItem => $valItem){
							if($valItem['parentid'] == $valMain['id']){
								$tempItem = $tempItem . '<li class="item"><a class="item" href="'.helper_string_alias($valItem['title']).'-c'.$valItem['id'].CMS_SUFFIX.'" title="'.htmlspecialchars($valItem['title']).'">'.$valItem['title'].'</a>';
								// Children menu
								if($valItem['rgt'] - $valItem['lft'] > 1){
									$tempChildren = '';
									foreach($data as $keyChildren => $valChildren){
										if($valChildren['parentid'] == $valItem['id']){
											$tempChildren = $tempChildren . '<li class="children"><a class="children" href="'.helper_string_alias($valChildren['title']).'-c'.$valChildren['id'].CMS_SUFFIX.'" title="'.htmlspecialchars($valChildren['title']).'">'.$valChildren['title'].'</a>';
											// Grandchildren menu
											if($valItem['rgt'] - $valItem['lft'] > 1){
												$tempGrandchildren = '';
												foreach($data as $keyGrandchildren => $valGrandchildren){
													if($valGrandchildren['parentid'] == $valChildren['id']){
														$tempGrandchildren = $tempGrandchildren . '<li class="grandchildren"><a class="grandchildren" href="'.helper_string_alias($valGrandchildren['title']).'-c'.$valGrandchildren['id'].CMS_SUFFIX.'" title="'.htmlspecialchars($valGrandchildren['title']).'">'.$valGrandchildren['title'].'</a>';
														$tempGrandchildren = $tempGrandchildren . '</li>';
													}
												}
												$tempChildren = !empty($tempGrandchildren)? $tempChildren.'<ul class="grandchildren">'.$tempGrandchildren.'</ul>':$tempChildren;
											}
											$tempChildren = $tempChildren . '</li>';
										}
									}
									$tempItem = !empty($tempChildren)? $tempItem.'<ul class="children">'.$tempChildren.'</ul>':$tempItem;
								}
								$tempItem = $tempItem . '</li>';
							}
						}
						$tempMain = !empty($tempItem)? $tempMain.'<ul class="item">'.$tempItem.'</ul>':$tempMain;
					}
					$tempMain = $tempMain . '</li>';
				}
			}
		}
		if($type == 'li'){
			$menu = !empty($tempMain)?$tempMain:'';
		}
		else if($type == 'ul'){
			$menu = !empty($tempMain)?'<ul class="main">'.$tempMain.'</ul>':'';
		}
		return $menu;
	}
}
if(!function_exists('helper_module_menu_products_item')){
	function helper_module_menu_products_item($table = '', $parentid = 0, $module = '', $type = 'ul'){
		$CI =& get_instance();
		$data = $CI->db->select('id, title, parentid, lft, rgt')->from($table)->where(array('publish' => 1))->get()->result_array();
		$menu = '';
		$tempMain = '';
		// Main menu
		if(isset($data) && count($data)){
			foreach($data as $keyMain => $valMain){
				if($type == 'li'){
					$temp = 'id';
				}
				else if($type == 'ul'){
					$temp = 'parentid';
				}
				if($valMain[$temp] == $parentid){
					$tempMain = $tempMain . '<li class="main"><a class="main" href="'.helper_string_alias($valMain['title']).'-cp'.$valMain['id'].CMS_SUFFIX.'" title="'.htmlspecialchars($valMain['title']).'">'.$valMain['title'].'</a>';
					// Item menu
					if($valMain['rgt'] - $valMain['lft'] > 1){
						$tempItem = '';
						foreach($data as $keyItem => $valItem){
							$cateid = helper_module_get_item_info('products_category', $valItem['parentid']);
							if($valItem['parentid'] == $valMain['id']){
								
								$tempItem = $tempItem . '<li class="item"><a class="item" href="'.helper_string_alias($cateid['title']).'/'.helper_string_alias($valItem['title']).'-cp'.$valItem['id'].CMS_SUFFIX.'" title="'.htmlspecialchars($valItem['title']).'">'.$valItem['title'].'</a>';
								// Children menu
								if($valItem['rgt'] - $valItem['lft'] > 1){
									$tempChildren = '';
									foreach($data as $keyChildren => $valChildren){
										if($valChildren['parentid'] == $valItem['id']){
											$tempChildren = $tempChildren . '<li class="children"><a class="children" href="'.helper_string_alias($valChildren['title']).'-cp'.$valChildren['id'].CMS_SUFFIX.'" title="'.htmlspecialchars($valChildren['title']).'">'.$valChildren['title'].'</a>';
											// Grandchildren menu
											if($valItem['rgt'] - $valItem['lft'] > 1){
												$tempGrandchildren = '';
												foreach($data as $keyGrandchildren => $valGrandchildren){
													if($valGrandchildren['parentid'] == $valChildren['id']){
														$tempGrandchildren = $tempGrandchildren . '<li class="grandchildren"><a class="grandchildren" href="'.helper_string_alias($valGrandchildren['title']).'-cp'.$valGrandchildren['id'].CMS_SUFFIX.'" title="'.htmlspecialchars($valGrandchildren['title']).'">'.$valGrandchildren['title'].'</a>';
														$tempGrandchildren = $tempGrandchildren . '</li>';
													}
												}
												$tempChildren = !empty($tempGrandchildren)? $tempChildren.'<ul class="grandchildren">'.$tempGrandchildren.'</ul>':$tempChildren;
											}
											$tempChildren = $tempChildren . '</li>';
										}
									}
									$tempItem = !empty($tempChildren)? $tempItem.'<ul class="children">'.$tempChildren.'</ul>':$tempItem;
								}
								$tempItem = $tempItem . '</li>';
							}
						}
						$tempMain = !empty($tempItem)? $tempMain.'<ul class="item">'.$tempItem.'</ul>':$tempMain;
					}
					$tempMain = $tempMain . '</li>';
				}
			}
		}
		if($type == 'li'){
			$menu = !empty($tempMain)?$tempMain:'';
		}
		else if($type == 'ul'){
			$menu = !empty($tempMain)?'<ul class="main">'.$tempMain.'</ul>':'';
		}
		return $menu;
	}
}

if (!function_exists('helper_module_list_contact')){
	function helper_module_list_contact($table = '', $param = NULL, $orderby = 'id desc', $limit = 5){
		$CI =& get_instance();
		if($param == NULL){
			$data = $CI->db->select('*')->from($table)->where(array('publish' => 1))->order_by($orderby)->limit($limit, 0)->get()->result_array();
		}
		else{
			$data = $CI->db->select('*')->from($table)->where($param)->where(array('publish' => 1))->order_by($orderby)->limit($limit, 0)->get()->result_array();
		}
		return $data;
	}
}
if (!function_exists('helper_module_list_category')){
	function helper_module_list_category($table = '', $param = NULL, $orderby = 'id desc', $limit = 5){
		$CI =& get_instance();
		if($param == NULL){
			$data = $CI->db->select('*')->from($table)->where(array('publish' => 1))->order_by($orderby)->limit($limit, 0)->get()->result_array();
		}
		else{
			$data = $CI->db->select('*')->from($table)->where($param)->where(array('publish' => 1))->order_by($orderby)->limit($limit, 0)->get()->result_array();
		}
		return $data;
	}
}

if (!function_exists('helper_module_list_item')){
	function helper_module_list_item($table = '', $select = 'id, title, parentid, image, description, viewed, created, updated', $param = NULL, $orderby = 'id desc', $limit = 5, $recursive = FALSE){
		$CI =& get_instance();
		if($param == NULL){
			$data = $CI->db->select($select)->from($table)->where(array('publish' => 1))->order_by($orderby)->limit($limit, 0)->get()->result_array();
		}
		else{
			if($recursive == FALSE){
				$data = $CI->db->select($select)->from($table)->where($param)->where(array('publish' => 1))->order_by($orderby)->limit($limit, 0)->get()->result_array();
			}
			else{
				$children = helper_module_children(str_replace('_item', '_category', $table), $param['parentid']);
				$data = $CI->db->select($select)->from($table)->where_in('parentid', $children)->where(array('publish' => 1))->order_by($orderby)->limit($limit, 0)->get()->result_array();
			}
		}
		return $data;
	}
}

if (!function_exists('helper_module_children')){
	function helper_module_children($table = '', $id = 0){
		$CI =& get_instance();
		$temp = NULL;
		$category = $CI->db->select('id, lft, rgt')->from($table)->where(array('id' => $id))->get()->row_array();
		if(isset($category) && count($category)){
			$children = $CI->db->select('id')->from($table)->where(array('lft >=' => $category['lft'], 'rgt <=' => $category['rgt']))->get()->result_array();
			if(isset($children) && count($children)){
				foreach($children as $key => $val){
					$temp[] = $val['id'];
				}
			}
		}
		return $temp;
	}
}


// Cắt chuỗi
if(!function_exists('cutnchar')){
	function cutnchar($str = NULL, $n = 0){
		if(strlen($str)<$n) return $str;
		$html = substr($str,0,$n);
		$html = substr($html,0,strrpos($html,' '));
		return $html.' ...';
	}
}

if (!function_exists('helper_module_breadcrumb')){
	function helper_module_breadcrumb($table = '', $param = NULL, $type = 'category'){
		$CI =& get_instance();
		$breadcrumb = '';
		$category = $CI->db->select('id, title')->where($param)->order_by('lft', 'asc')->from($table)->get()->result_array();
		$breadcrumb = '<ul class="breadcrumb">';
		$breadcrumb = $breadcrumb.'<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a rel="nofollow" href="'.CMS_URL.'" title="Home" itemprop="url"><span itemprop="title">Home</span></a></li>';
		if(isset($category) && count($category)){
			$total = count($category);
			foreach($category as $key => $val){
				$breadcrumb = $breadcrumb.'<li class="spacebar">&raquo;</li>';
				if($type == 'category') $h = ($total - $key);
				else if($type == 'item') $h = ($total - $key + 1);
				$h = ($h > 6)?'6':$h;
				$breadcrumb = $breadcrumb . '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><h'.$h.'><a href="'.(helper_string_alias($val['title']).'-c'.$val['id'].CMS_SUFFIX).'" title="'.htmlspecialchars($val['title']).'" itemprop="url"><span itemprop="title">'.htmlspecialchars($val['title']).'</span></a></h'.$h.'></li>';
			}
		}
		$breadcrumb = $breadcrumb.'</ul>';
		return $breadcrumb;
	}
}
if (!function_exists('helper_module_products_breadcrumb')){
	function helper_module_products_breadcrumb($table = '', $param = NULL, $type = 'category'){
		$CI =& get_instance();
		$breadcrumb = '';
		$category = $CI->db->select('id, title, meta_title')->where($param)->order_by('lft', 'asc')->from($table)->get()->result_array();
		$breadcrumb = '<ul class="breadcrumb">';
		$breadcrumb = $breadcrumb.'<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a rel="nofollow" href="'.CMS_URL.'" title="Home" itemprop="url"><span itemprop="title">Home</span></a></li>';
		if(isset($category) && count($category)){
			$total = count($category);
			foreach($category as $key => $val){
				$ttitle = !empty($val['meta_title'])?$val['meta_title']:$val['title'];
				$breadcrumb = $breadcrumb.'<li class="spacebar">&raquo;</li>';
				if($type == 'category') $h = ($total - $key);
				else if($type == 'item') $h = ($total - $key + 1);
				$h = ($h > 6)?'6':$h;
				$breadcrumb = $breadcrumb . '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><h'.$h.'><a href="'.(helper_string_alias($val['title']).'-cp'.$val['id'].CMS_SUFFIX).'" title="'.htmlspecialchars($ttitle).'" itemprop="url"><span itemprop="title">'.htmlspecialchars($ttitle).'</span></a></h'.$h.'></li>';
			}
		}
		$breadcrumb = $breadcrumb.'</ul>';
		return $breadcrumb;
	}
}
if (!function_exists('helper_module_bst_breadcrumb')){
	function helper_module_bst_breadcrumb($table = '', $param = NULL, $type = 'category'){
		$CI =& get_instance();
		$breadcrumb = '';
		$category = $CI->db->select('id, title')->where($param)->order_by('lft', 'asc')->from($table)->get()->result_array();
		$breadcrumb = '<ul class="breadcrumb">';
		$breadcrumb = $breadcrumb.'<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a rel="nofollow" href="'.CMS_URL.'" title="Home" itemprop="url"><span itemprop="title">Home</span></a></li>';
		if(isset($category) && count($category)){
			$total = count($category);
			foreach($category as $key => $val){
				$breadcrumb = $breadcrumb.'<li class="spacebar">&raquo;</li>';
				if($type == 'category') $h = ($total - $key);
				else if($type == 'item') $h = ($total - $key + 1);
				$h = ($h > 6)?'6':$h;
				$breadcrumb = $breadcrumb . '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><h'.$h.'><a href="'.(helper_string_alias($val['title']).'-cb'.$val['id'].CMS_SUFFIX).'" title="'.htmlspecialchars($val['title']).'" itemprop="url"><span itemprop="title">'.htmlspecialchars($val['title']).'</span></a></h'.$h.'></li>';
			}
		}
		$breadcrumb = $breadcrumb.'</ul>';
		return $breadcrumb;
	}
}
if (!function_exists('helper_module_lockbook_breadcrumb')){
	function helper_module_lockbook_breadcrumb($table = '', $param = NULL, $type = 'category'){
		$CI =& get_instance();
		$breadcrumb = '';
		$category = $CI->db->select('id, title')->where($param)->order_by('lft', 'asc')->from($table)->get()->result_array();
		$breadcrumb = '<ul class="breadcrumb">';
		$breadcrumb = $breadcrumb.'<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a rel="nofollow" href="'.CMS_URL.'" title="Home" itemprop="url"><span itemprop="title">Home</span></a></li>';
		if(isset($category) && count($category)){
			$total = count($category);
			foreach($category as $key => $val){
				$breadcrumb = $breadcrumb.'<li class="spacebar">&raquo;</li>';
				if($type == 'category') $h = ($total - $key);
				else if($type == 'item') $h = ($total - $key + 1);
				$h = ($h > 6)?'6':$h;
				$breadcrumb = $breadcrumb . '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><h'.$h.'><a href="'.(helper_string_alias($val['title']).'-ctl'.$val['id'].CMS_SUFFIX).'" title="'.htmlspecialchars($val['title']).'" itemprop="url"><span itemprop="title">'.htmlspecialchars($val['title']).'</span></a></h'.$h.'></li>';
			}
		}
		$breadcrumb = $breadcrumb.'</ul>';
		return $breadcrumb;
	}
}

if (!function_exists('helper_module_tags')){
	function helper_module_tags($data = NULL){
		$tags = '';
		$data = explode(',', $data);
		if(isset($data) && count($data)){
			foreach($data as $key => $val){
				$val = trim($val);
				if(empty($val)) continue;
				$tags = $tags.'<a href="tag/'.helper_string_alias($val).CMS_SUFFIX.'" title="'.htmlspecialchars($val).'">'.htmlspecialchars($val).'</a>';
				$tags = $tags.'<span>,</span>';
			}
		}
		return $tags;
	}
}

if (!function_exists('helper_module_tags_sp')){
	function helper_module_tags_sp($data = NULL){
		$tags = '';
		$data = explode(',', $data);
		if(isset($data) && count($data)){
			foreach($data as $key => $val){
				$val = trim($val);
				if(empty($val)) continue;
				$tags = $tags.'<a href="tags/'.helper_string_alias($val).CMS_SUFFIX.'" title="'.htmlspecialchars($val).'">'.htmlspecialchars($val).'</a>';
				$tags = $tags.'<span>,</span>';
			}
		}
		return $tags;
	}
}


// Dịch 
if(!function_exists('translate')){
	function translate($vie = NULL){
		$a = urlencode($vie);
		require_once('plugin/simple_html_dom.php');
		$source = 'http://tratu.coviet.vn/hoc-tieng-trung/tu-dien/lac-viet/V-T/'.$a.'.html';
		$html = file_get_html($source); if(!isset($html)) die('Don\'t isset $html');
		$list = $html->find('#partofspeech_0 .m span',0);
		if(isset($list)) {
			$list = $list->innertext;
			$item_list = explode("<", $list);
			return $item_list[0];
		}else{
			return $vie;
		}
	}
}
// Thêm _ 
if(!function_exists('changechar')){
	function changechar($char = NULL){
		$char = str_replace(' ', '%20', $char);
		return $char;
	}
}