<section class="wrapper-breadcrumb">
	<section class="wrapper-breadcrumb-inner">
		<?php echo helper_module_bst_breadcrumb('bst_category', array('level >=' => 1, 'lft <=' => $category['lft'], 'rgt >=' => $category['rgt']), 'category');?>
	</section>
</section>
<section class="ben-content">
	
	<section class="top-content">
		<p class="title">Bộ sưu tập</p>
	</section>
	
	<section class="slider">
		<div id="slider" class="flexslider">
			<ul class="slides">
			<?php if(isset($list) && count($list)) { foreach($list as $key => $val) { ?>
				<li>
					<img src="<?php echo $val['image']; ?>" alt="<?php echo htmlspecialchars($val['title']);?>"/>
					<article class="text-slide">
					<?php echo $val['luuy']; ?>
					</article>
				</li>
			<?php } } ?>
			</ul>
		</div>
		<p class="slide-title"><?php echo $category['title']; ?></p>
		<div id="carousel" class="flexslider">
			<ul class="slides">
			<?php if(isset($list) && count($list)) { foreach($list as $key => $val) { ?>
				<li>
					<img src="<?php echo $val['image']; ?>" alt="<?php echo htmlspecialchars($val['title']);?>"/>
				</li>
			<?php } } ?>
			</ul>
		</div>
	</section>
</section>