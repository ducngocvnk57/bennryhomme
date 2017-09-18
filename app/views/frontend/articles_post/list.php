<article class="news">
<div class="block">
	<div class="main-title">
		<ul class="breadcrumb">
			<li><h3>Danh sách yêu cầu đã gửi</h3></li>
		</ul>
	</div>
	<div class="container">
		<div id="cms-filter">
			<form class="frm-filter" method="get" action="" id="frmFilter">
				<input type="text" name="keyword" class="keyword" placeholder="Nhập mã đơn hàng..." value="<?php echo isset($keyword)?$keyword:'';?>" />
				<input type="submit" class="search" value="Tìm kiếm" />
			</form>
		</div><!-- #cms-filter -->
		<form action="" method="post">
			<div id="cms-table">
				<table cellspacing="0" cellpadding="0" class="data">
					<tr>
						<th>STT</th>
						<th>Loại hàng hóa</th>
						<th>Trạng thái</th>
						<th>Sửa</th>
						<th>Xóa</th>
					</tr>
					<?php if(isset($full_data) && count($full_data)){ foreach($full_data as $key => $val){ ?>
					<tr <?php echo (($key + 1) == count($full_data))?'class="last"':'';?>>
						<td><?php echo ($key+$per_page*$page+1);?></td>
						<td><a title="<?php echo htmlspecialchars($val['commodity_type']); ?>" href="<?php echo 'sua-yeu-cau-'.$val['id'].CMS_SUFFIX;?>"><?php echo helper_string_cutnchar(strip_tags($val['commodity_type']), 68);?></a></td>
						<td><?php echo (!empty($val['code_send']))?'Đã xử lý':'Chờ xử lý';?></td>
						<td><?php if(empty($val['code_send'])){ ?><a href="<?php echo 'sua-yeu-cau-'.$val['id'].CMS_SUFFIX;?>"><img src="template/backend/images/edit.png" /></a><?php }else{ ?><a href="<?php echo 'xem-don-hang-'.$val['id'].CMS_SUFFIX;?>"><img src="template/frontend/images/view-item.png" /></a><?php } ?></td>
						<td align="center"><?php if(empty($val['code_send'])){ ?><a href="<?php echo 'xoa-yeu-cau-'.$val['id'].CMS_SUFFIX;?>" onclick="return confirm('Bạn có chắc chắn muốn xóa yêu cầu này không ?')"><img src="template/backend/images/delete.png" /></a><?php } ?></td>
					</tr>
					<?php } } else{ ?>
						<tr><td class="center first" colspan="12">Không có yêu cầu.</td></tr>
					<?php } ?>
				</table>
			</div>
		<?php if(isset($pagination) && !empty($pagination) && count($pagination)){ ?>
			<div class="pagination">
				<?php echo helper_string_pagination_backend($pagination, $total_rows, 'Trang'); ?>
			</div>
		<?php } ?>
	</form>
	</div>
</article>