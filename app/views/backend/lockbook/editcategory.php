<div id="cms-tab">	<p class="title">Hệ thống danh mục lockbook</p>	<ul class="main">		<li class="main"><a href="<?php echo CMS_BACKEND.'/lockbook/category'.CMS_SUFFIX;?>" class="main">Quản lý danh mục lockbook</a></li>		<li class="main"><a href="<?php echo CMS_BACKEND.'/lockbook/addcategory'.CMS_SUFFIX;?>" class="main">Thêm danh mục lockbook mới</a></li>	</ul>	<div class="cms-clear"></div></div><!-- #cms-tab --><div id="cms-container">	<div id="cms-form">		<?php		$data['post_data'] = isset($post_data)?$post_data:NULL;		$data['button_action'] = '<input type="submit" name="add" value="Thay đổi thông tin danh mục lockbook" class="button" />';		$this->load->view('backend/lockbook/_formcategory', $data);		?>		<div class="cms-clear"></div>	</div><!-- #cms-form -->	<div class="cms-clear"></div></div><!-- #cms-container -->