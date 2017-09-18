<style type="text/css">
table.info-cus{
	border-collapse:collapse;
	width: 100%;
}
table.info-cus tr td{
	border:1px solid #dcdcdc;
	padding:10px 10px;
	vertical-align:middle;
	background:#FFF;
}
table.itq-your-cart{
	border-collapse:collapse;
	width: 100%;
}
table.itq-your-cart tr th{
	text-align:center;
	padding:10px 10px;
	border-top:2px solid #fdb817;
	border:1px solid #dcdcdc;
	text-transform:uppercase;
}
table.itq-your-cart tr td{
	border:1px solid #dcdcdc;
	padding:10px 10px;
	vertical-align:middle;
	background:#FFF;
}
table.itq-your-cart tr td.cart-num{
	text-align:center;
}
table.itq-your-cart tr td.cart-title{
	text-align:left;
}
table.itq-your-cart tr td.cart-price{
	text-align:right;
}
table.itq-your-cart tr td.cart-number{
	text-align:center;
}
table.itq-your-cart tr td.cart-number input{
	width:50px;
	text-align:right;
	padding:3px 5px;
	border:1px solid #ccc;
	background: url(../images/bg-inputms.png) left top repeat-x;
}
table.itq-your-cart tr td.cart-remove{
	text-align:center;
}
table.itq-your-cart tr td.cart-remove a{
}
table.itq-your-cart tr td.cart-remove a:hover{
	text-decoration:underline;
}
table.itq-your-cart tr td.cart-control{
	text-align:center;
}
table.itq-your-cart tr td.cart-control input{
	padding:5px 5px;
}
table.itq-your-cart tr td.cart-control a{
}
table.itq-your-cart tr td.cart-control a:hover{
	text-decoration:underline;
}
div.total-number{
	background:#FFF;
	border: 1px solid #dcdcdc;
	border-top:none;
	padding: 5px 10px 0px 10px;
	text-align: right;
}
div.total-number p{
	padding: 0px 0px 5px 0px;
	line-height: 150%;
}
</style>
<div class="top-main"><p>Thông tin khách hàng</p></div><!--.top-main-->
<div class="middle-main">
	<form class="frm" name="frmITQCMS" method="post" action="">
		<table border="0" cellspacing="1" cellpadding="0" class="info-cus">
		<tbody>
			<tr>
				<td>Họ và tên: <?php echo isset($post_data['fullname'])?htmlspecialchars($post_data['fullname']):'';?></td>
				<td>Phone: <?php echo isset($post_data['phone'])?htmlspecialchars($post_data['phone']):'';?></td>
			</tr>
			<tr>
				<td>Email: <?php echo isset($post_data['email'])?htmlspecialchars($post_data['email']):'';?></td>
				<td>Địa chỉ: <?php echo isset($post_data['address'])?htmlspecialchars($post_data['address']):'';?></td>
			</tr>
			<tr>
				<td>Hình thức thanh toán: <?php echo isset($post_data['httt'])?htmlspecialchars($post_data['httt']):'';?></td>
				<td>Địa chỉ nhận hàng: <?php echo isset($post_data['ctnh'])?htmlspecialchars($post_data['ctnh']):'';?></td>
			</tr>
			<tr>
				<td colspan="2"><?php echo isset($post_data['notes'])?htmlspecialchars($post_data['notes']):'';?></td>
			</tr>
		</tbody>
		</table>
	</form>
	<div class="cleare-fix"></div>
</div><!--.middle-main-->
<div class="bottom-main"></div><!--.middle-main-->
<div class="top-main"><p>Chi tiết đơn hàng</p></div><!--.top-main-->
<div class="middle-main">
	<form class="frm" name="frmITQCMS" method="post" action="">
		<table border="0" cellspacing="1" cellpadding="0" class="itq-your-cart">
			<tbody>

				<?php
				echo '<tr>';
				echo '<th>STT</th>';
				echo '<th>Tiêu đề</th>';
				echo '<th>Hình ảnh</th>';
				echo '<th>Size</th>';
				echo '<th>Màu</th>';
				echo '<th>Đơn giá</th>';
				echo '<th>Số lượng</th>';
				echo '<th>Thành tiền</th>';
				echo '</tr>';
				$total = 0;
				$full_data = !empty($post_data['data'])?json_decode($post_data['data'], TRUE):NULL;
				// print_r($full_data);die;
				if(isset($full_data) && count($full_data)){
					foreach($full_data as $key => $val){
						$total_temp = 0;
						$total_temp = $val['price'] * $val['number'];
						$total = $total + $total_temp;
						echo '<tr>';
						echo '<td class="cart-num">'.($key+1).'</td>';
						echo '<td class="cart-title">'.$val['title'].'</td>';
						echo '<td style="text-align:center;"><a target="_blank" href="http://benryhomme.com/frontend/products/item/'.$val['id'].'"><img style="width:80px;height:auto;" src="'.$val['image'].'"></a></td>';
						if($val['size'] == 1) {
							echo '<td class="cart-size">Size S</td>';
						}elseif($val['size'] == 2) {
							echo '<td class="cart-size">Size X</td>';
						}elseif($val['size'] == 3) {
							echo '<td class="cart-size">Size L</td>';
						}elseif($val['size'] == 4) {
							echo '<td class="cart-size">Size XL</td>';
						}elseif($val['size'] == 5) {
							echo '<td class="cart-size">Size XXL</td>';
						}elseif($val['size'] == 6) {
							echo '<td class="cart-size">Size M</td>';
						}else {
							echo '<td class="cart-size"> ---- </td>';
						}
						echo '<td class="cart-number">'.$val['color'].'</td>';
						echo '<td class="cart-price">'.number_format($val['price']).' VNĐ</td>';
						echo '<td class="cart-number">'.$val['number'].'</td>';
						echo '<td class="cart-price">'.number_format($total_temp).' VNĐ</td>';
						echo '</tr>';
					}
				}
				echo '<tr>';
				echo '<td></td>';
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
				?>
			</tbody>
		</table>
	</form>
	<div class="cleare-fix"></div>
</div><!--.middle-main-->
<div class="bottom-main"></div><!--.middle-main-->