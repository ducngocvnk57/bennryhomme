<section class="wrapper-breadcrumb">
	<section class="wrapper-breadcrumb-inner">
		<?php echo helper_module_lockbook_breadcrumb('lockbook_category', array('level >=' => 1, 'lft <=' => $category['lft'], 'rgt >=' => $category['rgt']), 'item');?>	
	</section>
</section>
<section class="ben-content">
	
	<section class="items-lb-content">
		<figure>
			<img src="<?php echo $item['image'];?>" alt="<?php echo $item['title'];?>">
		</figure>
		<section class="des-item">
			<h1 class="title"><?php echo $item['title'];?></h1>
			<p class="cate-title">LOOKBOOK</p>
			<div class="category-social">
				<div class="button"><div class="fb-like" data-href="<?php echo isset($canonical)?$canonical:'';?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></div>
				<div class="button"><div class="fb-share-button" data-href="<?php echo isset($canonical)?$canonical:'';?>" data-type="button_count"></div></div>
				<div class="button"><div class="g-plus" data-action="share" data-annotation="bubble"></div></div>
				<div class="button"><div class="g-plusone" data-size="medium"></div></div>
				<div class="news-clear"></div>
			</div><!-- .social -->
			<div class="content-des-item">
				<?php echo ($item['description']);?>
			</div>
			
		</section>
	</section>
</section>