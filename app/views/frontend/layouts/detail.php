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
<meta property="og:url" content="<?php echo isset($data['canonical'])?$data['canonical']:'';?>" />
<meta property="og:site_name" content="Thời trang Alo" />

<meta itemprop="description" content="<?php echo isset($data['meta_description'])?$data['meta_description']:'';?>" />
<meta itemprop="url" href="<?php echo isset($data['canonical'])?$data['canonical']:'';?>" />
<meta itemprop="image" content="<?php echo isset($data['image'])?$data['image']:'';?>" />
<meta property="og:image" content="<?php echo isset($data['image'])?$data['image']:'';?>" />
<?php echo (isset($data['google_authorship']) && !empty($data['google_authorship']))?'<link rel="author" href="'.$data['google_authorship'].'"/>':'';?>

	<link href="template/frontend/css/normalize.css" type="text/css" rel="stylesheet">
		
	<link href="template/frontend/css/normalize.css" rel="stylesheet" type="text/css" />
	<link href="template/frontend/css/reset.css" rel="stylesheet" type="text/css" />
	<link href="template/frontend/css/style.css?<?php echo time(); ?>" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="template/frontend/css/flexslider.css" type="text/css" media="screen" />
	<link href="template/frontend/css/responsive.css?<?php echo time(); ?>" type="text/css" rel="stylesheet" />
	<link href="template/frontend/fonts/font-awesome-4.1.0/css/font-awesome.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="template/frontend/js/jquery.js"></script>
	<script type="text/javascript" src="template/frontend/js/jquery.easing.js"></script>
	<script type="text/javascript" src="template/frontend/js/jquery.touchSwipe.min.js"></script>
	<script type="text/javascript" src="template/frontend/js/script.js"></script>
	
	
		
	<link href="template/frontend/plugins/fancybox/source/jquery.fancybox.css?v=2.1.5" rel="stylesheet" type="text/css" />
	<link href="template/frontend/plugins/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" rel="stylesheet" type="text/css" />
	<link href="template/frontend/plugins/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" rel="stylesheet" type="text/css" />
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
<?php $this->load->view('frontend/header');?>
<section style="clear:both;"></section>
<?php $data = isset($data)?$data:NULL; $this->load->view($template, $data);?>
<section style="clear:both;"></section>
<?php $this->load->view('frontend/footer');?>

	<script type="text/javascript" src="template/frontend/plugins/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
	<script type="text/javascript" src="template/frontend/plugins/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="template/frontend/plugins/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="template/frontend/plugins/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="template/frontend/plugins/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

	<script type="text/javascript">
	$(window).load(function(){
		$('.fancybox-buttons').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',

			prevEffect : 'none',
			nextEffect : 'none',

			closeBtn  : false,
			openSpeed  : 150,
			closeSpeed  : 150,
			closeBtn  : false,
			helpers : {
				title : {
					type : 'inside'
				},
				buttons	: {}
			},
			afterLoad : function() {
				this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
			}
		});
	});
	</script>

<script type="text/javascript">
	$(window).load(function(){
		var _temp;
		var _index;
		var _class;
		$('.content-scroll .tab-content').css({'display':'none'});
		$('.content-scroll .tab-noibat').css({'display':'block'});
		$('.new-box li a:eq(0)').addClass('active');
		$('.new-box li a').click(function(){
			_class = $(this).attr('href').substring(1);
			$('.new-box li a').removeClass('active');
			$(this).addClass('active');
			$('.content-scroll .tab-content').slideUp('slow', function(){});
			$('.content-scroll .tab-content.tab-'+_class).slideDown('slow', function(){});
			return false;
		});
	});
	$(function() {
		var jmpressOpts	= {
			animation		: { transitionDuration : '1.5s' }
		};
		$( '#jms-slideshow' ).jmslideshow( $.extend( true, { jmpressOpts : jmpressOpts }, {
			autoplay	: true,
			bgColorSpeed: '1.5s',
			arrows		: true
		}));
	});
</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.4&appId=1532673496873504";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">
window.___gcfg = {lang: 'vi'};
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
po.src = 'https://apis.google.com/js/plusone.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
<script type="text/javascript">
var cms_url = '<?php echo CMS_URL;?>';
var menu_active = '<?php echo isset($menu_active)?$menu_active:'';?>';
</script>
<script src="template/plugins/raty-2.5.2/lib/jquery.raty.min.js"></script>
<script>
$('#star').raty({
  click: function(score){
	_this = $(this)
	$.post(cms_url+'frontend/common/rating<?php echo CMS_SUFFIX.'?key='.helper_string_encode_cookie(array('table' => 'articles_item'));?>', {item: _this.attr('class'), score: score}, function(data){
		alert(data);
		location.reload();
	});
  },
  score: function(){
    return $(this).attr('data-score');
  }
});
</script>


<script type="text/javascript" src="template/frontend/js/jquery.elevatezoom.js"></script>
<script>
    $('#zoom_01').elevateZoom({
		easing : true
	}); 
    $('#zoom_02').elevateZoom({
		easing : true
	}); 
    $('#zoom_03').elevateZoom({
		easing : true
	}); 
    $('#zoom_04').elevateZoom({
		easing : true
	}); 
    $('#zoom_05').elevateZoom({
		easing : true
	}); 
    $('#zoom_06').elevateZoom({
		easing : true
	}); 
    $('#zoom_07').elevateZoom({
		easing : true
	}); 
    $('#zoom_08').elevateZoom({
		easing : true
	}); 
</script>


</body>
</html>