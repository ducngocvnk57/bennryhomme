<form method="post" action=""><div class="panel-main">	<div class="block">		<div class="main-title"><p>Thông tin sản phẩm</p></div>		<div class="main-container">			<table border="0" cellspacing="1" cellpadding="0">					<tbody class="slide-action">						<?php $content = common_valuepost($post_data['images']);							if(!empty($content)){ 								$content = json_decode(base64_decode($post_data['images'])); 								// print_r($content);die;								if(isset($content) && count($content)){ 								foreach($content as $key => $val){						?>						<tr class="slide-item">							<td style="width:168px;">Ảnh chi tiết - <?php echo ($key + 1);?></td>							<td style="padding: 5px 0px 5px 0px;">								<input name="data[images][]" value="<?php echo (isset($content[$key])?$content[$key]:NULL);?>" type="text" placeholder="Hình ảnh" id="txtImage<?php echo ($key + 1);?>" class="text-input" style="background: #FFFFFF;border: 1px solid #CCC;font-size: 11px;padding: 5px 5px;margin: 0px;color: #333;width: 450px;"><input type="button" value="Chọn ảnh" onclick="browseKCFinder('txtImages<?php echo ($key + 1);?>' 'image')" class="btn-browse"><input type="button" value="Xóa bỏ" class="btn-browse btn-delete-slide">							</td>						</tr>						<?php } } } ?>					</tbody>				</table>								<table border="0" cellspacing="1" cellpadding="0">					<tbody>						<tr>							<td style="width:168px;">Ảnh chi tiết</td>							<td style="padding: 5px 2px;">								<input type="button" value="Thêm mới" class="btn-input" id="btn-add-slide">							</td>						</tr>					</tbody>				</table>			<table cellspacing="0" cellpadding="0" class="form">				<?php				$error = validation_errors();				echo isset($error)?'<tr><td colspan="2"><ul class="cms-error">'.$error.'</ul></td></tr>':'';				?>				<tr>					<td class="label"><label for="txtTitle">Tên sản phẩm</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input type="text" name="data[title]" class="text" id="txtTitle" value="<?php echo (isset($post_data['title'])?$post_data['title']:'');?>" />					</td>				</tr>				<tr>					<td class="label"><label for="txtTitle">Url Config</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input type="text" name="data[url_config]" class="text" id="txtTitle" value="<?php echo (isset($post_data['url_config'])?$post_data['url_config']:'');?>" />					</td>				</tr>				<!--<tr>					<td class="label"><label for="txtSeries">Series</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input type="text" name="data[series]" class="text" id="txtSeries" value="<?php echo (isset($post_data['series'])?$post_data['series']:'');?>" />					</td>				</tr>				<tr>					<td class="label"><label for="txtReferencenumber">Reference Number</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input type="text" name="data[referencenumber]" class="text" id="txtReferencenumber" value="<?php echo (isset($post_data['referencenumber'])?$post_data['referencenumber']:'');?>" />					</td>				</tr>>-->				<tr>					<td class="label"><label for="txtRetail_price">Giá cũ</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input type="text" name="data[retail_price]" class="text" id="txtRetail_price" value="<?php echo (isset($post_data['retail_price'])?$post_data['retail_price']:'');?>" />					</td>				</tr>				<tr>					<td class="label"><label for="txtOur_rice">Giá bán</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input type="text" name="data[our_price]" class="text" id="txtOur_rice" value="<?php echo (isset($post_data['our_price'])?$post_data['our_price']:'');?>" />					</td>				</tr>				<tr>					<td class="label"><label for="txtViewed">Lượt xem</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input type="text" name="data[viewed]" class="text" id="txtViewed" value="<?php echo (isset($post_data['viewed'])?$post_data['viewed']:'');?>" />					</td>				</tr>				<tr>					<td class="label"><label for="txtbought">Lượt mua</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input type="text" name="data[bought]" class="text" id="txtbought" value="<?php echo (isset($post_data['bought'])?$post_data['bought']:'');?>" />					</td>				</tr>				<!--<tr>					<td class="label"><label for="txtPrice">Khuyến mãi</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input type="text" name="data[price]" class="text" id="txtPrice" value="<?php echo (isset($post_data['price'])?$post_data['price']:'');?>" />					</td>				</tr>-->				<tr>					<td class="label"><label for="txtParentid">Danh mục cha</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<?php echo form_dropdown('data[parentid]', (isset($show_data['parentid'])?$show_data['parentid']:NULL), (isset($post_data['parentid'])?(int)$post_data['parentid']:0),' id="txtParentid" class="select"');?>					</td>				</tr>				<tr>					<td class="label"><label for="txtlabelid">Chọn thương hiệu</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<select name="data[labelid]" id="txtlabelid" class="select">							<option value="0">Chọn thương hiệu</option>						<?php $list_label = helper_module_list_item('thuonghieu', '*', array('publish' => 1), 'order asc,id asc',12); ?>						<?php if(isset($list_label) && count($list_label)) { foreach ($list_label  as $key => $val) { ?>							<option value="<?php echo $val['id']; ?>" <?php if(isset($post_data['labelid'])) { echo ($val['id'] == $post_data['labelid'])?'selected':'';} ?>><?php echo $val['title']; ?></option>						<?php } } ?>						</select>					</td>				</tr>				<tr>					<td class="label"><label for="txtImage">Hình ảnh đại diện</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input type="text" name="data[image]" class="text" id="txtImage" value="<?php echo (isset($post_data['image'])?$post_data['image']:'');?>" />						<input type="button" value="Chọn ảnh" class="button" onclick="browseKCFinder('txtImage', 'image')"/>					</td>				</tr>								<tr>					<td class="label"><label for="txtTags">Chủ đề</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;position: relative;">						<input type="text" name="data[tags]" class="text" id="txtTags" value="<?php echo (isset($post_data['tags'])?$post_data['tags']:'');?>" style="width: 611px;" />						<input type="button" value="Gợi ý chủ đề" class="button" id="cms-tags-suggest-button"/>						<div id="tagspicker-suggest"></div>					</td>				</tr>				<tr>					<td class="label"><label for="txtColor">Màu sắc</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input placeholder="Điền danh sách màu sắc dạng Đỏ-Vàng-Xanh..." type="text" name="data[color_product]" class="text" id="txtColor" value="<?php echo (isset($post_data['color_product'])?$post_data['color_product']:'');?>" />					</td>				</tr>				<tr>					<td class="label"><label for="txtColor">Size</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input placeholder="Điền danh sách màu sắc dạng Size M-Size L-Size X..." type="text" name="data[size_product]" class="text" id="txtColor" value="<?php echo (isset($post_data['size_product'])?$post_data['size_product']:'');?>" />					</td>				</tr>				<tr>					<td class="label"><label for="txtLuuy">Text mở rộng</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;"><textarea name="data[luuy]" class="textarea wysiwygEditor" id="txtLuuy" style="height:168px;"><?php echo (isset($post_data['luuy'])?htmlspecialchars($post_data['luuy']):'');?></textarea></td>				</tr>				<tr>					<td class="label"><label for="txtDescription">Mô tả ngắn</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;"><textarea name="data[description]" class="textarea wysiwygEditor" id="txtDescription" style="height:168px;"><?php echo (isset($post_data['description'])?htmlspecialchars($post_data['description']):'');?></textarea></td>				</tr>				<!--<tr>					<td class="label"><label for="txtDiemnoibat">Điểm nổi bật</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;"><textarea name="data[diemnoibat]" class="textarea wysiwygEditor" id="txtDiemnoibat" style="height:168px;"><?php echo (isset($post_data['diemnoibat'])?htmlspecialchars($post_data['diemnoibat']):'');?></textarea></td>				</tr>-->				<tr>					<td class="label"><label for="txtContent">Nội dung chi tiết</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;"><textarea name="data[content]" class="textarea wysiwygEditor" id="txtContent" style="height:268px;"><?php echo (isset($post_data['content'])?htmlspecialchars($post_data['content']):'');?></textarea></td>				</tr>				<tr>					<td class="label"><label for="txtTitle">Thao tác</label></td>					<td class="content">						<?php echo isset($button_action)?$button_action:'';?>						<input type="reset" value="Thực hiện lại" class="button" />					</td>				</tr>			</table>		</div><!-- .main-container -->		<div class="cms-clear"></div>	</div><!-- .block -->	<div class="cms-clear"></div></div><!-- .panel-main --><div class="panel-info">	<div class="block">		<div class="main-title"><p>Tùy chọn</p></div>		<div class="main-container">			<table cellspacing="0" cellpadding="0" class="form">				<tr>					<td class="label label-option"><label for="">Xuất bản</label></td>					<td class="content" style="padding: 0px 0px 0px 0px;">						<input type="radio" name="data[publish]" value="0" class="radio" id="rbPublish_0" <?php echo ((isset($post_data['publish']) && $post_data['publish'] == 0)?'checked':'');?>/><label for="rbPublish_0">Không</label>						<input type="radio" name="data[publish]" value="1" class="radio" id="rbPublish_1" <?php echo ((isset($post_data['publish']) && $post_data['publish'] == 1)?'checked':'');?>/><label for="rbPublish_1">Có</label>					</td>				</tr>			</table>		</div>		<div class="cms-clear"></div>	</div><!-- .block -->	<div class="block">		<div class="main-title"><p>Meta</p></div>		<div class="main-container">			<table cellspacing="0" cellpadding="0" class="form">				<tr>					<td class="label" style="padding: 0px 0px 5px 0px;"><label for="txtMetaTitle">Meta Title</label></td>				</tr>				<tr>					<td class="content" style="padding: 0px 0px 10px 0px;"><input type="text" name="data[meta_title]" class="text" id="txtMetaTitle" value="<?php echo (isset($post_data['meta_title'])?$post_data['meta_title']:'');?>" /></td>				</tr>				<tr>					<td class="label" style="padding: 0px 0px 5px 0px;"><label for="txtMetaKeyword">Meta Keyword</label></td>				</tr>				<tr>					<td class="content" style="padding: 0px 0px 10px 0px;"><textarea name="data[meta_keyword]" class="textarea" id="txtMetaKeyword" style="height: 28px;"><?php echo (isset($post_data['meta_keyword'])?$post_data['meta_keyword']:'');?></textarea></td>				</tr>				<tr>					<td class="label" style="padding: 0px 0px 5px 0px;"><label for="txtMetaDescription">Meta Description</label></td>				</tr>				<tr>					<td class="content"><textarea name="data[meta_description]" class="textarea" id="txtMetaDescription"><?php echo (isset($post_data['meta_description'])?$post_data['meta_description']:'');?></textarea></td>				</tr>			</table>		</div>		<div class="cms-clear"></div>	</div><!-- .block -->	<div class="cms-clear"></div></div><!-- .panel-info --></form><script type="text/javascript" src="template/backend/js/jquery-1.7.1.min.js"></script><script type="text/javascript">$(document).ready(function(){	var total_item_form_slide = 0;	$('#btn-add-slide').click(function(){		var total_item = $('tr.slide-item').length;		var str = '';		str = str + '<tr class="slide-item">';		str = str + '<td style="width:168px;">Ảnh chi tiết - '+(total_item + 1)+'</td>';		str = str + '<td style="padding: 5px 0px 5px 0px;">';		str = str + '<input name="data[images][]" value="" type="text" placeholder="Hình ảnh" id="txtImages'+(total_item + 1)+'" class="text-input" style="background: #FFFFFF;border: 1px solid #CCC;font-size: 11px;padding: 5px 5px;margin: 0px;color: #333;width: 450px;">';		str = str + '<input type="button" value="Chọn ảnh" onclick="browseKCFinder(\'txtImages'+(total_item + 1)+'\' , \'image\')" class="btn-browse">';		str = str + '<input type="button" value="Xóa bỏ" class="btn-browse btn-delete-slide">';		str = str + '</td>';		str = str + '</tr>';		$('.slide-action').append(str);		$('.frm tr > td').removeClass('odd');		$('.frm tr:odd > td').addClass('odd');		return false;	});		$('.btn-delete-slide').click('click', function() {		alert('a');		var flag = confirm('Bạn có chắc chắn xóa?');		if(flag == true){			$(this).parent().parent().remove();		}		return false;	});});</script>