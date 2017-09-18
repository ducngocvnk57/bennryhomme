<div id="cms-tab">
	<p class="title">Hệ thống danh mục hỗ trợ</p>
	<ul class="main">
		<li class="main"><a href="<?php echo CMS_BACKEND.'/support/category'.CMS_SUFFIX;?>" class="main main-select">Quản lý danh mục hỗ trợ</a></li>
		<li class="main"><a href="<?php echo CMS_BACKEND.'/support/addcategory'.CMS_SUFFIX;?>" class="main">Thêm danh mục hỗ trợ mới</a></li>
	</ul>
	<div class="cms-clear"></div>
</div><!-- #cms-tab -->

<div id="cms-container">
	<div id="cms-filter">
		<div class="right">
			<input type="submit" class="button cms-publish-ajax" value="Xuất bản" name="support_category" />
			<input type="submit" class="button cms-unpublish-ajax" value="Dừng xuất bản" name="support_category" />
			<input type="submit" class="button cms-order-ajax" value="Sắp xếp" name="support_category" />
			<input type="submit" class="button cms-delete-category-ajax" value="Xóa nhiều" name="support_category" />
		</div><!-- .right -->
		<div class="cms-clear"></div>
	</div><!-- #cms-filter -->
	<div id="cms-table">
		<form id="frmView">
		<table cellspacing="0" cellpadding="0" class="data">
			<tr>
				<th>#</th>
				<th><input type="checkbox" id="check-all" /></th>
				<th class="left">Tiêu đề</th>
				<th>hỗ trợ</th>
				<th>Ngày tạo</th>
				<th>Ngày sửa</th>
				<th>Người tạo</th>
				<th>Người sửa</th>
				<th>Lft</th>
				<th>Rgt</th>
				<th>Vị trí</th>
				<th>Xuất bản</th>
				<th>Thao tác</th>
				<th>Mã</th>
			</tr>
			<?php if(isset($full_data) && count($full_data)){ foreach($full_data as $key => $val){ ?>
			<tr <?php echo (($key + 1) == count($full_data))?'class="last"':'';?>>
				<td class="center first"><?php echo ($key+1);?></td>
				<td class="center"><input type="checkbox" name="checkbox[]" value="<?php echo $val['id'];?>" class="checkbox check-all" /></td>
				<td class="left title"><a href="<?php echo CMS_URL.CMS_BACKEND.'/support/editcategory/'.$val['id'].CMS_SUFFIX;?>"><?php echo str_repeat('|----- ', $val['level']).htmlspecialchars($val['title']);?></a></td>
				<td class="center"><?php echo helper_module_count_item('support_item', $val['id']);?></td>
				<td class="center"><?php echo ($val['created'] != '0000-00-00 00:00:00')?gmdate('H:i d/m/Y', strtotime($val['created']) + 7*3600):'-';?></td>
				<td class="center"><?php echo ($val['updated'] != '0000-00-00 00:00:00')?gmdate('H:i d/m/Y', strtotime($val['updated']) + 7*3600):'-';?></td>
				<td class="center"><?php $user = helper_user_get_info($val['userid_created']); echo ($user == NULL)?'-':(!empty($user['fullname'])?$user['fullname']:$user['username']);?></td>
				<td class="center"><?php $user = helper_user_get_info($val['userid_updated']); echo ($user == NULL)?'-':(!empty($user['fullname'])?$user['fullname']:$user['username']);?></td>
				<td class="center"><?php echo $val['lft'];?></td>
				<td class="center"><?php echo $val['rgt'];?></td>
				<td class="center order"><input type="text" name="order[<?php echo $val['id'];?>]" value="<?php echo $val['order'];?>" /></td>
				<td class="center">
					<a class="cms-set-ajax" href="<?php echo CMS_URL.CMS_BACKEND.'/common/set/support_category/publish/'.$val['id'].CMS_SUFFIX;?>">
						<img src="<?php echo ($val['publish'] == 0)?'template/backend/images/uncheck.png':'template/backend/images/check.png';?>" alt="Xuất bản" title="Xuất bản" />
					</a>
				</td>
				<td class="center">
					<a href="<?php echo CMS_URL.CMS_BACKEND.'/support/editcategory/'.$val['id'].CMS_SUFFIX;?>"><img src="template/backend/images/edit.png" /></a>
				</td>
				<td class="center last"><?php echo $val['id'];?></td>
			</tr>
			<?php } } else{ ?>
			<tr class="last"><td class="center first" colspan="14">Không có dữ liệu danh mục hỗ trợ.</td></tr>
			<?php } ?>
		</table>
		</form>
	</div><!-- #cms-table -->
	<div class="cms-clear"></div>
</div><!-- #cms-container -->