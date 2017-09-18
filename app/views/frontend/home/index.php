<h1 class="index-hiden">BENRY HOMME - Chuyên áo măng tô nam, áo dạ nam Hàn Quốc</h1>
<section class="ben-content">
	<section class="new-box-content nbc-1">
		<a href="https://www.facebook.com/benryhomme/?pnref=story" title="Fanpage"><img src="template/frontend/images/00.jpg" alt="" /></a>
	</section>
	<section class="new-box-content nbc-2">
		<a href=""><img src="template/frontend/images/04.jpg" alt="" /></a>
	</section>
	<section class="new-box-content nbc-3">
		<a href="http://benryhomme.com/mua-dong-2016-ctl107.html" title="Lookbook"><img src="template/frontend/images/03.jpg" alt="" /></a>
	</section>
	<section class="new-box-content nbc-4">
		<a href=""><img src="template/frontend/images/01.jpg" alt="" /></a>
	</section>
	<section class="new-box-content nbc-5">
		<a href=""><img src="template/frontend/images/02.jpg" alt="" /></a>
	</section>
	
</section>
<section style="clear:both;"></section>
<section class="ben-content thuonghieu">
	<header>
		<h3>Thương hiệu</h3>
	</header>
	<?php $thuonghieu = helper_module_list_item('thuonghieu', '*', NULL, 'order asc,id desc',8); ?>
	<?php if(isset($thuonghieu) && count($thuonghieu)) { foreach ($thuonghieu  as $key => $val) { ?>
	<section class="imgthuonghieu">
		<a href="<?php echo helper_string_alias($val['title']).'-c'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><img src="<?php echo $val['image']; ?>" alt="<?php echo htmlspecialchars($val['title']);?>"></a>
	</section>
	<?php } } ?>
</section>
<section style="clear:both;"></section>
