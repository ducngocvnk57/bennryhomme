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
	<div id="cms-login">
		<?php $data = isset($data)?$data:NULL; $this->load->view($template, $data);?>
		<div id="cms-copyright">
			<p>Copyright &copy; 2014 - Powered by <a href="http://itq.vn/" title="Thiết Kế Web, Dịch Vụ Seo, Marketing Online. All Rights Reserved. Powered by ITQ.VN.">ITQ CMS</a></p>
			<div class="cms-clear"></div>
		</div><!-- #cms-copyright -->
	</div><!-- #cms-login -->
</body>
</html>
