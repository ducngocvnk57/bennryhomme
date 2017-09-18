<section class="wrapper-breadcrumb">
	<section class="wrapper-breadcrumb-inner">
		<ul class="breadcrumb">
			<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
				<a href="<?php echo CMS_URL;?>" title="Home" itemprop="url"><span itemprop="title">Home</span></a>
			</li>
		</ul>
	</section>
</section>
<section class="ben-content">
	<section class="left-content">
		<h2 class="left-title">Danh mục sản phẩm</h2>
		<ul class="list-cate">
		<?php $list_dm01 =  helper_module_list_category('products_category', array('level' => 2), 'order asc, id asc',20); ?>
		<?php if(!empty($list_dm01)) { foreach ($list_dm01 as $key_01 => $val_01) {	?>
			<li><a href="<?php echo helper_string_alias($val_01['title']).'-cp'.$val_01['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val_01['title']);?>"><?php echo htmlspecialchars($val_01['title']);?></a>
				<?php if($val_01['rgt'] - $val_01['lft'] != 1) { ?>
					<ul class="list-item">
					<?php $list_dm02 =  helper_module_list_category('products_category', array('parentid' => $val_01['id']), 'order asc, id asc',20); ?>
					<?php if(!empty($list_dm02)) { foreach ($list_dm02 as $key_02 => $val_02) {	?>
					<li class="list-item"><a class="list-item" href="<?php echo helper_string_alias($val_02['title']).'-cp'.$val_02['id'].CMS_SUFFIX;?>" title="<?php echo htmlspecialchars($val_02['title']);?>"><?php echo htmlspecialchars($val_02['title']);?></a></li>
					<?php } }  ?>
					</ul>
				<?php } ?>
			</li>
		<?php } }  ?>
		</ul>
	</section>
	<section class="right-content">
		<section class="contact" style="">
			<?php
			echo $this->system['contact'];
			$error = validation_errors();
			echo isset($error)?'<ul class="cms-error">'.$error.'</ul>':'';
			?>
			<section class="vv-contact">
				<form id="frmContact" method="post" action="">
					<table>
						<tr>
							<td style="width: 120px;"><label>Họ và tên</label></td>
							<td><input type="text" name="data[fullname]" value="<?php echo isset($post_data['fullname'])?htmlspecialchars($post_data['fullname']):'';?>" class="validate[required] text" /></td>
						</tr>
						<tr>
							<td><label>Số điện thoại</label></td>
							<td><input type="text" name="data[phone]" value="<?php echo isset($post_data['phone'])?htmlspecialchars($post_data['phone']):'';?>" class="validate[required] text" /></td>
						</tr>
						<tr>
							<td><label>Địa chỉ</label></td>
							<td><input type="text" name="data[address]" value="<?php echo isset($post_data['address'])?htmlspecialchars($post_data['address']):'';?>" class="validate[required] text" /></td>
						</tr>
						<tr>
							<td><label>Email</label></td>
							<td><input type="text" name="data[email]" value="<?php echo isset($post_data['email'])?htmlspecialchars($post_data['email']):'';?>" class="validate[required,custom[email]] text" /></td>
						</tr>
						<tr>
							<td><label>Nội dung liên hệ</label></td>
							<td><textarea name="data[notes]" class="validate[required]" rows="5" cols="5"><?php echo isset($post_data['content'])?htmlspecialchars($post_data['content']):'';?></textarea></td>
						</tr>
						<tr>
							<td></td>
							<td>
								<div class="submit">
									<img src="frontend/contact/captcha" class="img-capcha" title="Mã xác nhận" alt="Mã xác nhận"/>
									<img src="template/captcha/reload.png" class="img-reload" title="Làm mới mã xác nhận" alt="Làm mới mã xác nhận"/>
									<input type="text" name="txtCaptcha" value="" class="input-capcha" placeholder="Mã xác nhận" />
									<input type="submit" name="sent" value="Gửi liên hệ" class="btnSubmit" />
								</div>
							</td>
						</tr>
					</table>
				</form>
			</section>
		</section>
	</section>
</section>