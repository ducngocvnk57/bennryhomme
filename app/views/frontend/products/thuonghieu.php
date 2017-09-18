<section class="wrapper-breadcrumb">
	<section class="wrapper-breadcrumb-inner">
		<ul class="breadcrumb">
			<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a rel="nofollow" href="http://dev.itq.vn/levananh/caycanh/" title="Home" itemprop="url"><span itemprop="title">Home</span></a></li><li class="spacebar">»</li>
			<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><h2><a href="products-cp89.html" title="Products" itemprop="url"><span itemprop="title">Products</span></a></h3></li><li class="spacebar">»</li>
			<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><h1><a href="quan-jeans-cp79.html" title="Quần jeans" itemprop="url"><span itemprop="title">Quần jeans</span></a></h1></li></ul>
	</section>
</section>
<section class="ben-content">
	<section class="left-content">
		<h2 class="left-title">Danh mục sản phẩm</h2>
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
		
		<h2 class="left-title">Chọn thương hiệu</h2>
		<ul class="list-cate">
		<?php $list_th =  helper_module_list_category('thuonghieu', array('publish' => 1), 'order asc, id asc',20); ?>
		<?php if(!empty($list_th)) { foreach ($list_th as $key => $val) {	?>
			<li class="list-cate"><a href="<?php echo helper_string_alias($val['title']).'-th'.$val['id'].CMS_SUFFIX;?>" title="<?php echo $val['title']; ?>"><?php echo $val['title']; ?></a></li>
		<?php } }  ?>
		</ul>
	</section>
	<section class="right-content">
		<?php if(isset($list) && count($list)) { foreach ($list  as $key => $val) { ?>
			<section class="cate-ben-item">
				<figure class="ben-img-item">
					<a href="<?php echo helper_string_alias($val['title']).'-ap'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><img src="template/plugins/timthumb.php?src=<?php echo htmlspecialchars($val['image']); ?>&w=205&h=270&zc=1&q=100"  alt="<?php echo htmlspecialchars($val['title']);?>" ></a>
				</figure>
				<h3 class="item-title"><a href="<?php echo helper_string_alias($val['title']).'-ap'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><?php echo htmlspecialchars($val['title']);?></a></h3>
				<p class="price-km"><?php echo number_format($val['retail_price']) ?> VNĐ</p>
				<p class="price"><?php echo number_format($val['our_price']) ?> VNĐ</p>
			</section>
		<?php } } else { ?>
			<p class="empty">Chưa có sản phẩm nào phù hợp</p>
		<?php } ?>
		<?php echo (isset($pagination) && count($pagination) > 1)?'<div class="pagination">'.helper_string_pagination_frontend($pagination, $total_rows, $post_data['keyword']).'<div class="news-clear"></div></div><!-- .pagination -->':'';?>
	</section>
</section>