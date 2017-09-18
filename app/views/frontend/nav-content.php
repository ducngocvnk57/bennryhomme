

<!------------------ content ------------------------->
<section class="row-01 wrapper-news">
	<section class="row-01-inner wrapper-news-inner">	
		<section class="list-news">
			<article class="list-cate">
				<?php echo helper_module_menu(10);?>
			</article>
			<section class="main-news">
			<?php $list_all = helper_module_list_item('articles_item', '*', array('publish' => 1,'highlight' => 1), 'order asc, id desc',4); ?>
			<?php if(isset($list_all) && count($list_all)) { foreach ($list_all  as $key => $val) { if($key == 0) {?>
				<section class="first-news">
					<figure><a href="<?php echo 'tin-tuc/'.helper_string_alias($val['title']).'-a'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><img src="template/plugins/timthumb.php?src=<?php echo htmlspecialchars($val['image']); ?>&w=310&h=150&zc=1&q=100"  alt="<?php echo htmlspecialchars($val['title']);?>"></a></figure>
					<article class="info-news">
						<h2><a href="<?php echo 'tin-tuc/'.helper_string_alias($val['title']).'-a'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><?php echo htmlspecialchars($val['title']);?></a></h2>
						<p class="desc"><?php echo cutnchar($val['description'], 100);?></p>
					</article>
				</section>
			<?php } } } ?>
				<ul>
				<?php if(isset($list_all) && count($list_all)) { foreach ($list_all  as $key => $val) { if($key != 0) {?>
					<li>
						<figure><a href="<?php echo 'tin-tuc/'.helper_string_alias($val['title']).'-a'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><img src="template/plugins/timthumb.php?src=<?php echo htmlspecialchars($val['image']); ?>&w=150&h=75&zc=1&q=100"  alt="<?php echo htmlspecialchars($val['title']);?>"></a></figure>
						<h2><a href="<?php echo 'tin-tuc/'.helper_string_alias($val['title']).'-a'.$val['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val['title']);?>"><?php echo htmlspecialchars($val['title']);?></a></h2>
					</li>
				<?php } } } ?>
				</ul>
			</section>
		</section>
		<section class="contact-facebook">
			<h3>Tìm chúng tôi trên Facebook</h3>
			<article class="main-face">
				<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fthoitrangaloshop&amp;width=313&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:313px; height:258px;" allowTransparency="true"></iframe>
			</article>
		</section>
	</section>
</section>
<!----------------------------------------------------->