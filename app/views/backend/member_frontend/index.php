<div id="cms-tab">
	<p class="title">Hệ thống quản lý thành viên</p>
	<ul class="main">
		<li class="main"><a href="<?php echo CMS_BACKEND.'/member_frontend/index'.CMS_SUFFIX;?>" class="main main-select">Quản lý thành viên</a></li>
		<li class="main"><a href="<?php echo CMS_BACKEND.'/member_frontend/add'.CMS_SUFFIX;?>" class="main">Thêm thành viên mới</a></li>
	</ul>
	<div class="cms-clear"></div>
</div><!-- #cms-tab -->

<div id="cms-container">
	<div id="cms-filter">
		<div class="left">
			<form class="frm-filter" method="get" action="<?php echo CMS_URL.CMS_BACKEND.'/member_frontend/index'.CMS_SUFFIX;?>">
				<input type="text" name="keyword" class="keyword" value="<?php echo isset($keyword)?$keyword:'';?>" />
				<input type="submit" class="search" value="Tìm kiếm" />
			</form>
		</div><!-- .left -->
		<div class="right">
			<?php if($this->auth['group'] == 'Người quản lý'){ ?>
			<input type="submit" class="button cms-delete-ajax" value="Xóa nhiều" name="user_customer" />
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
				<th class="left"><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/member_frontend_f/user'.CMS_SUFFIX;?>">Tên sử dụng<?php echo cms_common_icon_sort('user', $sort);?></a></th>
				<th class="left"><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/member_frontend/email'.CMS_SUFFIX;?>">Email<?php echo cms_common_icon_sort('email', $sort);?></a></th>
				<th class="left"><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/member_frontend/fullname'.CMS_SUFFIX;?>">Tên khách hàng<?php echo cms_common_icon_sort('fullname', $sort);?></a></th>
				<!--<th class="left"><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/member_frontend/active'.CMS_SUFFIX;?>">Trạng thái<?php echo cms_common_icon_sort('active', $sort);?></a></th> -->
				<th><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/member_frontend/created'.CMS_SUFFIX;?>">Ngày tạo<?php echo cms_common_icon_sort('created', $sort);?></a></th>
				<th><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/member_frontend/updated'.CMS_SUFFIX;?>">Ngày sửa<?php echo cms_common_icon_sort('updated', $sort);?></a></th>
				<th>Kích hoạt</th>
				<th>Thao tác</th>
				<th><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/member_frontend/id'.CMS_SUFFIX;?>">Mã<?php echo cms_common_icon_sort('id', $sort);?></a></th>
			</tr>
			<?php if(isset($full_data) && count($full_data)){ foreach($full_data as $key => $val){ ?>
			<tr <?php echo (($key + 1) == count($full_data))?'class="last"':'';?>>
				<td class="center first"><?php echo ($key+$per_page*$page+1);?></td>
				<td class="center"><input type="checkbox" name="checkbox[]" value="<?php echo $val['id'];?>" class="checkbox check-all" /></td>
				<td class="left title"><?php echo $val['user'];?></td>
				<td class="left title"><?php echo $val['email'];?></td>
				<td class="left title"><?php echo $val['fullname'];?></td>
				<!--<td class="left title"><?php if($val['active'] == 1){echo 'Đã kích hoạt';}else{ echo 'Chưa kích hoạt';}?></td> -->
				<td class="center"><?php echo ($val['created'] != '0000-00-00 00:00:00')?gmdate('H:i d/m/Y', strtotime($val['created']) + 7*3600):'-';?></td>
				<td class="center"><?php echo ($val['updated'] != '0000-00-00 00:00:00')?gmdate('H:i d/m/Y', strtotime($val['updated']) + 7*3600):'-';?></td>
				<td class="center">
					<a class="cms-set-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/common/set/user_customer/active/'.$val['id'].CMS_SUFFIX;?>">
						<img src="<?php echo ($val['active'] == 0)?'template/backend/images/uncheck.png':'template/backend/images/check.png';?>" alt="Kích hoạt" title="Kích hoạt" />
					</a>
				</td>
				<td class="center">
					<a href="<?php echo CMS_URL.CMS_BACKEND.'/member_frontend/edit/'.$val['id'].CMS_SUFFIX;?>"><img src="template/backend/images/edit.png" /></a>
					<a href="<?php echo CMS_URL.CMS_BACKEND.'/member_frontend/reset/'.$val['id'].CMS_SUFFIX;?>"><img src="template/backend/images/reset.png" /></a>
				</td>
				<td class="center last"><?php echo $val['id'];?></td>
			</tr>
			<?php } } else{ ?>
			<tr class="last"><td class="center first" colspan="10">Không có dữ liệu thành viên.</td></tr>
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