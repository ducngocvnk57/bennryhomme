<section class="wrapper-breadcrumb">
	<section class="wrapper-breadcrumb-inner">
		<?php echo helper_module_lockbook_breadcrumb('lockbook_category', array('level >=' => 1, 'lft <=' => $category['lft'], 'rgt >=' => $category['rgt']), 'category');?>
	</section>
</section>
<section class="ben-content">
	
	<section class="top-content">
		<p class="title">LookBook</p>
	</section>
	
	<section class="inner-ben-content">
		<?php if(isset($list) && count($list)) { foreach ($list  as $key => $val) { ?>
		<?php $category_item = helper_module_get_category_info('products_category', $val['parentid']); ?>
		<?php $url_normal = helper_string_alias($category_item['title']).'/'.helper_string_alias($val['title']).'-tl'.$val['id'].CMS_SUFFIX; ?>
		<?php $url = (!empty($val['url_config']))?helper_string_alias($category_item['title']).'/'.$val['url_config'].'-tl'.$val['id'].CMS_SUFFIX:$url_normal; ?>
			<section class="inner-ben-item">
				<figure class="inner-img-item">
					<a href="<?php echo $url;?>" title="<?php echo htmlspecialchars($val['title']);?>"><img src="template/plugins/timthumb.php?src=<?php echo htmlspecialchars($val['image']); ?>&w=205&h=270&zc=2&q=100"  alt="<?php echo htmlspecialchars($val['title']);?>" ></a>
				</figure>
				<h2 class="inner-title"><a href="<?php echo $url;?>" title="<?php echo htmlspecialchars($val['title']);?>"><?php echo htmlspecialchars($val['title']);?></a></h2>
				<a href="<?php echo $url;?>" title="<?php echo htmlspecialchars($val['title']);?>"><img style="padding: 10px 0px 0px 0px;" src="template/frontend/images/btn_detail.png"></a>
				
			</section>
		<?php } } else { ?>
			<p class="empty">Chưa có sản phẩm nào phù hợp</p>
		<?php } ?>
		<?php echo (isset($pagination) && count($pagination) > 1)?'<div class="pagination">'.helper_string_pagination_frontend($pagination, $total_rows, $post_data['keyword']).'<div class="news-clear"></div></div><!-- .pagination -->':'';?>
	</section>
</section>