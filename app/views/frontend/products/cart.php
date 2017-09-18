<section class="wrapper-breadcrumb">
	<section class="wrapper-breadcrumb-inner">
		<ul class="breadcrumb">
			<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
				<a rel="nofollow" href="." title="Home" itemprop="url"><span itemprop="title">Home</span></a>
			</li>
			<li class="spacebar">&raquo;</li>
			<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
				<a href="gio-hang.html" title="Cart" itemprop="url"><h1>Cart</h1></a>
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
		<div class="content">   
     <div class="primary">
		<h2 style="margin:10px 0px;">Giỏ hàng của bạn</h2>
		<div class="noi-dung-chi-tiet">
			<?php
			echo '<form class="frm" name="frmITQCMS" method="post" action="">';
			echo '<table width="100%" class="itq-your-cart">';
			echo '<tr>';
			echo '<th>STT</th>';
			echo '<th>Hình ảnh</th>';
			echo '<th>Tiêu đề</th>';
			echo '<th>Đơn giá</th>';
			echo '<th>Số lượng</th>';
			echo '<th>Thành tiền</th>';
			echo '<th>Thao tác</th>';
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
					echo '<td class="cart-number"><input style="width: 30px;padding: 5px 10px;" type="text" name="number['.$val['id'].$val['size'].']" value="'.$val['number'].'" /></td>';
					echo '<td class="cart-price">'.number_format($total_temp).' VNĐ</td>';
					echo '<td class="cart-remove"><a href="frontend/products/removetocart/'.$val['id'].CMS_SUFFIX.'?redirect='.base64_encode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']).'">Xóa bỏ</a></td>';
					echo '</tr>';
				}
			}
			else{
				die('<script type="text/javascript">alert(\'Chưa có sản phẩm trong giỏ hàng của bạn!\');location.href=\''.CMS_URL.'\';</script>');
			}
			echo '<tr>';
			echo '<td></td>';
			echo '<td></td>';
			echo '<td></td>';
			// echo '<td colspan="2" style="text-align:center;"><a class="a-cart" href=".">Mua tiếp</a></td>';
			echo '<td colspan="1" style="text-align:center;"><input style="padding: 5px 5px;" type="button" name="btnNumbr" value="Mua tiếp" onclick="location.href=\''.CMS_URL.'\';"></td>';
			echo '<td class="cart-control"><input type="submit" name="btnNumber" value="Cập nhật"></td>';
			echo '<td class="cart-price">'.number_format($total).' VNĐ</td>';
			echo '<td colspan="2" class="cart-control"><input style="padding: 5px 5px;" type="button" name="btnNumbr" value="Đặt hàng" onclick="location.href=\'frontend/products/payment\';"></td>';
			echo '</tr>';
			echo '</table>';
			echo '<div class="total-number">';
			echo '<p>Thành tiền: '.number_format($total).' VNĐ</p>';
			echo '<p>Bằng chữ: '.readNumber($total).'</p>';
			echo '</div>';
			echo '</form>';
			?>
		</div>
	</div> 
</div>
	</section>
</section>
