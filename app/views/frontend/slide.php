<section class="ben-slider">
	<!--<section class="video">
		<iframe width="370" height="346" src="https://www.youtube.com/embed/<?php echo isset($this->system['video'])?htmlspecialchars($this->system['video']):NULL;?>" frameborder="0" allowfullscreen></iframe>
	</section>-->
	<section class="content-slide">
		<section class="flexslider">
			<ul class="slides">
			<?php $list = helper_module_list_item('slide_item', 'id, title, image, description', NULL, 'id desc', 13); if(isset($list) && count($list)){?>
			<?php foreach($list as $key => $val){ ?>
				<li><img src="template/plugins/timthumb.php?src=<?php echo htmlspecialchars($val['image']); ?>&w=970&h=600&zc=2&q=100" alt="<?php echo htmlspecialchars($val['title']);?>" /></li>
			<?php } } ?>
			</ul>
		</section>
	</section>
</section>