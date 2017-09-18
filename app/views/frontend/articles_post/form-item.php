<article class="news">
<div class="block">
	<div class="main-title">
		<ul class="breadcrumb">
			<li><h3>Gửi yêu cầu</h3></li>
		</ul>
	</div>
	<div class="container">
		<form action="" method="post" accept-charset="utf-8">
			<table cellspacing="0" cellpadding="0">
				<tr>
					<th><label for="txtSend_date">Ngày gửi</label></th>
					<td>
						<input style="width:250px;" class="txt-form" type="date" name="data[send_date]" id="txtSend_date" value="<?php echo (isset($post_data['send_date'])?$post_data['send_date']:gmdate('d-m-Y', time() + 7*3600));?>" />
						<?php echo form_error('data[send_date]'); ?>
					</td>
				</tr>
				<tr>
					<th><label for="txtAddress_received">Địa chỉ nhận hàng</label></th>
					<td>
						<input class="txt-form" type="text" name="data[address_received]" id="txtAddress_received" value="<?php echo (isset($post_data['address_received'])?$post_data['address_received']:'');?>" />
						<?php echo form_error('data[address_received]'); ?>
					</td>
				</tr>
				<tr>
					<th><label for="txtNote">Ghi chú</label></th>
					<td><textarea class="area-form" name="data[description]" id="txtNote"><?php echo (isset($post_data['description'])?htmlspecialchars($post_data['description']):'');?></textarea></td>
				</tr>
				<tr>
					<th><label for="txtPhone_received">Số điện thoại</label></th>
					<td>
						<input class="txt-form" type="text" name="data[phone_received]" id="txtPhone_received" value="<?php echo (isset($post_data['phone_received'])?$post_data['phone_received']:'');?>" />
						<?php echo form_error('data[phone_received]'); ?>
					</td>
				</tr>
				<tr>
					<th><label for="txtemail_received">Email</label></th>
					<td>
						<input class="txt-form" type="text" name="data[email_received]" id="txtemail_received" value="<?php echo (isset($post_data['email_received'])?$post_data['email_received']:'');?>" />
					</td>
				</tr>
				<tr>
					<th><label for="txtShop_received">Tên công ty</label></th>
					<td>
						<input class="txt-form" type="text" name="data[shop_received]" id="txtShop_received" value="<?php echo (isset($post_data['shop_received'])?$post_data['shop_received']:'');?>" />
						<?php echo form_error('data[shop_received]'); ?>
					</td>
				</tr>
				<tr>
					<th><label for="txtCommodity_type">Loại hàng hóa</label></th>
					<td>
						<input class="txt-form" type="text" name="data[commodity_type]" id="txtCommodity_type" value="<?php echo (isset($post_data['commodity_type'])?$post_data['commodity_type']:'');?>" />
						<?php echo form_error('data[commodity_type]'); ?>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<img src="frontend/contact/captcha" class="img-capcha" title="Mã xác nhận" alt="Mã xác nhận"/>
						<img src="template/captcha/reload.png" class="img-reload" title="Làm mới mã xác nhận" alt="Làm mới mã xác nhận"/>
						<input type="text" name="txtCaptcha" value="" class="input-capcha" placeholder="Mã xác nhận" />
						<?php echo form_error('txtCaptcha'); ?>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<?php echo isset($button_action)?$button_action:'';?>
						<input class="btn-form" type="submit" name="submit" value="<?php echo isset($data['meta_title']) ? $data['meta_title'] : NULL ; ?>"/>
					</td>
				</tr>
			</table>
		</form>
	</div>
</article>