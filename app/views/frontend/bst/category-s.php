<section class="wrapper-breadcrumb">
	<section class="wrapper-breadcrumb-inner">
		<?php echo helper_module_breadcrumb('articles_category', array('level >=' => 1, 'lft <=' => $category['lft'], 'rgt >=' => $category['rgt']), 'category');?>
	</section>
</section>
<section class="ben-content">
	<section class="description-cate">
		<?php echo $category['description']; ?>
	</section>
</section>
<script type="text/javascript">
		var i = 0;
		$('.description-cate img').each(function (){
			i = i + 1;
			var src = $(this).attr('src'); 
			$(this).wrap('<div class="img_span"><a class="fancybox-buttons" data-fancybox-group="button" href="'+ src +'"></a><span class="sspecial">'+ i +'</span></div>');
		});
		
</script>