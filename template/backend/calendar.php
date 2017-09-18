<?php
// echo ceil(8%7);
// die();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Admin Control Cpanel</title>
<link href="css/normalize.css" rel="stylesheet" type="text/css" />
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/responsive.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="cms-wrapper">
	<div id="cms-header">
		<p class="title">Hệ thống quản trị dữ liệu</p>
	</div><!-- #cms-header -->
	
	<div id="cms-navigation">
		<div class="left">
			<ul class="main">
				<li class="main">
					<a href="#" class="main">Hệ thống</a>
					<ul class="item">
						<li class="item"><a href="#" class="item">Thông tin tài khoản</a></li>
						<li class="item"><a href="#" class="item">Cấu hình hệ thống</a></li>
						<li class="item"><a href="#" class="item">Đăng xuất</a></li>
					</ul>
				</li>
				<li class="main">
					<a href="#" class="main main-current">Khách hàng</a>
					<ul class="item">
						<li class="item"><a href="#" class="item">Quản lý khách hàng</a></li>
						<li class="item"><a href="#" class="item">Thêm khách hàng mới</a></li>
					</ul>
				</li>
				<li class="main"><a href="#" class="main">Domain</a></li>
				<li class="main"><a href="#" class="main">Hosting</a></li>
				<li class="main"><a href="#" class="main">Seo</a></li>
			</ul>
		</div><!-- .left -->
		<div class="right">
			<ul class="main">
				<li class="main main-text">Chào <span>Lê Thanh Hải</span></li>
				<li class="main"><a href="#" class="main">Thông tin</a></li>
				<li class="main"><a href="#" class="main">Đăng xuất</a></li>
			</ul>
		</div><!-- .right -->
		<div class="cms-clear"></div>
	</div><!-- #cms-navigation -->

	<div id="cms-tab">
		<p class="title">Hệ thống quản trị dữ liệu</p>
		<ul class="main">
			<li class="main"><a href="#" class="main">Tháng 05/2013</a></li>
			<li class="main"><a href="#" class="main current">Tháng 06/2013</a></li>
			<li class="main"><a href="#" class="main">Tháng 07/2013</a></li>
		</ul>
		<div class="cms-clear"></div>
	</div><!-- #cms-tab -->

	<div id="cms-container">
		<div id="cms-table" style="margin:0px;">
			<?php


			if(!function_exists('total_day_of_month')){
				function total_day_of_month($month = NULL, $year = NULL){
					if($month == 2){
						if($year % 4 == 0) return 29;
						else return 28;
					}
					if(in_array($month, array(1,3,5,7,8,10,12))) return 31;
					if(in_array($month, array(4,6,9,11))) return 30;
				}
			}

			if(!function_exists('no_of_month')){
				function no_of_month($day = NULL, $month = NULL, $year = NULL){
					return gmdate('N', strtotime($day.'-'.$month.'-'.$year) + 7*3600);
				}
			}

			if(!function_exists('position_cell')){
				function position_cell($cell){
					$cell = $cell + 1;
					$row = ceil($cell/7);
					$col = ceil($cell%7); $col = ($col == 0)?7:$col;
					return array('row' => $row, 'col' => $col);
				}
			}

			// Ngày hiện tại
			$day = gmdate('d', time() + 7*3600);
			$month = gmdate('m', time() + 7*3600);
			$year = gmdate('Y', time() + 7*3600);
			$time = strtotime($year.'-'.$month.'-'.$day);
			$total = total_day_of_month($month, $year);
			$start = no_of_month(1, $month, $year);
			
			// Tháng trước
			$month_prev = date('m', strtotime('-1 month', $time));
			$year_prev = date('Y', strtotime('-1 month', $time));
			$total_prev = total_day_of_month($month_prev, $year_prev);
			
			// Tháng sau
			$month_next = date('m', strtotime('+1 month', $time));
			$year_next = date('Y', strtotime('+1 month', $time));
			
			// Những ngày cuối cùng của tháng trước được gán vào tháng hiện tại
			$arr_prev = NULL;
			for($i = ($total_prev - $start + 1); $i <= $total_prev; $i++){
				$arr_prev[] = $i;
			}
			?>
			<table cellspacing="0" cellpadding="0" class="calendar">
				<tr>
					<th><span class="date">Chủ nhật</span></th>
					<th>Thứ hai</th>
					<th>Thứ ba</th>
					<th>Thứ tư</th>
					<th>Thứ năm</th>
					<th>Thứ sáu</th>
					<th class="last">Thứ bảy</th>
				</tr>
				<?php
				$cell = 0; // Số ô
				$current_day = ''; $sunday = ''; $saturday = ''; // Hiện tại + Chủ nhật + Thứ bảy
				$first = 0; // Sử dụng để làm dữ liệu bắt đầu cho dòng thứ 2
				if($start < 7){ // Dòng đầu tiên
					echo '<tr>';
					for($i = 1; $i <= 7; $i++){
						$position = position_cell($cell);
						if($i == 1) $sunday = 'first '; if($i == 7) $saturday = 'last '; // Chủ nhật + Thứ bảy
						if($i <= $start){ // Những ngày cuối cùng của tháng trước
							$prev = $arr_prev[($i-1)];
							echo '<td class="'.$sunday.$saturday.'prev col-'.$position['col'].' row-'.$position['row'].'">';
							echo '<span class="date">'.$prev.'/'.$month_prev.'</span>';
							echo '</td>';
						}
						else{ // Những ngày đầu tiên của tháng hiện tại
							$first = ($i-$start);
							if($first.'/'.$month.'/'.$year == $day.'/'.$month.'/'.$year) $current_day = 'current '; // Hiện tại
							echo '<td class="'.$current_day.$sunday.$saturday.'col-'.$position['col'].' row-'.$position['row'].'">';
							echo '<span class="date">'.$first.'</span>';
							echo '</td>';
						}
						$cell++;
						$current_day = ''; $sunday = ''; $saturday = '';
					}
					echo '</tr>';
				}
				$n = 0; // Bắt đầu dòng thứ 2 và đi đến hết tháng hiện tại
				for($i = ($first+1); $i <= $total; $i++){
					$position = position_cell($cell);
					if(($n + 1) % 7 == 0) $saturday = 'last '; if($n % 7 == 0) $sunday = 'first '; if($i.'/'.$month.'/'.$year == $day.'/'.$month.'/'.$year) $current_day = 'current '; // Hiện tại + Chủ nhật + Thứ bảy
					if($cell == 28){ // Nếu dòng cuối
						if($n > 0 && $n % 7 == 0){ echo '</tr><tr class="last">'; $n = 0; } // Nếu cuối dòng thì đóng thẻ
					}
					else{
						if($n > 0 && $n % 7 == 0){ echo '</tr><tr>'; $n = 0; } // Nếu cuối dòng thì đóng thẻ
					}
					echo '<td class="'.$current_day.$sunday.$saturday.'col-'.$position['col'].' row-'.$position['row'].'">';
					echo '<span class="date">'.$i.'</span>';
					echo '</td>';
					$n++;
					$cell++;
					$current_day = ''; $sunday = ''; $saturday = '';
				}
				$next = 1; // Bắt đầu tháng tiếp theo
				for($i = $n; $i < 7; $i++){
					$position = position_cell($cell);
					if($i == 0) $sunday = 'first '; if($i == 6) $saturday = 'last '; // Chủ nhật + Thứ bảy
					echo '<td class="'.$sunday.$saturday.'next col-'.$position['col'].' row-'.$position['row'].'">';
					echo '<span class="date">'.$next.'/'.$month_next.'</span>';
					echo '</td>';
					$next++;
					$cell++;
					$current_day = ''; $sunday = ''; $saturday = '';
				}
				echo '</tr>';
				?>
			</table>
		</div><!-- #cms-table -->
		<div class="cms-clear"></div>
	</div><!-- #cms-container -->

	<div id="cms-copyright">
		<p>Copyright 2014 - <a href="#">SIMPLE ITQ CMS</a></p>
		<div class="cms-clear"></div>
	</div><!-- #cms-copyright -->

	<div class="cms-clear"></div>
</div><!-- #cms-wrapper -->
</body>
</html>
