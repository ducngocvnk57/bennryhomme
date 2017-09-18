<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<base href="<?php echo CMS_URL;?>" />
<link href="<?php echo isset($this->system['icon'])?htmlspecialchars($this->system['icon']):NULL;?>" rel="shortcut icon" type="image/x-icon" />
<link rel="icon" type="image/png" href="<?php echo isset($this->system['icon'])?htmlspecialchars($this->system['icon']):NULL;?>" />
<meta name="robots" content="noodp,index,follow" />
<meta name="revisit-after" content="1 days" />
<meta http-equiv="content-language" content="vi" />
<title><?php echo isset($data['meta_title'])?$data['meta_title']:'';?></title>
<meta name="keywords" content="<?php echo isset($data['meta_keywords'])?$data['meta_keywords']:'';?>" />
<meta name="description" content="<?php echo isset($data['meta_description'])?$data['meta_description']:'';?>" />
<link rel="canonical" href="<?php echo isset($data['canonical'])?$data['canonical']:'';?>"/>
<?php echo (isset($data['rel_prev']) && !empty($data['rel_prev']))?'<link rel="prev" href="'.$data['rel_prev'].'" />':'';?>
<?php echo (isset($data['rel_next']) && !empty($data['rel_next']))?'<link rel="next" href="'.$data['rel_next'].'" />':'';?>

<meta property="og:title" content="<?php echo isset($data['meta_title'])?$data['meta_title']:'';?>" />
<meta property="og:type" content="article" />
<meta property="og:description" content="<?php echo isset($data['meta_description'])?$data['meta_description']:'';?>" />
<meta property="og:image" content="<?php echo isset($data['image'])?$data['image']:'';?>" />
<meta property="og:url" content="<?php echo isset($data['canonical'])?$data['canonical']:CMS_URL;?>" />
<meta property="og:site_name" content="Thời trang Alo" />

<meta itemprop="description" content="<?php echo isset($data['meta_description'])?$data['meta_description']:'';?>" />
<meta itemprop="url" href="<?php echo isset($data['canonical'])?$data['canonical']:'';?>" />
<meta itemprop="image" content="<?php echo isset($data['image'])?$data['image']:'';?>" />
<meta property="og:image" content="<?php echo isset($data['image'])?$data['image']:'';?>" />
<?php echo (isset($data['google_authorship']) && !empty($data['google_authorship']))?'<link rel="author" href="'.$data['google_authorship'].'"/>':'';?>
		
	<link rel="stylesheet" href="template/frontend/css/font-awesome/css/font-awesome.min.css">
    <link href="template/frontend/css/animate.css" rel="stylesheet" type="text/css">
    <!--Reset css về mặc định trên các trình duyệt-->
	<link href="template/frontend/css/normalize.css"  rel="stylesheet" type="text/css"/>
    <link href="template/frontend/plugins/flexslider/flexslider.css" rel="stylesheet" type="text/css" />
	<!--Css dùng chung -->
	<link href="template/frontend/css/reset.css"  rel="stylesheet" type="text/css"/>
    <!--Css chính cho toàn trang -->
	<link href="template/frontend/css/style.css" rel="stylesheet" type="text/css" />
	<link href="template/frontend/css/responsive.css" type="text/css" rel="stylesheet" />
	<link href="template/frontend/fonts/font-awesome-4.1.0/css/font-awesome.css" type="text/css" rel="stylesheet">
	 
    <!--Jquery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '1021507944585718');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1021507944585718&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

</head>
<body>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-82840241-1', 'auto');
  ga('send', 'pageview');

</script>
<section class="wrapper">
	<?php $this->load->view('frontend/header');?>
	<section style="clear:both;"></section>
	<?php $this->load->view('frontend/slide');?>
	<section style="clear:both;"></section>
	<?php $data = isset($data)?$data:NULL; $this->load->view($template, $data);?>
	<section style="clear:both;"></section>
	<?php $this->load->view('frontend/footer');?>
</section>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.4&appId=1532673496873504";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script defer src="template/frontend/plugins/flexslider/jquery.flexslider.js"></script>
<script type="text/javascript">  
$(window).load(function(){
	  $('.flexslider').flexslider({
		animation: "slide",
	  });
});
</script>
</body>
</html>