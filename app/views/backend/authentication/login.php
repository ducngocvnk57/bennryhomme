<form method="post" action="">
	<fieldset class="info">
		<legend>Đăng nhập vào hệ thống:</legend>
		<?php $error = validation_errors(); echo isset($error)?'<ul class="cms-error">'.$error.'</ul>':'';?>
		<table cellspacing="0" cellpadding="0" class="form">
			<tr>
				<td style="width: 100px;">
					<label for="txtUsername" class="title">Tên sử dụng:</label>
				</td>
				<td style="text-align: right;">
					<input type="text" name="data[username]" id="txtUsername" value="<?php echo (isset($post_data['username'])?$post_data['username']:'');?>" class="text" />
				</td>
			</tr>
			<tr>
				<td>
					<label for="txtPassword" class="title">Mật khẩu:</label>
				</td>
				<td style="text-align: right;">
					<input type="password" name="data[password]" id="txtPassword" value="<?php echo (isset($post_data['password'])?$post_data['password']:'');?>" class="text" />
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: right;padding-top: 15px;">
					<input type="submit" name="login" class="btn" value="Đăng nhập" />
					<input type="reset" class="btn" value="Làm lại" />
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: right;">
					<a href="<?php echo CMS_URL;?>" title="Về trang chủ">Về trang chủ</a> / <a href="<?php echo CMS_URL.CMS_BACKEND.'/authentication/forgot'.CMS_SUFFIX;?>" title="Quên mật khẩu">Quên mật khẩu</a>
				</td>
			</tr>
		</table>
	</fieldset>
</form>