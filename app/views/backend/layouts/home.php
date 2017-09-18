<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<base href="<?php echo CMS_URL;?>" />
<title><?php echo isset($meta_title)?$meta_title:'';?></title>
<meta name="title" content="<?php echo isset($meta_title)?$meta_title:'';?>" />
<meta name="keywords" content="<?php echo isset($meta_keywords)?$meta_keywords:'';?>" />
<meta name="description" content="<?php echo isset($meta_description)?$meta_description:'';?>" />
<link href="template/backend/css/normalize.css" rel="stylesheet" type="text/css" />
<link href="template/backend/css/reset.css" rel="stylesheet" type="text/css" />
<link href="template/backend/css/style.css?<?php echo time();?>" rel="stylesheet" type="text/css" />
<link href="template/backend/css/responsive.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="cms-wrapper">
	<div id="cms-header">
		<p class="title">Hệ thống quản trị dữ liệu</p>
	</div><!-- #cms-header -->
	<div id="cms-navigation">
		<div class="left">
		<?php $this->load->view('backend/common/menu');?>
		</div><!-- .left -->
		<div class="right">
			<ul class="main">
				<li class="main main-text">Chào <span><?php $cookie = helper_string_decode_cookie($_COOKIE['cms_cookie_login_'.CMS_CODE]); echo $cookie['fullname'];?></span></li>
				<li class="main"><a href="<?php echo CMS_BACKEND.'/account/information'.CMS_SUFFIX;?>" class="main" title="Thông tin tài khoản">Thông tin</a></li>
				<li class="main"><a href="<?php echo CMS_BACKEND.'/authentication/logout'.CMS_SUFFIX;?>" class="main" title="Đăng xuất">Đăng xuất</a></li>
			</ul>
		</div><!-- .right -->
		<div class="cms-clear"></div>
	</div><!-- #cms-navigation -->
	<?php $data = isset($data)?$data:NULL; $this->load->view($template, $data);?>
	<div id="cms-copyright">
		<p>Copyright &copy; 2014 - Powered by <a href="http://itq.vn/" title="Thiết Kế Web, Dịch Vụ Seo, Marketing Online. All Rights Reserved. Powered by ITQ.VN.">ITQ CMS</a></p>
		<div class="cms-clear"></div>
	</div><!-- #cms-copyright -->
	<div class="cms-clear"></div>
</div><!-- #cms-wrapper -->
<div id="cms-mask">
	<div class="container">
		<img src="template/backend/images/process.gif" alt="Đang tải dữ liệu..." title="Đang tải dữ liệu..."/>
		<span>Đang tải dữ liệu...</span>
	</div>
</div><!-- .cms-mask -->
<script type="text/javascript">
var cms_url = '<?php echo CMS_URL;?>';
var cms_backend = '<?php echo CMS_BACKEND;?>';
var menu_active = '<?php echo isset($menu_active)?$menu_active:'';?>';
</script>
<script type="text/javascript" src="template/backend/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="template/plugins/kunshine8x/global.js?<?php echo time();?>"></script>
<?php $this->load->view('backend/common/tinymce_358');?>
</body>
</html>
