<div id="cms-tab">	<p class="title">Hệ thống quản lý thương hiệu</p>	<ul class="main">		<li class="main"><a href="<?php echo CMS_BACKEND.'/thuonghieu/index'.CMS_SUFFIX;?>" class="main">Quản lý thương hiệu</a></li>		<li class="main"><a href="<?php echo CMS_BACKEND.'/thuonghieu/add'.CMS_SUFFIX;?>" class="main main-select">Thêm thương hiệu mới</a></li>	</ul>	<div class="cms-clear"></div></div><!-- #cms-tab --><div id="cms-container">	<div id="cms-form">		<?php		$data['post_data'] = isset($post_data)?$post_data:NULL;		$data['button_action'] = '<input type="submit" name="add" value="Thêm thương hiệu mới" class="button" />';		$this->load->view('backend/thuonghieu/_form', $data);		?>		<div class="cms-clear"></div>	</div><!-- #cms-form -->	<div class="cms-clear"></div></div><!-- #cms-container -->