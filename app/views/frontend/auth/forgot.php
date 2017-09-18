<div class="article"><!-- promo content --> 
	<div class="promo-content clearfix"><!-- breadcrumbs -->
		<ul class="breadcrumb">
			<li><a href="/">Home</a></li><li> / </li><li><span style="color: #476d94;text-decoration: none;font-size: 16px;font-weight: normal;">My Account</span></li>
		</ul>
	</div><!-- account -->
	<div class="login-register clearfix">
		<h1>login or create an account</h1>
		<div class="form form-account cust-sel clearfix">
			<div class="col">
				<h2>new members</h2>
				<p>Enter your email address and choose a password to create a <br/>LuxuryBazaar.vn account.</p>
				
				<form action="" method="post">
				<div class="f-row">
					<label for="f1">User *</label>
					<div class="f-input">
						<input name="data[user]" type="text" id="tb_User"   value="<?php echo (isset($post_data_re['user'])?$post_data_re['user']:'');?>" placeholder="User Name"/>
					</div>
				</div>
				<div class="f-row">
					<label for="f1">Email Address *</label>
					<div class="f-input">
						<input name="data[email]" type="text" id="tb_Nemail"   value="<?php echo (isset($post_data_re['email'])?$post_data_re['email']:'');?>" placeholder="Email"/>
					</div>
				</div>
				<div class="f-row">
					<label for="f2">Password *</label>
					<div class="f-input"><input name="data[password]" type="password" id="tb_Npassword" /></div>
				</div>
				<div class="f-row">
					<label for="f2">Re-Password *</label>
					<div class="f-input"><input name="data[re_password]" type="password" id="tb_Nre_password" /></div>
				</div>
				<div class="f-row">
					<label for="f3">Full Name</label>
					<div class="f-input">
					<input name="data[fullname]" type="text" id="tb_fullName"  value="<?php echo (isset($post_data_re['fullname'])?$post_data_re['fullname']:'');?>" placeholder="Full Name"/></div>
				</div>
				<div class="f-row">
					<label for="f3">Address</label>
					<div class="f-input">
					<input name="data[address]" type="text" id="tb_address"  value="<?php echo (isset($post_data_re['address'])?$post_data_re['address']:'');?>" placeholder="Address" /></div>
				</div>
				<div class="f-row">
					<label for="f3">Phone</label>
					<div class="f-input">
					<input name="data[phone]" type="text" id="tb_phone"  value="<?php echo (isset($post_data_re['phone'])?$post_data_re['phone']:'');?>" placeholder="Phone" /></div>
				</div>
				<div class="f-buttons">
					<input type="submit" name="submit" class="submit" value="Đăng ký">
				</div>
				</form>
			</div>
			
			
			<div class="col fl-r"><h2>returning  members</h2><p>Enter your email address and password to sign in to your <br/>LuxuryBazaar.vn account.</p>
			<form action="" method="post">
				<?php
					$error = validation_errors();
					echo (isset($error)&&!empty($error))?'<script type="text/javascript">$(window).load(function(){ alert(\''.preg_replace('/[\n\r]+/', '', $error).'\');});</script>':'';
				?>
				<div class="f-row">
					<label for="f5">Email</label>
					<div class="f-input">
						<input name="data[email]" type="text" id="tb_rtemail"  value="<?php echo (isset($post_data_f['email'])?$post_data_f['email']:'');?>" placeholder="Email" />
					</div>
				</div>
				<div class="btn-spacer">&nbsp;</div>
				<div class="f-buttons">
					<input type="submit" name="forgot" class="submit" value="Gửi yêu cầu">
				</div>
			</form>
			</div>
		</div>
	</div>
</div>