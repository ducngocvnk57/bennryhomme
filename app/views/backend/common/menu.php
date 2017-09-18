<ul class="main">
	<li class="main">
		<a href="<?php echo CMS_BACKEND;?>" class="main" id="menu-home">Trang chủ</a>
		<ul class="item">
			<?php if($this->auth['group'] == 'Người quản lý'){ ?>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/system/index'.CMS_SUFFIX;?>" class="item">Cấu hình hệ thống</a></li>
			<?php } ?>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/authentication/logout'.CMS_SUFFIX;?>" class="item">Đăng xuất</a></li>
		</ul>
	</li>
	<?php if($this->auth['group'] == 'Người quản lý'){ ?>
	<li class="main">
		<a href="<?php echo CMS_BACKEND.'/member/index'.CMS_SUFFIX;?>" class="main" id="menu-member">Thành viên</a>
		<ul class="item">
			<li class="item"><a href="<?php echo CMS_BACKEND.'/member/index'.CMS_SUFFIX;?>" class="item">Quản lý thành viên</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/member/add'.CMS_SUFFIX;?>" class="item">Thêm thành viên</a></li>
		</ul>
	</li>
	<li class="main">
		<a href="<?php echo CMS_BACKEND.'/member_frontend/index'.CMS_SUFFIX;?>" class="main" id="menu-member">Khách hàng </a>
		<ul class="item">
			<li class="item"><a href="<?php echo CMS_BACKEND.'/member_frontend/index'.CMS_SUFFIX;?>" class="item">Quản lý khách hàng</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/member_frontend/add'.CMS_SUFFIX;?>" class="item">Thêm khách hàng</a></li>
		</ul>
	</li>
	<li class="main">
		<?php $a = helper_module_count_item01('payment', array('salt' => 0)); ?>
		<a href="<?php echo CMS_BACKEND.'/products/viewpayment'.CMS_SUFFIX;?>" class="main" id="menu-member">Đơn hàng<sup style="color:red;">(<?php echo $a; ?>)</sup></a>
		<ul class="item">
			<li class="item"><a href="<?php echo CMS_BACKEND.'/products/viewpayment'.CMS_SUFFIX;?>" class="item">Quản lý Đơn hàng</a></li>
		</ul>
	</li>
	<li class="main">
		<a href="<?php echo CMS_BACKEND.'/slide/item'.CMS_SUFFIX;?>" class="main" id="slide-slide">Slide</a>
		<ul class="item">
			<li class="item"><a href="<?php echo CMS_BACKEND.'/slide/category'.CMS_SUFFIX;?>" class="item">Quản lý danh mục slide</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/slide/addcategory'.CMS_SUFFIX;?>" class="item">Thêm danh mục slide</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/slide/item'.CMS_SUFFIX;?>" class="item">Quản lý slide</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/slide/additem'.CMS_SUFFIX;?>" class="item">Thêm slide</a></li>
		</ul>
	</li>
	<li class="main">
		<a href="<?php echo CMS_BACKEND.'/menu/item'.CMS_SUFFIX;?>" class="main" id="menu-menu">Menu</a>
		<ul class="item">
			<li class="item"><a href="<?php echo CMS_BACKEND.'/menu/category'.CMS_SUFFIX;?>" class="item">Quản lý danh mục menu</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/menu/addcategory'.CMS_SUFFIX;?>" class="item">Thêm danh mục menu</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/menu/item'.CMS_SUFFIX;?>" class="item">Quản lý menu</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/menu/additem'.CMS_SUFFIX;?>" class="item">Thêm menu</a></li>
		</ul>
	</li>
	<li class="main">
		<a href="<?php echo CMS_BACKEND.'/support/item'.CMS_SUFFIX;?>" class="main" id="menu-support">Hỗ trợ</a>
		<ul class="item">
			<li class="item"><a href="<?php echo CMS_BACKEND.'/support/category'.CMS_SUFFIX;?>" class="item">Quản lý danh mục hỗ trợ</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/support/addcategory'.CMS_SUFFIX;?>" class="item">Thêm danh mục hỗ trợ</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/support/item'.CMS_SUFFIX;?>" class="item">Quản lý hỗ trợ</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/support/additem'.CMS_SUFFIX;?>" class="item">Thêm hỗ trợ</a></li>
		</ul>
	</li>
	<li class="main">
		<a href="<?php echo CMS_BACKEND.'/contacts/index'.CMS_SUFFIX;?>" class="main" id="menu-contacts">Liên hệ</a>
		<ul class="item">
			<li class="item"><a href="<?php echo CMS_BACKEND.'/contacts/index'.CMS_SUFFIX;?>" class="item">Quản lý liên hệ</a></li>
		</ul>
	</li>
	<?php } ?>
	<li class="main">
		<a href="<?php echo CMS_BACKEND.'/articles/item'.CMS_SUFFIX;?>" class="main" id="menu-articles">Bài viết</a>
		<ul class="item">
			<li class="item"><a href="<?php echo CMS_BACKEND.'/articles/category'.CMS_SUFFIX;?>" class="item">Quản lý danh mục bài viết</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/articles/addcategory'.CMS_SUFFIX;?>" class="item">Thêm danh mục bài viết</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/articles/item'.CMS_SUFFIX;?>" class="item">Quản lý bài viết</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/articles/additem'.CMS_SUFFIX;?>" class="item">Thêm bài viết</a></li>
		</ul>
	</li>
	<li class="main">
		<a href="<?php echo CMS_BACKEND.'/products/item'.CMS_SUFFIX;?>" class="main" id="menu-products">Sản phẩm</a>
		<ul class="item">
			<li class="item"><a href="<?php echo CMS_BACKEND.'/products/category'.CMS_SUFFIX;?>" class="item">Quản lý danh mục sản phẩm</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/products/addcategory'.CMS_SUFFIX;?>" class="item">Thêm danh mục sản phẩm</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/products/item'.CMS_SUFFIX;?>" class="item">Quản lý sản phẩm</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/products/additem'.CMS_SUFFIX;?>" class="item">Thêm sản phẩm</a></li>
		</ul>
	</li>
	<li class="main">
		<a href="<?php echo CMS_BACKEND.'/bst/item'.CMS_SUFFIX;?>" class="main" id="menu-bst">Bộ sưu tập</a>
		<ul class="item">
			<li class="item"><a href="<?php echo CMS_BACKEND.'/bst/category'.CMS_SUFFIX;?>" class="item">Quản lý danh mục BST</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/bst/addcategory'.CMS_SUFFIX;?>" class="item">Thêm danh mục BST</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/bst/item'.CMS_SUFFIX;?>" class="item">Quản lý BST</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/bst/additem'.CMS_SUFFIX;?>" class="item">Thêm BST</a></li>
		</ul>
	</li>
	<li class="main">
		<a href="<?php echo CMS_BACKEND.'/lockbook/item'.CMS_SUFFIX;?>" class="main" id="menu-lockbook">LOCKBOOK</a>
		<ul class="item">
			<li class="item"><a href="<?php echo CMS_BACKEND.'/lockbook/category'.CMS_SUFFIX;?>" class="item">Quản lý danh mục LOCKBOOK</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/lockbook/addcategory'.CMS_SUFFIX;?>" class="item">Thêm danh mục LOCKBOOK</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/lockbook/item'.CMS_SUFFIX;?>" class="item">Quản lý LOCKBOOK</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/lockbook/additem'.CMS_SUFFIX;?>" class="item">Thêm LOCKBOOK</a></li>
		</ul>
	</li>
	<li class="main">
		<a href="<?php echo CMS_BACKEND.'/thuonghieu/index'.CMS_SUFFIX;?>" class="main" id="menu-thuonghieu">Thương hiệu</a>
		<ul class="item">
			<li class="item"><a href="<?php echo CMS_BACKEND.'/thuonghieu/index'.CMS_SUFFIX;?>" class="item">Quản lý thương hiệu</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/thuonghieu/add'.CMS_SUFFIX;?>" class="item">Thêm thương hiệu</a></li>
		</ul>
	</li>
	<li class="main">
		<a href="<?php echo CMS_BACKEND.'/tags/index'.CMS_SUFFIX;?>" class="main" id="menu-tags">Chủ đề</a>
		<ul class="item">
			<li class="item"><a href="<?php echo CMS_BACKEND.'/tags/index'.CMS_SUFFIX;?>" class="item">Quản lý chủ đề</a></li>
			<li class="item"><a href="<?php echo CMS_BACKEND.'/tags/add'.CMS_SUFFIX;?>" class="item">Thêm chủ đề</a></li>
		</ul>
	</li>
</ul>