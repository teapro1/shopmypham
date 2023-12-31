<?php echo form_open('dang-ky'); ?>
<section id="product-detail">
	<div class="container">
		<div class="col-md-3 col-sm-3 hidden-xs"></div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="products-wrap">
				<div class="accordion accordion-lg divcenter nobottommargin clearfix" style="max-width: 550px;">
					<div id="register">
						<br>
						<div class="acctitle acctitlec">ĐĂNG KÝ TÀI KHOẢN</div>
						<?php 
						if(isset($success))
							echo '<h5 style="color: #0f9ed8; line-height: 25px; padding-left: 30px;">'.$success.'</h5>';
						?>
						<div class="acc_content clearfix" style="display: block;">
							<form accept-charset="UTF-8" action="" id="customer_register" method="post">
								
								<input name="FormType" type="hidden" value="customer_register">
								<input name="utf8" type="hidden" value="true"> 
								<div class="col_full">
									<label for="first_name">Tên Đăng Nhập: <span class="require_symbol">*</span></label>
									<input type="text" id="first_name" name="username" value="" class="form-control" placeholder="Tên Đăng Nhập...">
									<div class="error" id="username_error"><?php echo form_error('username')?></div>
								</div> 
								<div class="col_full">
									<label for="register-form-password">Mật Khẩu: <span class="require_symbol">*</span></label>
									<input type="password" id="register-form-password" name="password" placeholder="Mật Khẩu..." class="form-control">
									<div class="error" id="password_error"><?php echo form_error('password')?></div>
								</div>

								<div class="col_full">
									<label for="register-form-repassword">Nhập Lại Mật Khẩu: <span class="require_symbol">* </span></label>
									<input type="password" id="register-form-repassword" name="re_password" value="" class="form-control" placeholder="Nhập Lại Mật Khẩu...">
									<div class="error" id="re_password_error"><?php echo form_error('re_password')?></div>
								</div>
								<div class="col_full">
									<label for="first_name">Họ Và Tên: <span class="require_symbol">*</span></label>
									<input type="text" id="first_name" name="name" placeholder="Họ Và Tên..." class="form-control">
									<div class="error" id="name_error"><?php echo form_error('name')?></div>
								</div>              
								<div class="col_full">
									<label for="register-form-email">Email: <span class="require_symbol">*</span></label>
									<input type="text" id="register-form-email" name="email" class="form-control" placeholder="Nhập Email...">
									<div class="error" id="email_error"><?php echo form_error('email')?></div>
								</div>
								<div class="col_full">
									<label for="first_name">Số Điện Thoại: <span class="require_symbol">*</span></label>
									<input type="text" id="first_name" name="phone" placeholder="Số Điện Thoại..." class="form-control">
									<div class="error" id="name_error"><?php echo form_error('phone')?></div>
								</div>
								<div class="col_full nobottommargin">
									<button class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" type="submit" style="margin-bottom: 20px">Đăng Ký</button>
									<ul>
										<li class="right" style="font-size: 18px;">Nếu Quý Khách Đã Có Tài Khoản, Hãy <a href="<?php echo base_url()?>dang-nhap" style="font-size: 19px; color: #0f9ed8;">Đăng Nhập</a></li>
									</ul>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-3 hidden-xs"></div>
	</div>
</section>
