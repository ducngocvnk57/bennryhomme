<article class="news">
<div class="block">
	<div class="main-title">
		<ul class="breadcrumb">
			<li><h3>Đơn hàng</h3></li>
		</ul>
	</div>
	<div class="container">
		<div id="cms-table">
			<table cellspacing="0" cellpadding="0">
				<tr>
					<th><label for="txtSend_date">Mã đơn hàng</label></th>
					<td>
						<?php echo (isset($full_data['code_send'])?$full_data['code_send']:'');?>
					</td>
				</tr>
				<tr>
					<th><label>Tên công ty</label></th>
					<td>
						<?php echo (isset($full_data['comp_received'])?$full_data['comp_received']:'');?>
					</td>
				</tr>
				<tr>
					<th><label>Người liên hệ</label></th>
					<td>
						<?php if(!empty($full_data['userid_created'])) { $user = helper_module_get_user_info('user_customer',$full_data['userid_created']);echo $user['fullname'];} ?>
					</td>
				</tr>
				<tr>
					<th><label>Địa chỉ giao dịch</label></th>
					<td>
						<?php echo (isset($full_data['address_edit_received'])?$full_data['address_edit_received']:'');?>
					</td>
				</tr>
				<tr>
					<th><label>Địa chỉ xuất hóa đơn</label></th>
					<td>
						<?php echo (isset($full_data['address_output_bills'])?$full_data['address_output_bills']:'');?>
					</td>
				</tr>
				<tr>
					<th><label>Mã số thuế</label></th>
					<td>
						<?php echo (isset($full_data['tax_code'])?$full_data['tax_code']:'');?>
					</td>
				</tr>
				<tr>
					<th><label>Điện thoại</label></th>
					<td>
						<?php echo (isset($full_data['phone_contact'])?$full_data['phone_contact']:'');?>
					</td>
				</tr>
				<tr>
					<th><label>Email</label></th>
					<td>
						<?php echo (isset($full_data['email_contact'])?$full_data['email_contact']:'');?>
					</td>
				</tr>
				<tr>
					<th><label>Tài khoản ngân hàng</label></th>
					<td>
						<?php echo (isset($full_data['account_bank'])?$full_data['account_bank']:'');?>
					</td>
				</tr>
				<tr>
					<th><label>Tại ngân hàng</label></th>
					<td>
						<?php echo (isset($full_data['bank_name'])?$full_data['bank_name']:'');?>
					</td>
				</tr>
				<tr>
					<th><label>Người thụ hưởng</label></th>
					<td>
						<?php echo (isset($full_data['beneficiaries'])?$full_data['beneficiaries']:'');?>
					</td>
				</tr>
				<tr>
					<th><label for="txtAddress_received">Cước phí</label></th>
					<td>
						<?php echo (isset($full_data['price_postage'])?number_format($full_data['price_postage']):'');?> VNĐ
					</td>
				</tr>
				<tr>
					<th><label for="txtAddress_received">Cước thu hộ</label></th>
					<td>
						<?php echo (isset($full_data['price_collection'])?number_format($full_data['price_collection']):'');?> VNĐ
					</td>
				</tr>
				<tr>
					<th><label for="txtPhone_received">Tình trạng</label></th>
					<td>
						<?php echo (isset($full_data['status'])?$full_data['status']:'');?>
					</td>
				</tr>
				<tr>
					<th><label for="txtShop_received">Thanh toán</label></th>
					<td>
						<?php echo (isset($full_data['payment'])?$full_data['payment']:'');?>
					</td>
				</tr>
				<tr>
					<th><label for="txtSend_date">Ngày gửi</label></th>
					<td>
						<?php echo (isset($full_data['send_date'])?$full_data['send_date']:gmdate('d-m-Y', time() + 7*3600));?>
					</td>
				</tr>
				<tr>
					<th><label for="txtAddress_received">Địa chỉ nhận hàng</label></th>
					<td>
						<?php echo (isset($full_data['address_received'])?$full_data['address_received']:'');?>
					</td>
				</tr>
				<tr>
					<th><label for="txtNote">Ghi chú</label></th>
					<td>
						<?php echo (isset($full_data['description'])?htmlspecialchars($full_data['description']):'');?>
					</td>
				</tr>
				<tr>
					<th><label for="txtPhone_received">Số điện thoại</label></th>
					<td>
						<?php echo (isset($full_data['phone_received'])?$full_data['phone_received']:'');?>
					</td>
				</tr>
				<tr>
					<th><label for="txtShop_received">Tên cửa hàng</label></th>
					<td>
						<?php echo (isset($full_data['shop_received'])?$full_data['shop_received']:'');?>
					</td>
				</tr>
				<tr>
					<th><label for="txtCommodity_type">Loại hàng hóa</label></th>
					<td>
						<?php echo (isset($full_data['commodity_type'])?$full_data['commodity_type']:'');?>
					</td>
				</tr>
			</table>
		</div>
	</div>
</article>