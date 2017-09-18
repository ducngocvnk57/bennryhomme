<section class="wrapper-breadcrumb">
	<section class="wrapper-breadcrumb-inner">
		<ul class="breadcrumb">
			<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
				<a rel="nofollow" href="." title="Home" itemprop="url"><span itemprop="title">Home</span></a>
			</li>
			<li class="spacebar">&raquo;</li>
			<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
				<a href="gio-hang.html" title="Payment" itemprop="url"><h1>Payment</h1></a>
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
				
		<link rel="stylesheet" href="public/backend/plugin/validation/css/validationEngine.jquery.css" type="text/css"/>
		<script src="public/backend/plugin/validation/js/languages/jquery.validationEngine-vi.js" type="text/javascript" charset="utf-8"></script>
		<script src="public/backend/plugin/validation/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("#frmITQCMS").validationEngine();
			});
		</script>



		<div class="content">   
			 <div class="primary">
				<h2 style="margin:10px 0px;">Thanh toán mua hàng</h2>
				<div class="noi-dung-chi-tiet">
				
					<?php 
					$info_user = $this->lib_authentication->check_customer(); 
					if(isset($info_user)){
					echo '<form class="frm" id="frmITQCMS" name="frmITQCMS" method="post" action="">';
					echo '<table width="100%" class="itq-your-cart">';
					echo '<tr>';
					echo '<th>STT</th>';
					echo '<th>Hình ảnh</th>';
					echo '<th>Tiêu đề</th>';
					echo '<th>Cỡ</th>';
					echo '<th>Đơn giá</th>';
					echo '<th>Số lượng</th>';
					echo '<th>Thành tiền</th>';
					echo '</tr>';
					$total = 0;
					if(isset($full_data) && count($full_data)){
						foreach($full_data as $key => $val){
							$total_temp = 0;
							$total_temp = $val['price'] * $val['number'];
							$total = $total + $total_temp;
							echo '<tr>';
							echo '<td class="cart-num">'.($key+1).'</td>';
							echo '<td class="cart-image"><img src="'.$val['image'].'" alt="'.$val['title'].'" width="50"/></td>';
							echo '<td class="cart-title">'.$val['title'].'</td>';
							if($val['size'] == 1) {
								echo '<td class="cart-size">Size S</td>';
							}elseif($val['size'] == 2) {
								echo '<td class="cart-size">Size X</td>';
							}elseif($val['size'] == 3) {
								echo '<td class="cart-size">Size L</td>';
							}elseif($val['size'] == 4) {
								echo '<td class="cart-size">Size XL</td>';
							}else {
								echo '<td class="cart-size"> ---- </td>';
							}
							echo '<td class="cart-price">'.number_format($val['price']).' VNĐ</td>';
							echo '<td class="cart-number">'.$val['number'].'</td>';
							echo '<td class="cart-price">'.number_format($total_temp).' VNĐ</td>';
							echo '</tr>';
						}
					}
					else{
						die('<script type="text/javascript">alert(\'Chưa có sản phẩm trong giỏ hàng của bạn!\');location.href=\''.ITQ_URL.'\';</script>');
					}
					echo '<tr>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td class="cart-control"></td>';
					echo '<td class="cart-price">'.number_format($total).' VNĐ</td>';
					echo '</tr>';
					echo '</table>';
					echo '<div class="total-number">';
					echo '<p>Thành tiền: '.number_format($total).' VNĐ</p>';
					echo '<p>Bằng chữ: '.readNumber($total).'</p>';
					echo '</div>';
					$error = validation_errors();
					echo (isset($error) && !empty($error))?'<div class="itq-error">'.$error.'</div>':NULL;
					echo '<table width="100%" class="itq-your-info">';
					echo '<tr>';
					echo '<th colspan="2">Thông tin liên hệ</th>';
					echo '</tr>';
					echo '<tr>';
					echo '<td>Họ và tên</td>';
					echo '<td>Số di động</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="cart-input"><input placeholder="Họ và tên" type="text" name="data[fullname]" value="'.(isset($info_user['fullname'])?$info_user['fullname']:'').'" class="validate[required]" /></td>';
					echo '<td class="cart-input"><input placeholder="Số điện thoại" type="text" name="data[phone]" value="'.(isset($info_user['phone'])?$info_user['phone']:'').'" class="validate[required]" /></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td>Email</td>';
					echo '<td>Địa chỉ nhận hàng</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="cart-input"><input placeholder="Địa chỉ Email" type="text" name="data[email]" value="'.(isset($info_user['email'])?$info_user['email']:'').'" class="validate[required, custom[email]]" /></td>';
					echo '<td class="cart-input"><input placeholder="Địa chỉ nhận hàng" type="text" name="data[address]" value="'.(isset($info_user['address'])?$info_user['address']:'').'" class="validate[required]" /></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td colspan="2">Yêu cầu thêm / Ghi chú</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td colspan="2" class="cart-input"><textarea name="data[notes]">'.(isset($post_data['notes'])?$post_data['notes']:'').'</textarea></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td colspan="2" class="cart-submit"><input type="submit" name="submit" value="Gửi đơn hàng"></td>';
					echo '</tr>';
					echo '</table>';
					echo '</form>';
					}else{
					?>
					<?php
					echo '<form class="frm" id="frmITQCMS" name="frmITQCMS" method="post" action="">';
					echo '<table width="100%" class="itq-your-cart">';
					echo '<tr>';
					echo '<th>STT</th>';
					echo '<th>Hình ảnh</th>';
					echo '<th>Tiêu đề</th>';
					echo '<th>Đơn giá</th>';
					echo '<th>Số lượng</th>';
					echo '<th>Thành tiền</th>';
					echo '</tr>';
					$total = 0;
					if(isset($full_data) && count($full_data)){
						foreach($full_data as $key => $val){
							$total_temp = 0;
							$total_temp = $val['price'] * $val['number'];
							$total = $total + $total_temp;
							echo '<tr>';
							echo '<td class="cart-num">'.($key+1).'</td>';
							echo '<td class="cart-image"><img src="'.$val['image'].'" alt="'.$val['title'].'" width="50"/></td>';
							echo '<td class="cart-title">'.$val['title'].'</td>';
							echo '<td class="cart-price">'.number_format($val['price']).' VNĐ</td>';
							echo '<td class="cart-number">'.$val['number'].'</td>';
							echo '<td class="cart-price">'.number_format($total_temp).' VNĐ</td>';
							echo '</tr>';
						}
					}
					else{
						die('<script type="text/javascript">alert(\'Chưa có sản phẩm trong giỏ hàng của bạn!\');location.href=\''.ITQ_URL.'\';</script>');
					}
					echo '<tr>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td class="cart-control"></td>';
					echo '<td class="cart-price">'.number_format($total).' VNĐ</td>';
					echo '</tr>';
					echo '</table>';
					echo '<div class="total-number">';
					echo '<p>Thành tiền: '.number_format($total).' VNĐ</p>';
					echo '<p>Bằng chữ: '.readNumber($total).'</p>';
					echo '</div>';
					$error = validation_errors();
					echo (isset($error) && !empty($error))?'<div class="itq-error">'.$error.'</div>':NULL;
					echo '<table width="100%" class="itq-your-info">';
					echo '<tr>';
					echo '<th colspan="2">Thông tin liên hệ</th>';
					echo '</tr>';
					echo '<tr>';
					echo '<td>Họ và tên <span style="color:red;">(*)</span></td>';
					echo '<td>Số di động <span style="color:red;">(*)</span> <i>( Vui lòng nhập chính xác để chúng tôi liên hệ khi giao hàng. )</i></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="cart-input"><input type="text" name="data[fullname]" value="'.(isset($post_data['fullname'])?$post_data['fullname']:'').'" class="validate[required]" /></td>';
					echo '<td class="cart-input"><input type="text" name="data[phone]" value="'.(isset($post_data['phone'])?$post_data['phone']:'').'" class="validate[required]" /></td>';
					echo '</tr>';
					
					echo '<tr>';
					echo '<td>Hình thức thanh toán<span style="color:red;">(*)</span></td>';
					echo '<td>Hình thức nhận sản phẩm<span style="color:red;">(*)</span> <i>( Vui lòng nhập chính xác để chúng tôi liên hệ khi giao hàng. )</i></td>';
					echo '</tr>';
					echo '<td class="cart-input"><select name="data[httt]"><option value="Chuyển khoản">Chuyển khoản</option><option value="COD">COD</option><option value="Thanh toán tại Shop">Thanh toán tại Shop</option></select></td>';
					echo '<td class="cart-input"><select name="data[ctnh]"><option value="Nhận hàng tại Shop">Nhận hàng tại Shop</option><option value="Địa chỉ yêu cầu">Địa chỉ yêu cầu</option></select></td>';
					echo '</tr>';
					
					echo '<tr>';
					echo '<td>Email <span style="color:red;">(*)</span></td>';
					echo '<td>Địa chỉ nhận hàng <span style="color:red;">(*)</span> <i>( Vui lòng nhập chính xác địa chỉ để chúng tôi gửi hàng. )</i></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td class="cart-input"><input type="text" name="data[email]" value="'.(isset($post_data['email'])?$post_data['email']:'').'" class="validate[required, custom[email]]" /></td>';
					echo '<td class="cart-input"><input type="text" name="data[address]" value="'.(isset($post_data['address'])?$post_data['address']:'').'" class="validate[required]" /></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td colspan="2">Yêu cầu thêm / Ghi chú</td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td colspan="2" class="cart-input"><textarea name="data[notes]">'.(isset($post_data['notes'])?$post_data['notes']:'').'</textarea></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td colspan="2" class="cart-submit"><input type="submit" name="submit" value="Gửi đơn hàng"></td>';
					echo '</tr>';
					echo '</table>';
					echo '</form>';
					
					// echo '<table width="100%" class="itq-your-info">';
					// echo '<tr>';
					// echo '<th colspan="2">Đăng nhập vào hệ thống</th>';
					// echo '</tr>';
					// echo '<tr>';
					// echo '<td>Tài khoản</td>';
					// echo '<td>Mật khẩu</td>';
					// echo '</tr>';
					// echo '<tr>';
					// echo '<td class="cart-input"><input type="text" name="data[fullname]" value="'.(isset($post_data['fullname'])?$post_data['fullname']:'').'" class="validate[required]" /></td>';
					// echo '<td class="cart-input"><input type="text" name="data[phone]" value="'.(isset($post_data['phone'])?$post_data['phone']:'').'" class="validate[required]" /></td>';
					// echo '</tr>';
					// echo '<tr>';
					// echo '<td colspan="2">Yêu cầu thêm / Ghi chú</td>';
					// echo '</tr>';
					// echo '<tr>';
					// echo '<td colspan="2" class="cart-submit"><input type="submit" name="submit" value="Đăng nhập"></td>';
					// echo '</tr>';
					// echo '</table>';
					} ?>
				</div>
				<article class="text-support">
					<?php echo isset($this->system['text_support'])?($this->system['text_support']):NULL;?>
				</article>
			</div> 
		</div> 
	</section>
</section>

