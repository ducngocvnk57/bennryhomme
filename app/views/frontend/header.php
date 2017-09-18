<header class="ben-header">
	<section class="top-header">
		<!--<a href="<?php echo isset($this->system['link_facebook'])?htmlspecialchars($this->system['link_facebook']):NULL;?>" target="_blank"><img style="float: left;margin-top: 11px;" src="template/frontend/images/btn_facebook01.png" alt="facebook" class="facebook"></a>-->
		<?php if(!empty($this->system['hotline_top_2'])) { ?>
		<p style="font-size: 13px;font-family: 'Times New Roman', Georgia, Serif;font-weight: bold;font-style: italic;float: right;line-height: 40px;margin: 0px 0px 0px 50px;">SEOUL - KOREA : <?php echo isset($this->system['hotline_top_2'])?htmlspecialchars($this->system['hotline_top_2']):NULL;?></p>
		<?php } ?>
		<?php if(!empty($this->system['hotline_top'])) { ?>
		<p style="font-size: 13px;font-family: 'Times New Roman', Georgia, Serif;font-weight: bold;font-style: italic;float: right;line-height: 40px;margin: 0px 50px;">HÀ NỘI - VIỆT NAM : <?php echo isset($this->system['hotline_top'])?htmlspecialchars($this->system['hotline_top']):NULL;?></p>
		<?php } ?>
		
		<section class="logo">
			<a href="<?php echo CMS_URL;?>" title="<?php echo isset($this->system['meta_title'])?htmlspecialchars($this->system['meta_title']):NULL;?>"><img src="<?php echo $this->system['logo']; ?>" title="<?php echo isset($this->system['meta_title'])?htmlspecialchars($this->system['meta_title']):NULL;?>" alt="<?php echo isset($this->system['meta_title'])?htmlspecialchars($this->system['meta_title']):NULL;?>"/></a>
		</section>
	</section>
	<nav class="menu navigation" id="kun-nav-responsive">
		<ul class="main">
			<li class="main"><a href="http://benryhomme.com/chien-dich-cb103.html" title="Chiến dịch" class="main">Chiến dịch</a>
				<ul class="item">
					<?php $list_ab03 =  helper_module_list_category('bst_category', array('parentid' => 103), 'order asc, id asc',20); ?>
					<?php if(!empty($list_ab03)) { foreach ($list_ab03 as $key_01 => $val_01) {	?>
						<li class="item"><a class="item" href="<?php echo helper_string_alias($val_01['title']).'-cb'.$val_01['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val_01['title']);?>"><?php echo htmlspecialchars($val_01['title']);?></a>
						</li>
					<?php } }  ?>
				</ul>
			</li>
			<li class="main"><a href="http://benryhomme.com/lookbook-ctl103.html" title="Lookbook" class="main">Lookbook</a>
				<ul class="item">
					<?php $list_ab03 =  helper_module_list_category('lockbook_category', array('parentid' => 103), 'order asc, id asc',20); ?>
					<?php if(!empty($list_ab03)) { foreach ($list_ab03 as $key_01 => $val_01) {	?>
						<li class="item"><a class="item" href="<?php echo helper_string_alias($val_01['title']).'-ctl'.$val_01['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val_01['title']);?>"><?php echo htmlspecialchars($val_01['title']);?></a>
						</li>
					<?php } }  ?>
				</ul>
			</li>
			<li class="main center">
				<a href="san-pham-cp89.html" title="Sản phẩm" class="main">Sản phẩm Online</a>
				<ul class="item">
				<?php $list_dm01 =  helper_module_list_category('products_category', array('level' => 2), 'order asc, id asc',20); ?>
				<?php if(!empty($list_dm01)) { foreach ($list_dm01 as $key_01 => $val_01) {	?>
					<li class="item"><a class="item" href="<?php echo helper_string_alias($val_01['title']).'-cp'.$val_01['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val_01['title']);?>"><?php echo htmlspecialchars($val_01['title']);?></a>
						<?php if($val_01['rgt'] - $val_01['lft'] != 1) { ?>
							<ul class="sub-item">
							<?php $list_dm02 =  helper_module_list_category('products_category', array('parentid' => $val_01['id']), 'order asc, id asc',20); ?>
							<?php if(!empty($list_dm02)) { foreach ($list_dm02 as $key_02 => $val_02) {	?>
							<li class="sub-item"><a class="sub-item" href="<?php echo helper_string_alias($val_02['title']).'-cp'.$val_02['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val_02['title']);?>"><?php echo htmlspecialchars($val_02['title']);?></a></li>
							<?php } }  ?>
							</ul>
						<?php } ?>
					</li>
				<?php } }  ?>
				</ul>
			</li>
			<li class="main"><a href="cua-hang-c37.html" title="Cửa hàng" class="main">Cửa hàng</a>
				<ul class="item">
					<?php $list_ar04 =  helper_module_list_category('articles_category', array('parentid' => 37), 'order asc, id asc',20); ?>
					<?php if(!empty($list_ar04)) { foreach ($list_ar04 as $key_01 => $val_01) {	?>
						<li class="item"><a class="item" href="<?php echo helper_string_alias($val_01['title']).'-c'.$val_01['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val_01['title']);?>"><?php echo htmlspecialchars($val_01['title']);?></a>
						</li>
					<?php } }  ?>
				</ul>
			</li>
			<li class="main"><a href="nguoi-noi-tieng-c58.html" title="Cửa hàng" class="main">Người nổi tiếng</a>
				<ul class="item">
					<?php $list_ar111 =  helper_module_list_category('articles_category', array('parentid' => 58), 'order asc, id asc',20); ?>
					<?php if(!empty($list_ar111)) { foreach ($list_ar111 as $key_01 => $val_01) {	?>
						<li class="item"><a class="item" href="<?php echo helper_string_alias($val_01['title']).'-c'.$val_01['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val_01['title']);?>"><?php echo htmlspecialchars($val_01['title']);?></a>
						</li>
					<?php } }  ?>
				</ul>
			</li>
			<!--
			<li class="main">
				<a href="bo-suu-tap-c48.html" title="Bộ sưu tập" class="main">Bộ sưu tập</a>
				<ul class="item">
					<?php $list_ar03 =  helper_module_list_category('articles_category', array('parentid' => 48), 'order asc, id asc',20); ?>
					<?php if(!empty($list_ar03)) { foreach ($list_ar03 as $key_01 => $val_01) {	?>
						<li class="item"><a class="item" href="<?php echo helper_string_alias($val_01['title']).'-c'.$val_01['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val_01['title']);?>"><?php echo htmlspecialchars($val_01['title']);?></a>
						</li>
					<?php } }  ?>
				</ul>
			</li>
			<li class="main">
				<a href="phong-cach-benry-c35.html" title="Phong cách Benry" class="main">Phong cách Benry</a>
				<ul class="item">
					<?php $list_ar01 =  helper_module_list_category('articles_category', array('parentid' => 35), 'order asc, id asc',20); ?>
					<?php if(!empty($list_ar01)) { foreach ($list_ar01 as $key_01 => $val_01) {	?>
						<li class="item"><a class="item" href="<?php echo helper_string_alias($val_01['title']).'-c'.$val_01['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val_01['title']);?>"><?php echo htmlspecialchars($val_01['title']);?></a>
						</li>
					<?php } }  ?>
				</ul>
			</li>-->
			<li class="main"><a href="tin-tuc-c52.html" title="Tin tức" class="main">Tin tức</a></li>
			<!--<li class="main"><a href="contacts.html" title="Contacts" class="main">Liên hệ</a></li>-->
		</ul>
	</nav>
	<section class="banner-logo">
		<section class="logo-f">
			<a href="http://benryhomme.com/" title="Benry Style"><img src="/upload/image/he-thong/logonews(1).png" title="Benry Style" alt="Benry Style"></a>
		</section>
		<button type="button" class="navbar-toggle" id="kun-navbar-responsive">
			<i class="fa fa-bars"></i>
		</button>
	</section>
</header>
<script type="text/javascript">
$(document).ready(function() {

	var _temp;

	/* KUN-NAV-RESPONSIVE */
	$('#kun-nav-responsive a.main').each(function(index){
		_temp = $(this).next('ul.item');
		if(_temp.length >= 1){
			$(this).find('i.main-arrow').css({'display':'inline-block'});
		}
	});
	$('#kun-navbar-responsive').click(function(){
		$('#kun-nav-responsive').toggleClass('navigation-show');
	});
	$('#kun-nav-responsive a.main').click(function(){
		if($('#kun-navbar-responsive').is(':hidden') == false){
			_temp = $(this).next('ul.item');
			if(_temp.length >= 1){
				_temp.slideToggle('fast', function(){});
				return false;
			}
		}
	});

});
</script>