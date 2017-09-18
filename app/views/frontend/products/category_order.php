<section class="row-01 wrapper-breadcrumb">
	<section class="wrapper-breadcrumb-inner">
		<section class="contact">
			<p class="hotline"><?php echo isset($this->system['hotline_top'])?($this->system['hotline_top']):NULL;?></p>
		<?php $list_support = helper_module_list_contact('support_item', array('parentid' => 2), 'id desc', 4);
		if(isset($list_support) && count($list_support)){ foreach($list_support as $keyMain => $valMain){ ?>
			<p class="yahoo">
				<a href="ymsgr:sendim?<?php echo $valMain['yahoo']?$valMain['yahoo']:''; ?>" style="font-family: 'OpenSans-Bold';color: #333;"><img class="yahoo-icon" src="http://opi.yahoo.com/online?u=<?php echo $valMain['yahoo']?$valMain['yahoo']:''; ?>&amp;t=5" org-src="http://opi.yahoo.com/online?u=<?php echo $valMain['yahoo']?$valMain['yahoo']:''; ?>&amp;t=5" alt="" style="vertical-align: -1px;margin-right: 4px;"><?php echo $valMain['title']?$valMain['title']:''; ?></a>
			</p>
		<?php } } ?>
		</section>
	</section>	
</section>
<!----------------------------------------------------->

<!------------------ BANNER ------------------------->
<section class="row-01 wrapper-banner">
	<?php echo isset($this->system['banner01'])?($this->system['banner01']):NULL;?>
</section>
<!----------------------------------------------------->

<!------------------ content ------------------------->
<section class="row-01 wrapper-content">
	<section class="row-01-inner wrapper-content-inner">	
		<section class="main-content detail-main-content">
			<h2 style="margin-bottom:10px;">Sản phẩm mới</h2>
			<ul class="list-product">
			<?php if(isset($item) && count($item)) { foreach ($item  as $key => $val) {
				$cateid = helper_module_get_item_info('products_category', $val['parentid']);
			?>
				<li>
					<figure>
						<?php if($val['hotted'] == 1){ ?>
						<p class="hot">Mẫu mới</p>
						<?php } ?>
						<a href="<?php echo helper_string_alias($cateid['title']).'/'.helper_string_alias($val['title']).'-ap'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><img src="template/plugins/timthumb.php?src=<?php echo htmlspecialchars($val['image']); ?>&w=317&h=317&zc=1&q=100"  alt="<?php echo htmlspecialchars($val['title']);?>" ></a>
						<article class="pro-info">
							<p class="view"><?php echo htmlspecialchars($val['viewed']);?> lượt xem</p>
							<p class="bought"><?php echo htmlspecialchars($val['bought']);?> lượt mua</p>
						</article>
					</figure>
					<article class="detail-product">
						<h2><a href="<?php echo helper_string_alias($cateid['title']).'/'.helper_string_alias($val['title']).'-ap'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><?php echo htmlspecialchars($val['title']);?></a></h2>
						<p><span style="font-weight:bold;color:#ed1c24;margin-right:10px;"><?php echo number_format($val['our_price']);?> VNĐ</span>  <span style="text-decoration: line-through;"><?php echo number_format($val['retail_price']);?> VNĐ</span></p>
						<a href="<?php echo helper_string_alias($cateid['title']).'/'.helper_string_alias($val['title']).'-ap'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><img src="template/frontend/images/icon/amore.png"></a>
					</article>
				</li>
			<?php } } ?>
			</ul>
		</section>
		
	</section>
</section>
<!----------------------------------------------------->