<div id="cms-tab">	<p class="title">Hệ thống danh mục slide</p>	<ul class="main">		<li class="main"><a href="<?php echo CMS_BACKEND.'/slide/item'.CMS_SUFFIX;?>" class="main">Quản lý slide</a></li>		<li class="main"><a href="<?php echo CMS_BACKEND.'/slide/additem'.CMS_SUFFIX;?>" class="main">Thêm slide mới</a></li>	</ul>	<div class="cms-clear"></div></div><!-- #cms-tab --><div id="cms-container">	<div id="cms-form">		<?php		$data['post_data'] = isset($post_data)?$post_data:NULL;		$data['button_action'] = '<input type="submit" name="add" value="Thay đổi thông tin slide" class="button" />';		$this->load->view('backend/slide/_formitem', $data);		?>		<div class="cms-clear"></div>	</div><!-- #cms-form -->	<div class="cms-clear"></div></div><!-- #cms-container -->