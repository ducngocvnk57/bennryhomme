<div id="cms-tab">
	<p class="title">Hệ thống hỗ trợ</p>
	<ul class="main">
		<li class="main"><a href="<?php echo CMS_BACKEND.'/support/item'.CMS_SUFFIX;?>" class="main main-select">Quản lý hỗ trợ</a></li>
		<li class="main"><a href="<?php echo CMS_BACKEND.'/support/additem'.CMS_SUFFIX;?>" class="main">Thêm hỗ trợ mới</a></li>
	</ul>
	<div class="cms-clear"></div>
</div><!-- #cms-tab -->

<div id="cms-container">
	<div id="cms-filter">
		<div class="left">
			<form class="frm-filter" method="get" action="<?php echo CMS_URL.CMS_BACKEND.'/support/item'.CMS_SUFFIX;?>" id="frmFilter">
				<?php echo form_dropdown('parentid', (isset($show_data['parentid'])?$show_data['parentid']:NULL), (isset($post_data['parentid'])?(int)$post_data['parentid']:0),' class="select" id="txtFilterParentid"');?>
				<input type="text" name="keyword" class="keyword" value="<?php echo isset($keyword)?$keyword:'';?>" />
				<input type="submit" class="search" value="Tìm kiếm" />
			</form>
		</div><!-- .left -->
		<div class="right">
			<input type="submit" class="button cms-publish-ajax" value="Xuất bản" name="support_item" />
			<input type="submit" class="button cms-unpublish-ajax" value="Dừng xuất bản" name="support_item" />
			<input type="submit" class="button cms-order-ajax" value="Sắp xếp" name="support_item" />
			<input type="submit" class="button cms-delete-ajax" value="Xóa nhiều" name="support_item" />
		</div><!-- .right -->
		<div class="cms-clear"></div>
	</div><!-- #cms-filter -->
	<div id="cms-table">
		<form id="frmView">
		<table cellspacing="0" cellpadding="0" class="data">
			<tr>
				<th>#</th>
				<th><input type="checkbox" id="check-all" /></th>
				<th class="left"><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/support_item/title'.CMS_SUFFIX;?>">Tên hỗ trợ<?php echo cms_common_icon_sort('title', $sort);?></a></th>
				<th><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/support_item/phone'.CMS_SUFFIX;?>">Điện thoại<?php echo cms_common_icon_sort('phone', $sort);?></a></th>
				<th><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/support_item/parentid'.CMS_SUFFIX;?>">Danh mục cha<?php echo cms_common_icon_sort('parentid', $sort);?></a></th>
				<th><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/support_item/created'.CMS_SUFFIX;?>">Ngày tạo<?php echo cms_common_icon_sort('created', $sort);?></a></th>
				<th><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/support_item/updated'.CMS_SUFFIX;?>">Ngày sửa<?php echo cms_common_icon_sort('updated', $sort);?></a></th>
				<th><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/support_item/userid_created'.CMS_SUFFIX;?>">Người tạo<?php echo cms_common_icon_sort('userid_created', $sort);?></a></th>
				<th><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/support_item/userid_updated'.CMS_SUFFIX;?>">Người sửa<?php echo cms_common_icon_sort('userid_updated', $sort);?></a></th>
				<th><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/support_item/order'.CMS_SUFFIX;?>">Vị trí<?php echo cms_common_icon_sort('order', $sort);?></a></th>
				<th><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/support_item/highlight'.CMS_SUFFIX;?>">Nổi bật<?php echo cms_common_icon_sort('highlight', $sort);?></a></th>
				<th>Thao tác</th>
				<th><a class="cms-sort-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/session/sort/support_item/id'.CMS_SUFFIX;?>">Mã<?php echo cms_common_icon_sort('id', $sort);?></a></th>
			</tr>
			<?php if(isset($full_data) && count($full_data)){ foreach($full_data as $key => $val){ ?>
			<tr <?php echo (($key + 1) == count($full_data))?'class="last"':'';?>>
				<td class="center first"><?php echo ($key+$per_page*$page+1);?></td>
				<td class="center"><input type="checkbox" name="checkbox[]" value="<?php echo $val['id'];?>" class="checkbox check-all" /></td>
				<td class="left title"><a href="<?php echo CMS_URL.CMS_BACKEND.'/support/edititem/'.$val['id'].CMS_SUFFIX;?>"><?php echo helper_string_cutnchar(strip_tags($val['title']), 68);?></a></td>
				<td class="center"><?php echo $val['phone'];?></td>
				<td class="center"><?php $parentid = helper_module_get_category_info('support_category', $val['parentid']); echo ($parentid == NULL)?'-':$parentid['title'];?></td>
				<td class="center"><?php echo ($val['created'] != '0000-00-00 00:00:00')?gmdate('H:i d/m/Y', strtotime($val['created']) + 7*3600):'-';?></td>
				<td class="center"><?php echo ($val['updated'] != '0000-00-00 00:00:00')?gmdate('H:i d/m/Y', strtotime($val['updated']) + 7*3600):'-';?></td>
				<td class="center"><?php $user = helper_user_get_info($val['userid_created']); echo ($user == NULL)?'-':(!empty($user['fullname'])?$user['fullname']:$user['username']);?></td>
				<td class="center"><?php $user = helper_user_get_info($val['userid_updated']); echo ($user == NULL)?'-':(!empty($user['fullname'])?$user['fullname']:$user['username']);?></td>
				<td class="center order"><input type="text" name="order[<?php echo $val['id'];?>]" value="<?php echo $val['order'];?>" /></td>
				<td class="center">
					<a class="cms-set-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/common/set/support_item/publish/'.$val['id'].CMS_SUFFIX;?>">
						<img src="<?php echo ($val['publish'] == 0)?'template/backend/images/uncheck.png':'template/backend/images/check.png';?>" alt="Xuất bản" title="Xuất bản" />
					</a>
				</td>
				<td class="center">
					<a href="<?php echo CMS_URL.CMS_BACKEND.'/support/edititem/'.$val['id'].CMS_SUFFIX;?>"><img src="template/backend/images/edit.png" /></a>
				</td>
				<td class="center last"><?php echo $val['id'];?></td>
			</tr>
			<?php } } else{ ?>
			<tr class="last"><td class="center first" colspan="12">Không có dữ liệu hỗ trợ.</td></tr>
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