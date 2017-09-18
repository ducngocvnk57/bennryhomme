<article class="login-form">
<div class="hidden-form">
	<?php 
		$info_user = $this->lib_authentication->check_customer(); 
		if(isset($info_user)){
		$count_note = helper_module_count_note('affairs_item', $info_user['id']);
	?>
	<p class="logined"><span>Xin chào! </span><a href="thong-tin-tai-khoan.html" title="<?php echo htmlspecialchars($info_user['fullname']); ?>"><?php echo htmlspecialchars($info_user['fullname']); ?> | <a href="dang-xuat.html" title="Đăng xuất">Đăng xuất</a></p>
	<ul class="nav-custormer">
		<li><img src="template/frontend/images/send-login.png" style="width:15px;float: left;margin: 3px 5px 0px 0px;"><a href="gui-yeu-cau.html">Gửi yêu cầu</a><li>
		<li><img src="template/frontend/images/list-login.png" style="width:15px;float: left;margin: 3px 5px 0px 0px;"><a href="danh-sach-yeu-cau-da-gui.html">Danh sách yêu cầu đã gửi (<?php echo $count_note;?>)</a><li>
		<li><img src="template/frontend/images/user-login.png" style="width:15px;float: left;margin: 3px 5px 0px 0px;"><a href="thong-tin-tai-khoan.html">Thay đổi thông tin</a><li>
	</ul>
	<?php }else{ ?>
	<p class="login-title">Đăng nhập</p>
	<form action="<?php echo CMS_URL;?>" method="post">
		<?php
			$error = validation_errors();
			echo (isset($error)&&!empty($error))?'<script type="text/javascript">$(window).load(function(){ alert(\''.preg_replace('/[\n\r]+/', '', $error).'\');});</script>':'';
		?>
		<input type="text" class="user" name="data[user]" value="<?php echo (isset($post_data['user'])?$post_data['user']:'');?>" placeholder="User Name"  autocomplete="off"/>
		<input type="password" class="password" value="" name="data[password]" placeholder="Password" autocomplete="off"/>
		<input type="submit" name="login" class="submit" value="Đăng nhập">
	</form>
	<div class="sign-in"><p class="fogot-pass">Quên mật khẩu</p> <span>|</span> <a href="dang-ky.html">Đăng ký</a></div>
	<?php } ?>
</div>
<div class="fogot-form">
	<p class="login-title">Quên mật khẩu</p>
	<form action="<?php echo CMS_URL;?>" method="post">
		<input type="text" class="user" name="data[email]" value="<?php echo (isset($post_data['email'])?$post_data['email']:'');?>" placeholder="Nhập Email đã đăng ký" />
		<input type="submit" name="fogot" class="fogot" value="Thao tác">
	</form>
	<div class="sign-in"><p class="login-back">Đăng nhập</p></div>
</div>
</article>

<script type="text/javascript">
$(document).ready(function(){
	$('p.fogot-pass').click(function(){
		$('.hidden-form').css("display","none");
		$('.fogot-form').css("display","block");
	});
	$('p.login-back').click(function(){
		$('.hidden-form').css("display","block");
		$('.fogot-form').css("display","none");
	});
});
</script>