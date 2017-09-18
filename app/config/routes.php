<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 'frontend/home/index';
$route['index$'] = 'frontend/home/index/';
$route['index-p(\d+)$'] = 'frontend/home/index/$1';
$route[CMS_BACKEND] = CMS_BACKEND.'/home/index';

// frontend
$route['contacts$'] = 'frontend/contact/index';
$route['bai-viet-moi-dang-p(\d+)$'] = 'frontend/home/newpost/$1';
$route['bai-viet-moi-dang$'] = 'frontend/home/newpost/1';


$route['dang-ky$'] = 'frontend/auth/register';
$route['dang-nhap$'] = 'frontend/auth/login';
$route['dang-xuat$'] = 'frontend/auth/logout';
$route['quen-mat-khau$'] = 'frontend/auth/forgot';
$route['thong-tin-tai-khoan$'] = 'frontend/auth/info_user';

$route['tim-kiem-san-pham$'] = 'frontend/products/search';
$route['sap-xep-san-pham$'] = 'frontend/products/search_high';
$route['tim-kiem$'] = 'frontend/products/search';
$route['gio-hang$'] = 'frontend/products/cart';
$route['tags/([a-zA-Z0-9/-]+)-p(\d+)$'] = 'frontend/products/tags/$1/$2';
$route['tags/([a-zA-Z0-9/-]+)$'] = 'frontend/products/tags/$1';
$route['tags-p(\d+)$'] = 'frontend/products/tags_detail/$1';
$route['tags$'] = 'frontend/products/tags_detail/'; 
$route['san-pham-moi$'] = 'frontend/products/category_order/'; 
$route['san-pham-khuyen-mai$'] = 'frontend/products/category_sale/'; 

$route['([a-zA-Z0-9/-]+)-th(\d+)-p(\d+)$'] = 'frontend/products/thuonghieu/$2/$3';
$route['([a-zA-Z0-9/-]+)-th(\d+)$'] = 'frontend/products/thuonghieu/$2';
$route['([a-zA-Z0-9/-]+)-cp(\d+)-p(\d+)$'] = 'frontend/products/category/$2/$3';
$route['([a-zA-Z0-9/-]+)-cp(\d+)$'] = 'frontend/products/category/$2';
$route['([a-zA-Z0-9/-]+)-ap(\d+)$'] = 'frontend/products/item/$2';

$route['([a-zA-Z0-9/-]+)-cb(\d+)-p(\d+)$'] = 'frontend/bst/category/$2/$3';
$route['([a-zA-Z0-9/-]+)-cb(\d+)$'] = 'frontend/bst/category/$2';
$route['([a-zA-Z0-9/-]+)-b(\d+)$'] = 'frontend/bst/item/$2';

$route['([a-zA-Z0-9/-]+)-ctl(\d+)-p(\d+)$'] = 'frontend/lockbook/category/$2/$3';
$route['([a-zA-Z0-9/-]+)-ctl(\d+)$'] = 'frontend/lockbook/category/$2';
$route['([a-zA-Z0-9/-]+)-tl(\d+)$'] = 'frontend/lockbook/item/$2';

$route['([a-zA-Z0-9/-]+)-c(\d+)-p(\d+)$'] = 'frontend/articles/category/$2/$3';
$route['([a-zA-Z0-9/-]+)-c(\d+)$'] = 'frontend/articles/category/$2';
$route['([a-zA-Z0-9/-]+)-a(\d+)$'] = 'frontend/articles/item/$2';
$route['tag/([a-zA-Z0-9/-]+)-p(\d+)$'] = 'frontend/articles/tags/$1/$2';
$route['tag/([a-zA-Z0-9/-]+)$'] = 'frontend/articles/tags/$1';
$route['tag-p(\d+)$'] = 'frontend/articles/tags_detail/$1';
$route['tag$'] = 'frontend/articles/tags_detail/';
$route['chu-de/([a-zA-Z0-9/-]+)-p(\d+)$'] = 'frontend/articles/tags/$1/$2';
$route['chu-de/([a-zA-Z0-9/-]+)$'] = 'frontend/articles/tags/$1';
$route['chu-de-p(\d+)$'] = 'frontend/articles/tags_detail/$1';
$route['chu-de$'] = 'frontend/articles/tags_detail/';

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */