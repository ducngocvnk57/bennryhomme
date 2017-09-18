<section class="wrapper-breadcrumb">
	<section class="wrapper-breadcrumb-inner">
		<?php echo helper_module_products_breadcrumb('products_category',array('level >=' => 1, 'lft <=' => $category['lft'], 'rgt >=' => $category['rgt']), 'category');?>
	</section>
</section>
<section class="ben-content">
	<section class="left-content">
		<p class="left-title">Danh mục sản phẩm</p>
		<ul class="list-cate">
		<?php if(($template == "frontend/products/category") || $template == "frontend/products/item") {
				if($category['rgt'] - $category['lft'] != 1) {
					$a = $category['id'];
				}else{
					$a = $category['parentid'];
				}
			}else{
				$a = 89;
			} ?>
		<?php $list_dm01 =  helper_module_list_category('products_category', array('parentid' => $a), 'order asc, id asc',20); ?>
		<?php if(!empty($list_dm01)) { foreach ($list_dm01 as $key_01 => $val_01) {	?>
			<li class="list-cate"><a href="<?php echo helper_string_alias($val_01['title']).'-cp'.$val_01['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val_01['title']);?>"><?php echo htmlspecialchars($val_01['title']);?></a>
				<?php if($val_01['rgt'] - $val_01['lft'] != 1) { ?>
					<ul class="list-item">
					<?php $list_dm02 =  helper_module_list_category('products_category', array('parentid' => $val_01['id']), 'order asc, id asc',20); ?>
					<?php if(!empty($list_dm02)) { foreach ($list_dm02 as $key_02 => $val_02) {	?>
					<li class="list-item"><a class="list-item" href="<?php echo helper_string_alias($val_02['title']).'-cp'.$val_02['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val_02['title']);?>"><?php echo htmlspecialchars($val_02['title']);?></a></li>
					<?php } }  ?>
					</ul>
				<?php } ?>
			</li>
		<?php } }  ?>
		</ul>
		
		<p class="left-title">Chọn thương hiệu</p>
		<ul class="list-cate">
		<?php $list_th =  helper_module_list_category('thuonghieu', array('publish' => 1), 'order asc, id asc',20); ?>
		<?php if(!empty($list_th)) { foreach ($list_th as $key => $val) {	?>
			<li class="list-cate"><a href="<?php echo helper_string_alias($val['title']).'-th'.$val['id'].CMS_SUFFIX;?>" title="<?php echo $val['title']; ?>"><?php echo $val['title']; ?></a></li>
		<?php } }  ?>
		</ul>
		
		<p class="left-title">Tin tức mới</p>
		<ul class="list-cate">
		<?php $list_th =  helper_module_list_category('articles_item', array('parentid' => 52, 'highlight' => 1), 'order asc, id asc',15); ?>
		<?php if(!empty($list_th)) { foreach ($list_th as $key => $val) {	?>
			<li class="list-cate"><a href="<?php echo helper_string_alias($val['title']).'-a'.$val['id'].CMS_SUFFIX;?>" title="<?php echo $val['title']; ?>"><?php echo $val['title']; ?></a></li>
		<?php } }  ?>
		</ul>
	</section>
	<section class="right-content">
		<?php if(!empty($category['image'])) { ?>
		<figure style="margin-bottom: 15px;line-height: 180%;">
			<img src="<?php echo $category['image'];?>" alt="<?php echo $category['title'];?>">
		</figure>
		<?php } ?>
		<?php if(!empty($category['description'])) { ?>
		<article class="cat-description" style="margin-bottom: 15px;line-height: 180%;">
			<?php echo $category['description'];?>
		</article>
		<?php } ?>
		<div class="category-social">
			<div class="button-special"><div class="fb-like" data-href="<?php echo isset($canonical)?$canonical:'';?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></div>
			<div class="button-special"><div class="fb-share-button" data-href="<?php echo isset($canonical)?$canonical:'';?>" data-type="button_count"></div></div>
			<div class="button-special"><div class="g-plus" data-action="share" data-annotation="bubble"></div></div>
			<div class="button-special"><div class="g-plusone" data-size="medium"></div></div>
			<div class="news-clear"></div>
		</div><!-- .social -->
		<?php if(isset($list) && count($list)) { foreach ($list  as $key => $val) { ?>
		<?php $category_item = helper_module_get_category_info('products_category', $val['parentid']); ?>
		<?php $url_normal = helper_string_alias($category_item['title']).'/'.helper_string_alias($val['title']).'-ap'.$val['id'].CMS_SUFFIX; ?>
		<?php $url = (!empty($val['url_config']))?helper_string_alias($category_item['title']).'/'.$val['url_config'].'-ap'.$val['id'].CMS_SUFFIX:$url_normal; ?>
			<section class="cate-ben-item">
				<figure class="ben-img-item">
					<a href="<?php echo $url;?>" title="<?php echo htmlspecialchars($val['title']);?>"><img class="ruoi-fiximg" src="template/plugins/timthumb.php?src=<?php echo htmlspecialchars($val['image']); ?>&w=235&h=290&zc=1&q=100"  alt="<?php echo htmlspecialchars($val['title']);?>" ></a>
				</figure>
				<h2 class="item-title"><a href="<?php echo $url;?>" title="<?php echo !empty($val['meta_title'])?htmlspecialchars($val['meta_title']):htmlspecialchars($val['title']);?>"><?php echo !empty($val['meta_title'])?htmlspecialchars($val['meta_title']):htmlspecialchars($val['title']);?></a></h2>
				<p class="luuy" style="height:30px;overflow:hidden;"><?php echo isset($val['luuy'])?htmlspecialchars(strip_tags($val['luuy'])):''; ?></p>
				<p class="price-km"><?php echo ($val['retail_price'] != 0)?number_format($val['retail_price']).' VNĐ':''; ?></p>
				<p class="price"><?php echo number_format($val['our_price']) ?> VNĐ</p>
			</section>
		<?php } } else { ?>
			<p class="empty">Chưa có sản phẩm nào phù hợp</p>
		<?php } ?>
		<?php echo (isset($pagination) && count($pagination) > 1)?'<div class="pagination">'.helper_string_pagination_frontend($pagination, $total_rows, $post_data['keyword']).'<div class="news-clear"></div></div><!-- .pagination -->':'';?>
	</section>
</section>

<script type="text/javascript">
$(window).load(function(){

  // Ruồi fix images
  $( ".ruoi-fiximg" ).each(function(){
    var imgheigt = $(this).height();
    var roundimgheight = $(this).parent().parent().height();
    margintop = (roundimgheight - imgheigt)/2;
    $(this).css("margin-top", margintop);
  });

});
</script>