<div id="cms-tab">	<p class="title">Hệ thống hỗ trợ</p>	<ul class="main">		<li class="main"><a href="<?php echo CMS_BACKEND.'/support/item'.CMS_SUFFIX;?>" class="main">Quản lý hỗ trợ</a></li>		<li class="main"><a href="<?php echo CMS_BACKEND.'/support/additem'.CMS_SUFFIX;?>" class="main main-select">Thêm hỗ trợ mới</a></li>	</ul>	<div class="cms-clear"></div></div><!-- #cms-tab --><div id="cms-container">	<div id="cms-form">		<?php		$data['post_data'] = isset($post_data)?$post_data:NULL;		$data['button_action'] = '<input type="submit" name="add" value="Thêm hỗ trợ mới" class="button" />';		$this->load->view('backend/support/_formitem', $data);		?>		<div class="cms-clear"></div>	</div><!-- #cms-form -->	<div class="cms-clear"></div></div><!-- #cms-container -->