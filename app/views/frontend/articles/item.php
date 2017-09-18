<section class="wrapper-breadcrumb">
	<section class="wrapper-breadcrumb-inner">
		<?php echo helper_module_breadcrumb('articles_category', array('level >=' => 1, 'lft <=' => $category['lft'], 'rgt >=' => $category['rgt']), 'item');?>	
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
		<h1 class="title" itemprop="name"><?php echo $item['title'];?></h1>
		<div class="info info-detail">Đăng ngày <span><?php $time = ($item['updated'] != '0000-00-00 00:00:00')?$item['updated']:$item['created']; echo gmdate('d/m/Y - h:i A', strtotime($time) + 7*3600)?></span> <?php if($user != NULL){ echo '| bởi <a rel="nofollow" href="'.$user['author'].'?rel=author" title="Trang cá nhân G+ của '.$user['fullname'].'" target="_blank"><span>'.$user['fullname'].'</span></a> | '; } ?>Lượt xem: <?php echo $item['viewed'];?></div>
		<div class="desc"><h2><?php echo ($item['description']);?></h2></div>
		<div class="news-clear"></div>
		
		<div class="news-clear"></div>
		<div class="content"><?php echo $item['content'];?></div>
		<?php $tags = helper_module_tags($item['tags']); echo !empty($tags)?'<div class="tags"><h3>Chủ đề:</h3>'.$tags.'<div class="news-clear"></div></div>':'';?>
		
		<div class="category-social">
			<div class="button"><div class="fb-like" data-href="<?php echo isset($canonical)?$canonical:'';?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></div>
			<div class="button"><div class="fb-share-button" data-href="<?php echo isset($canonical)?$canonical:'';?>" data-type="button_count"></div></div>
			<div class="button"><div class="g-plus" data-action="share" data-annotation="bubble"></div></div>
			<div class="button"><div class="g-plusone" data-size="medium"></div></div>
			<div class="button"><a title="Hot!" href="http://linkhay.com/submit"><img src="http://linkhay.com/templates/images/guide/button4.jpg" width="62" height="20" alt="Hot!" /></a></div>
			<div class="news-clear"></div>
		</div><!-- .social -->
		<div class="comment-social">
			<div class="fb-comments" data-href="<?php echo isset($canonical)?$canonical:'';?>" data-numposts="5" data-width="100%" data-colorscheme="light"></div>
			<!--
			<div class="g-comments" data-href = "<?php echo isset($canonical)?$canonical:'';?>" data-width = "600" data-first_party_property = "BLOGGER" data-view_type = "FILTERED_POSTMOD"></div>
			-->
		</div><!-- .comment-social -->
		<div class="news-clear"></div>
		
		<?php if(isset($same) && count($same)) {  ?>
		<h2 class="same-title">Bài viết liên quan</h2>
		<?php foreach($same as $key => $val) { $arr_id[] = $val['id'];?>
		<article class="item-same-news">
			<h2 class="title"><a href="<?php echo helper_string_alias($category['title']).'/'.helper_string_alias($val['title']).'-a'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><?php echo $val['title'];?></a> <span style="font-style:italic;color:#969696;">(<?php $time = ($val['updated'] != '0000-00-00 00:00:00')?$val['updated']:$val['created']; echo gmdate('d/m/Y - h:i A', strtotime($time) + 7*3600)?>)</span></h2>
		</article>
	
		<?php } } ?>
		
		
		
		<?php if(isset($list_noibat) && count($list_noibat)) {  ?>
		<h2 class="same-title">Bài viết nổi bật</h2>
		<?php foreach($list_noibat as $key => $val) { if(isset($arr_id) && (in_array($val['id'], $arr_id) == False)) { ?>
		<article class="item-same-news">
			<h2 class="title"><a href="<?php echo helper_string_alias($category['title']).'/'.helper_string_alias($val['title']).'-a'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><?php echo $val['title'];?></a> <span style="font-style:italic;color:#969696;">(<?php $time = ($val['updated'] != '0000-00-00 00:00:00')?$val['updated']:$val['created']; echo gmdate('d/m/Y - h:i A', strtotime($time) + 7*3600)?>)</span></h2>
		</article>
	
		<?php }else{ ?>
		<article class="item-same-news">
			<h2 class="title"><a href="<?php echo helper_string_alias($category['title']).'/'.helper_string_alias($val['title']).'-a'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><?php echo $val['title'];?></a> <span style="font-style:italic;color:#969696;">(<?php $time = ($val['updated'] != '0000-00-00 00:00:00')?$val['updated']:$val['created']; echo gmdate('d/m/Y - h:i A', strtotime($time) + 7*3600)?>)</span></h2>
		</article>
		<?php } } } ?>
	</section>
</section>