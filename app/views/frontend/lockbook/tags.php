<section class="wrapper-breadcrumb">
	<section class="wrapper-breadcrumb-inner">
		<ul class="breadcrumb">
			<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
				<a href="<?php echo CMS_URL;?>" title="Trang chủ" itemprop="url"><span itemprop="title">Trang chủ</span></a>
			</li>
			<li class="spacebar">&raquo;</li>
			<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
				<a href="<?php echo CMS_URL;?>chu-de<?php echo CMS_SUFFIX;?>" title="Chủ đề" itemprop="url"><span itemprop="title">Chủ đề</span></a>
			</li>
			<li class="spacebar">&raquo;</li>
			<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
				<h1>
					<a href="<?php echo 'tag/'.$tag['alias'].((isset($page) && $page > 0)?'-p'.($page+1):'').CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($tag['title']);?><?php echo (isset($page) && $page > 0)?' - Trang '.($page+1):'';?>" itemprop="url"><span itemprop="title"><?php echo $tag['title'];?></span></a>
				</h1>
			</li>
		</ul>
	</section>
</section>
<section class="ben-content">
	<section class="left-content">
		<h2 class="left-title">Danh mục sản phẩm</h2>
		<ul class="list-cate">
		<?php $list_dm01 =  helper_module_list_category('products_category', array('level' => 2), 'order asc, id asc',20); ?>
		<?php if(!empty($list_dm01)) { foreach ($list_dm01 as $key_01 => $val_01) {	?>
			<li><a href="<?php echo helper_string_alias($val_01['title']).'-cp'.$val_01['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val_01['title']);?>"><?php echo htmlspecialchars($val_01['title']);?></a>
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
	</section>
	<section class="right-content">
		<?php if(isset($list) && count($list)) { foreach($list as $key => $val) { ?>
			<article class="item-news">
				<figure><a href="<?php echo helper_string_alias($val['title']).'-a'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><img src="template/plugins/timthumb.php?src=<?php echo htmlspecialchars($val['image']); ?>&w=270&h=200&zc=1&q=100" title="<?php echo htmlspecialchars($val['title']);?>" alt="<?php echo htmlspecialchars($val['title']);?>" /></a></figure>
				<h2 class="title"><a href="<?php echo helper_string_alias($val['title']).'-a'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><?php echo $val['title'];?></a></h2>
				<?php $cat = helper_module_get_category_info('articles_category', $val['parentid']);?>
				<div class="info"><a rel="nofollow" href="<?php echo helper_string_alias($cat['title']).'-c'.$cat['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($cat['title']);?>"><?php echo $cat['title'];?></a><span> | Đăng ngày <?php $time = ($val['updated'] != '0000-00-00 00:00:00')?$val['updated']:$val['created']; echo gmdate('d/m/Y - h:i A', strtotime($time) + 7*3600)?> | Lượt xem: <?php echo $val['viewed'];?></span></div>
				<p class="content"><?php echo helper_string_cutnchar(strip_tags($val['description']), 250);?></p>
			</article>
		
		<?php } } ?>
		<?php echo (isset($pagination) && count($pagination) > 1)?'<div class="pagination">'.helper_string_pagination_frontend($pagination, $total_rows, isset($post_data['keyword'])?$post_data['keyword']:'').'<div class="news-clear"></div></div><!-- .pagination -->':'';?>
	</section>
</section>