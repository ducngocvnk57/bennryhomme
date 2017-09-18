<form method="post" action="">
	<fieldset class="info">
		<legend>Quên mật khẩu:</legend>
		<ul class="cms-error">
			<li>Bạn chưa nhập mật khẩu</li>
		</ul>
		<table cellspacing="0" cellpadding="0" class="form">
			<tr>
				<td style="width: 100px;">
					<label for="txtEmail" class="title">Email:</label>
				</td>
				<td style="text-align: right;">
					<input type="text" name="data[email]" id="txtEmail" value="" class="text" />
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: right;padding-top: 15px;">
					<input type="submit" name="submit" class="btn" value="Gửi yêu cầu" />
					<input type="reset" class="btn" value="Làm lại" />
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: right;">
					<a href="<?php echo CMS_URL;?>" title="Về trang chủ">Về trang chủ</a> / <a href="<?php echo CMS_URL.CMS_BACKEND.'/authentication/login'.CMS_SUFFIX;?>" title="Đăng nhập vào hệ thống">Đăng nhập</a>
				</td>
			</tr>
		</table>
	</fieldset>
</form>