<form method="post" action=""><div class="panel-main">	<div class="block">		<div class="main-title"><p>Thông tin lockbook</p></div>		<div class="main-container">			<table cellspacing="0" cellpadding="0" class="form">				<?php				$error = validation_errors();				echo isset($error)?'<tr><td colspan="2"><ul class="cms-error">'.$error.'</ul></td></tr>':'';				?>				<tr>					<td class="label"><label for="txtTitle">Tên lockbook</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input type="text" name="data[title]" class="text" id="txtTitle" value="<?php echo (isset($post_data['title'])?$post_data['title']:'');?>" />					</td>				</tr>				<tr>					<td class="label"><label for="txtTitle">Url Config</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input type="text" name="data[url_config]" class="text" id="txtTitle" value="<?php echo (isset($post_data['url_config'])?$post_data['url_config']:'');?>" />					</td>				</tr>				<tr>					<td class="label"><label for="txtViewed">Lượt xem</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input type="text" name="data[viewed]" class="text" id="txtViewed" value="<?php echo (isset($post_data['viewed'])?$post_data['viewed']:'');?>" />					</td>				</tr>				<tr>					<td class="label"><label for="txtParentid">Danh mục cha</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<?php echo form_dropdown('data[parentid]', (isset($show_data['parentid'])?$show_data['parentid']:NULL), (isset($post_data['parentid'])?(int)$post_data['parentid']:0),' id="txtParentid" class="select"');?>					</td>				</tr>				<tr>					<td class="label"><label for="txtImage">Hình ảnh đại diện</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;">						<input type="text" name="data[image]" class="text" id="txtImage" value="<?php echo (isset($post_data['image'])?$post_data['image']:'');?>" />						<input type="button" value="Chọn ảnh" class="button" onclick="browseKCFinder('txtImage', 'image')"/>					</td>				</tr>				<tr>					<td class="label"><label for="txtDescription">Mô tả ngắn</label></td>					<td class="content" style="padding: 0px 0px 10px 0px;"><textarea name="data[description]" class="textarea wysiwygEditor" id="txtDescription" style="height:168px;"><?php echo (isset($post_data['description'])?htmlspecialchars($post_data['description']):'');?></textarea></td>				</tr>				<tr>					<td class="label"><label for="txtTitle">Thao tác</label></td>					<td class="content">						<?php echo isset($button_action)?$button_action:'';?>						<input type="reset" value="Thực hiện lại" class="button" />					</td>				</tr>			</table>		</div><!-- .main-container -->		<div class="cms-clear"></div>	</div><!-- .block -->	<div class="cms-clear"></div></div><!-- .panel-main --><div class="panel-info">	<div class="block">		<div class="main-title"><p>Tùy chọn</p></div>		<div class="main-container">			<table cellspacing="0" cellpadding="0" class="form">				<tr>					<td class="label label-option"><label for="">Xuất bản</label></td>					<td class="content" style="padding: 0px 0px 0px 0px;">						<input type="radio" name="data[publish]" value="0" class="radio" id="rbPublish_0" <?php echo ((isset($post_data['publish']) && $post_data['publish'] == 0)?'checked':'');?>/><label for="rbPublish_0">Không</label>						<input type="radio" name="data[publish]" value="1" class="radio" id="rbPublish_1" <?php echo ((isset($post_data['publish']) && $post_data['publish'] == 1)?'checked':'');?>/><label for="rbPublish_1">Có</label>					</td>				</tr>			</table>		</div>		<div class="cms-clear"></div>	</div><!-- .block -->	<div class="block">		<div class="main-title"><p>Meta</p></div>		<div class="main-container">			<table cellspacing="0" cellpadding="0" class="form">				<tr>					<td class="label" style="padding: 0px 0px 5px 0px;"><label for="txtMetaTitle">Meta Title</label></td>				</tr>				<tr>					<td class="content" style="padding: 0px 0px 10px 0px;"><input type="text" name="data[meta_title]" class="text" id="txtMetaTitle" value="<?php echo (isset($post_data['meta_title'])?$post_data['meta_title']:'');?>" /></td>				</tr>				<tr>					<td class="label" style="padding: 0px 0px 5px 0px;"><label for="txtMetaKeyword">Meta Keyword</label></td>				</tr>				<tr>					<td class="content" style="padding: 0px 0px 10px 0px;"><textarea name="data[meta_keyword]" class="textarea" id="txtMetaKeyword" style="height: 28px;"><?php echo (isset($post_data['meta_keyword'])?$post_data['meta_keyword']:'');?></textarea></td>				</tr>				<tr>					<td class="label" style="padding: 0px 0px 5px 0px;"><label for="txtMetaDescription">Meta Description</label></td>				</tr>				<tr>					<td class="content"><textarea name="data[meta_description]" class="textarea" id="txtMetaDescription"><?php echo (isset($post_data['meta_description'])?$post_data['meta_description']:'');?></textarea></td>				</tr>			</table>		</div>		<div class="cms-clear"></div>	</div><!-- .block -->	<div class="cms-clear"></div></div><!-- .panel-info --></form><script type="text/javascript" src="template/backend/js/jquery-1.7.1.min.js"></script><script type="text/javascript">$(document).ready(function(){	var total_item_form_slide = 0;	$('#btn-add-slide').click(function(){		var total_item = $('tr.slide-item').length;		var str = '';		str = str + '<tr class="slide-item">';		str = str + '<td style="width:168px;">Ảnh chi tiết - '+(total_item + 1)+'</td>';		str = str + '<td style="padding: 5px 0px 5px 0px;">';		str = str + '<input name="data[images][]" value="" type="text" placeholder="Hình ảnh" id="txtImages'+(total_item + 1)+'" class="text-input" style="background: #FFFFFF;border: 1px solid #CCC;font-size: 11px;padding: 5px 5px;margin: 0px;color: #333;width: 450px;">';		str = str + '<input type="button" value="Chọn ảnh" onclick="browseKCFinder(\'txtImages'+(total_item + 1)+'\' , \'image\')" class="btn-browse">';		str = str + '<input type="button" value="Xóa bỏ" class="btn-browse btn-delete-slide">';		str = str + '</td>';		str = str + '</tr>';		$('.slide-action').append(str);		$('.frm tr > td').removeClass('odd');		$('.frm tr:odd > td').addClass('odd');		return false;	});		$('.btn-delete-slide').click('click', function() {		alert('a');		var flag = confirm('Bạn có chắc chắn xóa?');		if(flag == true){			$(this).parent().parent().remove();		}		return false;	});});</script>