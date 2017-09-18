<div id="cms-tab">
	<p class="title">Danh sách đơn hàng mới</p>
	<div class="cms-clear"></div>
</div><!-- #cms-tab -->

<div id="cms-container">
	<div id="cms-filter">
		<div class="right">
			<?php if($this->auth['group'] == 'Người quản lý'){ ?>
			<input type="submit" class="button cms-delete-ajax" value="Xóa nhiều" name="payment" />
			<?php } ?>
		</div><!-- .right -->
		<div class="cms-clear"></div>
	</div><!-- #cms-filter -->
	<div id="cms-table">
		<form id="frmView">
		<table cellspacing="0" cellpadding="0" class="data">
			<tr>
				<th>#</th>
				<th><input type="checkbox" id="check-all" /></th>
				<th class="left">Tên khách hàng</th>
				<th class="left">Điện thoại</th>
				<th class="left">Email</th>
				<th class="left">Ngày đặt</th>
				<th class="left">Ghi chú</th>
				<th class="left">Chi tiết đơn hàng</th>
				<th class="left">Mã</th>
			</tr>
			<?php if(isset($full_data) && count($full_data)){ foreach($full_data as $key => $val){ ?>
			<tr>
					<td class="center first"><?php echo ($key+$per_page*$page+1);?></td>
					<td class="center"><input type="checkbox" name="checkbox[]" value="<?php echo $val['id'];?>" class="checkbox check-all" /></td>
					<td align="left" valign="top"><?php echo $val['fullname'];?></td>
					<td align="left" valign="top"><?php echo $val['phone'];?></td>
					<td align="left" valign="top"><?php echo $val['email'];?></td>
					<td align="left" valign="top"><?php echo gmdate('d-m-Y', strtotime($val['created']) + 7*3600);?></td>
					<td align="left" valign="top"><?php echo cutnchar(htmlspecialchars(strip_tags($val['notes'])), 50);?></td>
					<td align="center" valign="top">
						<?php  if($val['salt'] == 1){ ?>
						<span style="color:#000;text-decoration:underline;">Đã xem</span>
						<?php }elseif($val['salt'] == 0){ ?>
						<span style="color:red;text-decoration:underline;">Chưa xem</span>
						<?php } ?>
						<a href="<?php echo CMS_URL;?>admin/products/detailpayment/<?php echo $val['id'];?><?php echo CMS_SUFFIX;?>"><img src="template/backend/images/information.png"></a>
					</td>
					<td align="center" valign="top">
						<?php echo $val['id'];?>
					</td>
				</tr>
			<?php } } else{ ?>
			<tr class="last"><td class="center first" colspan="12">Không có dữ liệu sản phẩm.</td></tr>
			<?php } ?>
		</table>
		</form>
	</div><!-- #cms-table -->
	<?php if(isset($full_page) && !empty($full_page) && count($full_page)){ ?>
	<div id="cms-pagination">
		<?php echo helper_string_pagination_backend($full_page, $total_rows, 'Trang'); ?>
		<div class="cms-clear"></div>
	</div><!-- #cms-pagination -->
	<?php } ?>
	<div class="cms-clear"></div>
</div><!-- #cms-container -->