<div id="cms-tab">	<p class="title">Hệ thống danh mục bộ sưu tập</p>	<ul class="main">		<li class="main"><a href="<?php echo CMS_BACKEND.'/bst/category'.CMS_SUFFIX;?>" class="main">Quản lý danh mục bộ sưu tập</a></li>		<li class="main"><a href="<?php echo CMS_BACKEND.'/bst/addcategory'.CMS_SUFFIX;?>" class="main">Thêm danh mục bộ sưu tập mới</a></li>	</ul>	<div class="cms-clear"></div></div><!-- #cms-tab --><div id="cms-container">	<div id="cms-form">		<?php		$data['post_data'] = isset($post_data)?$post_data:NULL;		$data['button_action'] = '<input type="submit" name="add" value="Thay đổi thông tin danh mục bộ sưu tập" class="button" />';		$this->load->view('backend/bst/_formcategory', $data);		?>		<div class="cms-clear"></div>	</div><!-- #cms-form -->	<div class="cms-clear"></div></div><!-- #cms-container -->