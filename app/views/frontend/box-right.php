<section class="box-right">
	<h3 class="box-right-title"><span>Danh mục sản phẩm</span></h3>
	
	<ul class="list-product">
		<?php $list_catepro = helper_module_list_category('products_category' , array('level' => 1, 'publish' => 1),'order asc, id desc'); ?>
		<?php if(isset($list_catepro) && count($list_catepro)) { foreach($list_catepro as $key => $val) { ?>
		<li><figure><a href="<?php echo helper_string_alias($val['title']).'-cp'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><img src="<?php echo htmlspecialchars($val['image']);?>" alt="<?php echo htmlspecialchars($val['title']);?>"></a></figure></li>
		<?php } } ?>
	</ul>
	<h3 class="box-right-title"><span>Tin tức - sự kiện</span></h3>
	<ul class="list-news">
		<?php $list_tintuc = helper_module_list_item('articles_item', '*', array('parentid' => 20), 'order asc, id desc', 4); ?>
		<?php if(isset($list_tintuc) && count($list_tintuc)) { foreach ($list_tintuc  as $key => $val) {  ?>
		<li>
			<figure><a href="<?php echo helper_string_alias($val['title']).'-a'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><img src="<?php echo htmlspecialchars($val['image']);?>" alt="<?php echo htmlspecialchars($val['title']);?>"></a></figure>
			<h4 class="title-list-news"><?php echo htmlspecialchars($val['title']);?></h4>
			<article class="desc">
				<?php echo cutnchar($val['description'], 100);?>
			</article>
			<a class="more" href="<?php echo helper_string_alias($val['title']).'-a'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>">Xem thêm</a>
		</li>
		<?php } } ?>
	</ul>
	<h3 class="box-right-title"><span>Fanpage</span></h3>
	<ul class="list-news">
		<li><iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FM%25E1%25BB%25B9-ph%25E1%25BA%25A9m-l%25C3%25A0m-%25C4%2591%25E1%25BA%25B9p-A-Z%2F899943740022440&amp;width=278&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:278px; height:290px;" allowTransparency="true"></iframe></li>
	</ul>
</section>