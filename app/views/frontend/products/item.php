<section class="wrapper-breadcrumb">
	<section class="wrapper-breadcrumb-inner">
		<?php echo helper_module_products_breadcrumb('products_category', array('level >=' => 1, 'lft <=' => $category['lft'], 'rgt >=' => $category['rgt']), 'item');?>
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
		<section class="top-right" style="position: relative;">
			<section class="slide-product" style="  width: 400px;float: left;margin-bottom: 75px; margin-left: 15px;">
				<section class="full-product">
					<div class="product-image" style="margin-left: 0;">
						<div id="jslidernews1" class="lof-slidecontent">
							<div class="preload"><div></div></div>
							<!-- MAIN CONTENT --> 
							<div class="main-slider-content">
								<ul class="sliders-wrap-inner">
								<?php $images = common_valuepost($item['images']);
									if(!empty($images)){ 
										$images = json_decode(base64_decode($item['images'])); 
										// print_r($images);die;
										if(isset($images) && count($images)){ 
										foreach($images as $key => $val){
								?>
									<li><img id="zoom_0<?php echo ($key + 1); ?>" src="template/plugins/timthumb.php?src=<?php echo (isset($images[$key])?$images[$key]:NULL);?>&w=400&h=400&zc=2&q=100" data-zoom-image="<?php echo (isset($images[$key])?$images[$key]:NULL);?>"></li>
								<?php } } } ?>
								</ul>  	
							</div>
							<!-- END MAIN CONTENT --> 
							<!-- NAVIGATOR -->
							<?php $images = common_valuepost($item['images']);
								if(!empty($images)){ 
									$images = json_decode(base64_decode($item['images'])); 
									// print_r(count($images));die;
							?>
							<div class="navigator-content" <?php if(count($images) == 4){echo 'style="right:70px !important;"';}elseif(count($images) == 3){echo 'style="right:100px !important;"';} ?>>
								<div class="button-next"></div>
								<div class="navigator-wrapper">
									<ul class="navigator-wrap-inner">
									<?php
											if(isset($images) && count($images)){ 
											foreach($images as $key => $val){
									?>
										<li><img src="<?php echo (isset($images[$key])?$images[$key]:NULL);?>"></li>
									<?php } } ?>
									</ul>
								</div>
								<div  class="button-previous"></div>
							</div> 
							<?php } ?>
						<!----------------- END OF NAVIGATOR --------------------->                
						</div>
					</div>
					<script type="text/javascript">
						$(document).ready(function () {
							// buttons for next and previous item
							var buttons = {
								previous: $('#jslidernews1 .button-previous'),
								next: $('#jslidernews1 .button-next')
							};
							$('#jslidernews1').lofJSidernews({
								interval: 4000,
								direction: 'opacity',
								easing: 'easeInOutQuad',
								duration: 400,
								auto: true,
								maxItemDisplay: 5,
								mobile: false,
								navPosition: 'horizontal', // horizontal
								navigatorHeight: 50,
								navigatorWidth: 60,
								mainWidth: 400,
								buttons: buttons,
								onComplete: function () {
									slider_nav_margin();
								}
							});
						});
					</script>
				</section>	
			</section>
			<!--<figure class="image-top-right">
			<img src="<?php echo $item['image'];?>" alt="<?php echo htmlspecialchars($item['title']);?>">
			</figure>-->
			<section class="info">
				<section class="product-info">
					<h1><?php echo htmlspecialchars($item['title']);?></h1>
					<div class="special"></div>
					<hr>
					<?php if($item['retail_price'] != 0) { ?>
					<p class="old-price">Giá gốc: <?php echo number_format($item['retail_price']);?><sup>đ</sup> ( - <?php echo round(($item['retail_price'] - $item['our_price'])/$item['retail_price']*100); ?>%)</p>
					<?php } ?>
					<p class="new-price"><?php echo number_format($item['our_price']);?><sup>đ</sup></p>
					
					<div class="size-products" style="margin:10px 0px;">
						<p style="float: left;margin-right: 10px;line-height: 25px;width: 50px;">Size : </p>
						<select class="size-select" name="data[size]" style="padding: 3px;width: 150px;">
							<option value="Free size">-- Chọn Size --</option>
							
							<?php if(!empty($item['size_product'])) { $arr_color = explode("-", $item['size_product']);
							// print_r($arr_color);die;
							for($i = 0; $i < count($arr_color); $i++) { ?>
								<?php echo '<option value="'.$arr_color[$i].'">'.$arr_color[$i].'</option>'; ?>
							<?php } }else{ ?>
								<option value="Free Color">Free Size</option>
							<?php } ?>
							
						</select>
					</div>
					<div class="size-products" style="margin:10px 0px 20px 0px;">
						<p style="float: left;margin-right: 10px;line-height: 25px;width: 50px;">Màu : </p>
						<select class="size-select" name="data[color]" style="padding: 3px;width: 150px;">
							<option value="Free Color">-- Chọn Màu --</option>
							
							<?php if(!empty($item['color_product'])) { $arr_color = explode("-", $item['color_product']);
							// print_r($arr_color);die;
							for($i = 0; $i < count($arr_color); $i++) { ?>
								<?php echo '<option value="'.$arr_color[$i].'">'.$arr_color[$i].'</option>'; ?>
							<?php } }else{ ?>
								<option value="Free Color">Free Color</option>
							<?php } ?>
							
						</select>
					</div>
					
					<p class="bought"><a href="frontend/products/addtocart/<?php echo $item['id'].CMS_SUFFIX ;?>?redirect=<?php echo base64_encode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);?>" title="Đặt hàng">Đặt hàng</a></p>
					<article class="description_item">
						<?php echo ($item['description']);?>
					</article>
					<div class="buy-hotline"><span style="color:#333;">Hotline : </span>0945 076 662</div>
				</section>
			</section>
		</section>
		<section class="center-right" style="width: 100%;float: left;"> 
			<?php if (empty($item['content']) && !empty($images)) { ?>
				<ul class="listimg">
				<?php if(!empty($images)){ 
						$images = json_decode(base64_decode($item['images'])); 
						// print_r($images);die;
						if(isset($images) && count($images)){ 
						foreach($images as $key => $val){
				?>
					<li><img src="<?php echo (isset($images[$key])?$images[$key]:NULL);?>" alt="<?php echo htmlspecialchars($item['title']).'-'.$key;?>" ></li>
				<?php } } } ?>
				</ul>  	
			<?php }else{ echo ($item['content']); } ?>
		</section>
		<section class="bottom-right">
			
			<div class="category-social">
				<div class="button-special"><div class="fb-like" data-href="<?php echo isset($canonical)?$canonical:'';?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></div>
				<div class="button-special"><div class="fb-share-button" data-href="<?php echo isset($canonical)?$canonical:'';?>" data-type="button_count"></div></div>
				<div class="button-special"><div class="g-plus" data-action="share" data-annotation="bubble"></div></div>
				<div class="button-special"><div class="g-plusone" data-size="medium"></div></div>
				<div class="news-clear"></div>
			</div><!-- .social -->
		</section>
		<div class="comment-social">
			<div class="fb-comments" data-href="<?php echo isset($canonical)?$canonical:'';?>" data-numposts="5" data-width="100%" data-colorscheme="light"></div>
			<!--
			<div class="g-comments" data-href = "<?php echo isset($canonical)?$canonical:'';?>" data-width = "600" data-first_party_property = "BLOGGER" data-view_type = "FILTERED_POSTMOD"></div>
			-->
		</div><!-- .comment-social -->
		<?php if(isset($same) && count($same)) { foreach ($same  as $key => $val) { $du = ($key + 1)%3; ?>
		<?php $category_item = helper_module_get_category_info('products_category', $val['parentid']); ?>
		<?php $url_normal = helper_string_alias($category_item['title']).'/'.helper_string_alias($val['title']).'-ap'.$val['id'].CMS_SUFFIX; ?>
		<?php $url = (!empty($val['url_config']))?helper_string_alias($category_item['title']).'/'.$val['url_config'].'-ap'.$val['id'].CMS_SUFFIX:$url_normal; ?>
		
			<section class="cate-ben-item" style="<?php echo ($du == 0)?'margin-right: 0px;':'margin-right: 10px;'; ?>">
				<figure class="ben-img-item">
					<a href="<?php echo $url;?>" title="<?php echo htmlspecialchars($val['title']);?>"><img src="template/plugins/timthumb.php?src=<?php echo htmlspecialchars($val['image']); ?>&w=235&h=290&zc=1&q=100"  alt="<?php echo htmlspecialchars($val['title']);?>" ></a>
				</figure>
				<h3 class="item-title"><a href="<?php echo $url;?>" title="<?php echo htmlspecialchars($val['title']);?>"><?php echo htmlspecialchars($val['title']);?></a></h3>
				<p class="price-km"><?php echo ($val['retail_price'] != 0)?number_format($val['retail_price']).' VNĐ':''; ?></p>
				<p class="price"><?php echo number_format($val['our_price']) ?> VNĐ</p>
			</section>
		<?php } } ?>
	</section>
</section>