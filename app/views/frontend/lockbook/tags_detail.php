<div class="itq-content-right">
	<div class="block">
		<div class="main-title">
			<ul class="breadcrumb">
				<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="<?php echo CMS_URL;?>" title="Trang chủ" itemprop="url"><span itemprop="title">Trang chủ</span></a>
				</li>
				<li class="spacebar">&raquo;</li>
				<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
					<h1>
					<a href="<?php echo 'chu-de'.((isset($page) && $page > 0)?'-p'.($page+1):'').CMS_SUFFIX;?>" title="Chủ đề<?php echo (isset($page) && $page > 0)?' - Trang '.($page+1):'';?>" itemprop="url"><span itemprop="title">Chủ đề</span></a>
					</h1>
				</li>
			</ul>
		</div>
		<div class="container">
			<div class="category-social">
				<div class="button"><div class="fb-like" data-href="<?php echo isset($canonical)?$canonical:'';?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></div>
				<div class="button"><div class="fb-share-button" data-href="<?php echo isset($canonical)?$canonical:'';?>" data-type="button_count"></div></div>
				<div class="button"><div class="g-plus" data-action="share" data-annotation="bubble"></div></div>
				<div class="button"><div class="g-plusone" data-size="medium"></div></div>
				<div class="news-clear"></div>
			</div><!-- .social -->
			<?php if(isset($list) && count($list)){ foreach($list as $key => $val){ ?>
			<div class="item-tags">
				<a href="chu-de/<?php echo $val['alias'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><?php echo $val['title'];?></a>
				<div class="news-clear"></div>
			</div><!-- .item -->
			<?php } } else { ?>
			<div class="empty-list"><p>Hiện tại không có chủ đề trong chuyên mục này!</p></div><!-- .empty-list -->
			<?php } ?>
			<?php echo (isset($pagination) && count($pagination) > 1)?'<div class="pagination">'.helper_string_pagination_frontend($pagination, $total_rows).'<div class="news-clear"></div></div><!-- .pagination -->':'';?>
			<div class="news-clear"></div>
		</div>
	</div><!-- .block -->
</div><!-- .vv-container -->