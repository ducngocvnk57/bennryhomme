<section class="article">
	<section class="promo-content clearfix">
		<ul class="breadcrumb"><li itemscope="" style="color: #476d94;text-decoration: none;font-size: 16px;font-weight: normal;" itemtype="http://data-vocabulary.org/Breadcrumb"><?php echo $meta_title; ?></li></ul>
	</section>
	<section class="two-columns">
		<section class="two-columns-frame">
			<section class="two-columns-wrap">
				<section class="sub-content clearfix">
					
					<!-- TEMPLATE -->
					<section class="content-part clearfix">
					
						<!-- LIST-PRODUCTS-->
						<section class="catalog-list clearfix">
						
							
							<div class="category-social">
								<div class="button-special"><div class="fb-like" data-href="<?php echo isset($canonical)?$canonical:'';?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></div>
								<div class="button-special"><div class="fb-share-button" data-href="<?php echo isset($canonical)?$canonical:'';?>" data-type="button_count"></div></div>
								<div class="button-special"><div class="g-plus" data-action="share" data-annotation="bubble"></div></div>
								<div class="button-special"><div class="g-plusone" data-size="medium"></div></div>
								<div class="news-clear" style="clear-both;"></div>
							</div><!-- .social -->
							
							<ul>
							<?php if(isset($list) && count($list)){ foreach($list as $key => $val){ ?>
							<?php if(count($list) == 1){ ?>
							<script type="text/javascript">
							window.location = '<?php echo helper_string_alias($val['title']).'-ap'.$val['id'].CMS_SUFFIX;?>';
							</script>
							<?php } ?>
								<!------->
								<li>
									<div class="pict">
										<table>
											<tbody>
												<tr>
													<td>
														<a href="<?php echo helper_string_alias($val['title']).'-ap'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><div style="position:relative;left:0; top:0;"><img src="template/plugins/timthumb.php?src=<?php echo htmlspecialchars($val['image']); ?>&w=158&h=170&zc=1&q=100" title="<?php echo htmlspecialchars($val['title']);?>" alt="<?php echo htmlspecialchars($val['title']);?>" style="position:relative;top:5px;left:0;"><?php if(!empty($val['price'])) { ?><img src="template/frontend/images/saleBanner.png" style="position:absolute;top:5px; left:5px;"><?php } ?></div></a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<strong class="title3"><a href="<?php echo helper_string_alias($val['title']).'-ap'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><?php echo htmlspecialchars($val['title']);?></a></strong>
									<p class="ref2">BAGLECO.01.904L</p>
									<p class="retail-price2">Retail Price: <?php echo number_format($val['retail_price']);?> VNĐ</p>
									<p class="your-cost2">Our Price: <strike><?php echo number_format($val['our_price']);?> VNĐ</strike><br><b>Sale Price: <?php echo number_format($val['price']);?> VNĐ</b></p>
									<a class="button btn-buy2" href="<?php echo helper_string_alias($val['title']).'-ap'.$val['id'].CMS_SUFFIX;?>"><span>view details</span></a>
								</li>
								<!------->
							<?php } } else { ?>
							<div class="empty-list"><p>Hiện tại không có sản phẩm trong chuyên mục này!</p></div><!-- .empty-list -->
							<?php } ?>
							<?php echo (isset($pagination) && count($pagination) > 1)?'<div class="pagination">'.helper_string_pagination_frontend($pagination, $total_rows, $post_data['keyword']).'<div class="news-clear"></div></div><!-- .pagination -->':'';?>
							</ul>
						</section>
						<!-- LIST-PRODUCTS-->
					<section style="clear-both;"></section>
					</section>
					<!--- TEMPLATE -->
					
				</section>
			</section>
		</section>
	</section>
</section>