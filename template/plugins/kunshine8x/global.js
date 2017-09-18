$(window).load(function(){
	var _this = '';
	var _temp = '';
	/* ======================== */
	$('#'+menu_active).addClass('main-select');
	/* ======================== */
	_resize();
	$(window).resize(function() {
		_resize();
	});
	function _resize(){
		var cms_max_width = (($(window).width() > 1230) ? $(window).width() : 1230);
		$('#cms-form').css({'width' : cms_max_width - 35});
		$('#cms-form .panel-main').css({'width' : (cms_max_width - $('#cms-form .panel-info').width() - 45)});
	}
	/* ======================== */
	// Filter
	$('#txtFilterParentid').change(function(){
		$('#frmFilter').submit();
		return false;
	});
	/* ======================== */
	// Tags suggest
	$('#cms-tags-suggest-button').click(function(){
		if($('#tagspicker-suggest').is(':hidden')){
			$('#tagspicker-suggest').show();
			$('#tagspicker-suggest').html('<p><img src="http://www.ajaxload.info/images/exemples/2.gif" />Đang tải dữ liệu...</p>');
			$.post(cms_url+cms_backend+'/tags/suggest.html', function(data){
				$('#tagspicker-suggest').width(668);
				$('#tagspicker-suggest').html(data);
			});
		}
		else{
			$('#tagspicker-suggest').width(168);
			$('#tagspicker-suggest').hide();
			$('#tagspicker-suggest').html('');
		}
		return false;
	});
	$('#tagspicker-suggest').on('click', '.title a', function (){
		_this = $(this);
		$('#tagspicker-suggest').width(168);
		$('#tagspicker-suggest').html('<p><img src="http://www.ajaxload.info/images/exemples/2.gif" />Đang tải dữ liệu...</p>');
		$.post(_this.attr('href'), function(data){
			$('#tagspicker-suggest').width(668);
			$('#tagspicker-suggest').html(data);
		});
		return false;
	});
	$('#tagspicker-suggest').on('click', '.suggest a', function (){
		_this = $(this);
		_temp = $('#txtTags').val();
		$('#txtTags').val('Đang tải dữ liệu...');
		$.post(cms_url+cms_backend+'/tags/insert.html', {item: _this.attr('title'), list: _temp}, function(data){
			$('#txtTags').val(data);
		});
		return false;
	});
	
	
	/* ======================== */
	// Sort
	$('.cms-sort-ajax').click(function(){
		_this = $(this);
		$('#cms-mask').show();
		$.post(_this.attr('href'), function(data){
			$('#cms-mask').hide();
			location.reload();
		});
		return false;
	});
	// Set
	$('.cms-set-ajax').click(function(){
		_this = $(this);
		$('#cms-mask').show();
		$.post(_this.attr('href'), function(data){
			if(data == 0){
				_this.find('img').attr('src', 'template/backend/images/uncheck.png');
			}
			else if(data == 1){
				_this.find('img').attr('src', 'template/backend/images/check.png');
			}
			$('#cms-mask').hide();
		});
		return false;
	});
	// Check id
	$('#check-all').click(function(){
		if($(this).prop('checked')){
			$('.check-all').prop('checked', true).parent().parent().find('td').addClass('select');
		}
		else{
			$('.check-all').prop('checked', false).parent().parent().find('td').removeClass('select');
		}
	});
	// Check class
	$('.check-all').click(function(){
		if($(this).prop('checked') == false){
			$(this).parent().parent().find('td').removeClass('select');
			$('#check-all').prop('checked', false);
		}
		else{
			$(this).parent().parent().find('td').addClass('select');
		}
		if($('.check-all:checked').length == $('.check-all').length){
			$('#check-all').prop('checked', true);
		}
		
	});
	// Order
	$('.cms-order-ajax').click(function(){
		_this = $(this);
		$('#cms-mask').show();
		$.post(cms_url+cms_backend+'/common/order/'+_this.attr('name')+'.html', $('#frmView').serialize(), function(data){
			$('#cms-mask').hide();
			location.reload();
		});
		return false;
	});
	// Publish
	$('.cms-publish-ajax').click(function(){
		_this = $(this);
		if($('.check-all:checked').length == 0){
			alert('Bạn chưa chọn đối tượng.');
			return false;
		}
		$('#cms-mask').show();
		$.post(cms_url+cms_backend+'/common/publish/'+_this.attr('name')+'.html', $('#frmView').serialize(), function(data){
			$('#cms-mask').hide();
			location.reload();
		});
		return false;
	});
	// unPublish
	$('.cms-unpublish-ajax').click(function(){
		_this = $(this);
		if($('.check-all:checked').length == 0){
			alert('Bạn chưa chọn đối tượng.');
			return false;
		}
		$('#cms-mask').show();
		$.post(cms_url+cms_backend+'/common/unpublish/'+_this.attr('name')+'.html', $('#frmView').serialize(), function(data){
			$('#cms-mask').hide();
			location.reload();
		});
		return false;
	});
	// Xóa các module đơn lẻ
	$('.cms-delete-ajax').click(function(){
		_this = $(this);
		if($('.check-all:checked').length == 0){
			alert('Bạn chưa chọn đối tượng.');
			return false;
		}
		if(confirm('Đối tượng bạn lựa chọn sẽ bị xóa?\n\n==[HÃY THẬT CẨN THẬN VỚI THAO TÁC NÀY!]==')){
			$('#cms-mask').show();
			$.post(cms_url+cms_backend+'/common/delete/'+_this.attr('name')+'.html', $('#frmView').serialize(), function(data){
				$('#cms-mask').hide();
				location.reload();
			});
			return false;
		}
	});
	// Xóa chuyên mục
	$('.cms-delete-category-ajax').click(function(){
		_this = $(this);
		if($('.check-all:checked').length == 0){
			alert('Bạn chưa chọn đối tượng.');
			return false;
		}
		if(confirm('Đối tượng bạn lựa chọn sẽ bị xóa?\n\n==[HÃY THẬT CẨN THẬN VỚI THAO TÁC NÀY!]==')){
			$('#cms-mask').show();
			$.post(cms_url+cms_backend+'/common/deletecategory/'+_this.attr('name')+'.html', $('#frmView').serialize(), function(data){
				$('#cms-mask').hide();
				if(data != ''){
					alert(data);
				}
				location.reload();
			});
			return false;
		}
	});
});
$(document).ready(function(){});
$(document).mouseup(function(e){
	var container = $('#tagspicker-suggest');
	if (!container.is(e.target) && container.has(e.target).length === 0){
		$('#tagspicker-suggest').width(168);
		$('#tagspicker-suggest').html('').hide();
	}
});