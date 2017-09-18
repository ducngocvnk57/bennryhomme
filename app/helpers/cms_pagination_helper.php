<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('helper_string_pagination_backend')){
	function helper_string_pagination_backend($page = NULL, $total = 0){
		$pagination = '';
		if(isset($page) && count($page)){
			foreach($page as $key => $val){
				if($val['type'] == 'first_link'){
					$pagination = $pagination . '<li><a href="'.substr($val['base_url'], 0, -1).'" title="Trang đầu">Trang đầu</a></li>';
				}
				else if($val['type'] == 'prev_link'){
					if($val['page'] == 1 || $val['title'] == 1){
						$pagination = $pagination . '<li><a rel="prev" href="'.substr($val['base_url'], 0, -1).'" title="Trang trước">Trang trước</a></li>';
					}
					else{
						$pagination = $pagination . '<li><a rel="prev" href="'.$val['base_url'].'page='.$val['page'].'" title="Trang '.$val['page'].'">Trang trước</a></li>';
					}
				}
				else if($val['type'] == 'loop'){
					if($val['page'] == 1 || $val['title'] == 1){
						$val['page'] = 1;
						$val['title'] = 1;
						$pagination = $pagination . '<li><a href="'.substr($val['base_url'], 0, -1).'" title="Trang '.$val['page'].'">'.$val['title'].'</a></li>';
					}
					else{
						$pagination = $pagination . '<li><a href="'.$val['base_url'].'page='.$val['page'].'" title="Trang '.$val['page'].'">'.$val['title'].'</a></li>';
					}
				}
				else if($val['type'] == 'cur_page'){
					if($val['page'] == 1 || $val['title'] == 1){
						$val['page'] = 1;
						$val['title'] = 1;
						$pagination = $pagination . '<li><a href="'.substr($val['base_url'], 0, -1).'" title="Trang '.$val['page'].'" class="current">'.$val['title'].'</a></li>';
					}
					else{
						$pagination = $pagination . '<li><a href="'.$val['base_url'].'page='.$val['page'].'" title="Trang '.$val['page'].'" class="current">'.$val['title'].'</a></li>';
					}
					
				}
				else if($val['type'] == 'next_link'){
					$pagination = $pagination . '<li><a rel="next" href="'.$val['base_url'].'page='.$val['page'].'" title="Trang '.$val['page'].'">Trang sau</a></li>';
				}
				else if($val['type'] == 'last_link'){
					$pagination = $pagination . '<li><a href="'.$val['base_url'].'page='.$val['page'].'" title="Trang cuối">Trang cuối</a></li>';
				}
			}
		}
		return !empty($pagination)?'<ul>'.$pagination.'</ul>':'';
	}
}

if (!function_exists('helper_string_pagination_frontend')){
	function helper_string_pagination_frontend($page = NULL, $total = 0,$keyword){
		if(isset($keyword) && count($keyword)) {
			$pagination = '';
			if(isset($page) && count($page)){
				foreach($page as $key => $val){
					if($val['type'] == 'first_link'){
						$pagination = $pagination . '<li><a href="'.substr($val['base_url'], 0, -1).CMS_SUFFIX.'?keyword='.$keyword.'" title="Trang đầu">Trang đầu</a></li>';
					}
					else if($val['type'] == 'prev_link'){
						if($val['page'] == 1 || $val['title'] == 1){
							$pagination = $pagination . '<li class="next-prev"><a rel="prev" href="'.substr($val['base_url'], 0, -1).CMS_SUFFIX.'?keyword='.$keyword.'" title="Trang trước">Trang trước</a></li>';
						}
						else{
							$pagination = $pagination . '<li class="next-prev"><a rel="prev" href="'.$val['base_url'].'p'.$val['page'].CMS_SUFFIX.'?keyword='.$keyword.'" title="Trang '.$val['page'].'">Trang trước</a></li>';
						}
					}
					else if($val['type'] == 'loop'){
						if($val['page'] == 1 || $val['title'] == 1){
							$val['page'] = 1;
							$val['title'] = 1;
							$pagination = $pagination . '<li><a href="'.substr($val['base_url'], 0, -1).CMS_SUFFIX.'?keyword='.$keyword.'" title="Trang '.$val['page'].'">'.$val['title'].'</a></li>';
						}
						else{
							$pagination = $pagination . '<li><a href="'.$val['base_url'].'p'.$val['page'].CMS_SUFFIX.'?keyword='.$keyword.'" title="Trang '.$val['page'].'">'.$val['title'].'</a></li>';
						}
					}
					else if($val['type'] == 'cur_page'){
						if($val['page'] == 1 || $val['title'] == 1){
							$val['page'] = 1;
							$val['title'] = 1;
							$pagination = $pagination . '<li><a href="'.substr($val['base_url'], 0, -1).CMS_SUFFIX.'?keyword='.$keyword.'" title="Trang '.$val['page'].'" class="current">'.$val['title'].'</a></li>';
						}
						else{
							$pagination = $pagination . '<li><a href="'.$val['base_url'].'p'.$val['page'].CMS_SUFFIX.'?keyword='.$keyword.'" title="Trang '.$val['page'].'" class="current">'.$val['title'].'</a></li>';
						}
						
					}
					else if($val['type'] == 'next_link'){
						$pagination = $pagination . '<li class="next-prev"><a rel="next" href="'.$val['base_url'].'p'.$val['page'].CMS_SUFFIX.'?keyword='.$keyword.'" title="Trang '.$val['page'].'">Trang sau</a></li>';
					}
					else if($val['type'] == 'last_link'){
						$pagination = $pagination . '<li class="next-prev"><a href="'.$val['base_url'].'p'.$val['page'].CMS_SUFFIX.'?keyword='.$keyword.'" title="Trang cuối">Trang cuối</a></li>';
					}
				}
			}
		}else{
			$pagination = '';
			if(isset($page) && count($page)){
				foreach($page as $key => $val){
					if($val['type'] == 'first_link'){
						$pagination = $pagination . '<li><a href="'.substr($val['base_url'], 0, -1).CMS_SUFFIX.'" title="Trang đầu">Trang đầu</a></li>';
					}
					else if($val['type'] == 'prev_link'){
						if($val['page'] == 1 || $val['title'] == 1){
							$pagination = $pagination . '<li><a rel="prev" href="'.substr($val['base_url'], 0, -1).CMS_SUFFIX.'" title="Trang trước" class="next-prev">Trang trước</a></li>';
						}
						else{
							$pagination = $pagination . '<li class="next-prev"><a rel="prev" href="'.$val['base_url'].'p'.$val['page'].CMS_SUFFIX.'" title="Trang '.$val['page'].'">Trang trước</a></li>';
						}
					}
					else if($val['type'] == 'loop'){
						if($val['page'] == 1 || $val['title'] == 1){
							$val['page'] = 1;
							$val['title'] = 1;
							$pagination = $pagination . '<li><a href="'.substr($val['base_url'], 0, -1).CMS_SUFFIX.'" title="Trang '.$val['page'].'">'.$val['title'].'</a></li>';
						}
						else{
							$pagination = $pagination . '<li><a href="'.$val['base_url'].'p'.$val['page'].CMS_SUFFIX.'" title="Trang '.$val['page'].'">'.$val['title'].'</a></li>';
						}
					}
					else if($val['type'] == 'cur_page'){
						if($val['page'] == 1 || $val['title'] == 1){
							$val['page'] = 1;
							$val['title'] = 1;
							$pagination = $pagination . '<li><a href="'.substr($val['base_url'], 0, -1).CMS_SUFFIX.'" title="Trang '.$val['page'].'" class="current">'.$val['title'].'</a></li>';
						}
						else{
							$pagination = $pagination . '<li><a href="'.$val['base_url'].'p'.$val['page'].CMS_SUFFIX.'" title="Trang '.$val['page'].'" class="current">'.$val['title'].'</a></li>';
						}
						
					}
					else if($val['type'] == 'next_link'){
						$pagination = $pagination . '<li class="next-prev"><a rel="next" href="'.$val['base_url'].'p'.$val['page'].CMS_SUFFIX.'" title="Trang '.$val['page'].'">Trang sau</a></li>';
					}
					else if($val['type'] == 'last_link'){
						$pagination = $pagination . '<li class="next-prev"><a href="'.$val['base_url'].'p'.$val['page'].CMS_SUFFIX.'" title="Trang cuối">Trang cuối</a></li>';
					}
				}
			}
		}
		return !empty($pagination)?'<ul>'.$pagination.'</ul>':'';
	}
}