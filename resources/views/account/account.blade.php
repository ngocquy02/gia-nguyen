@extends('layouts.master')
@section('content')
<div class="main-breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li><a href="#">Trang chủ</a></li>
					<li class="active">Đăng nhập</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="account-content">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div class="form-style form-login">
					<form accept-charset="UTF-8" action="/account/login" id="customer_login" method="post">
<input name="FormType" type="hidden" value="customer_login">
<input name="utf8" type="hidden" value="true">
					<h3 class="form-heading">Đăng nhập</h3>
					<p class="form-description">Nếu bạn có một tài khoản, xin vui lòng đăng nhập.</p>
					
					<div class="row">
						<div class="col-md-2">
							<p>Email*</p>
						</div>
						<div class="col-md-10">
							<input type="email" value="" name="email">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p>Password*</p>
						</div>
						<div class="col-md-10">
							<input type="password" value="" name="password">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
						</div>
						<div class="col-md-10">
							
							<button class="btn-cart">Đăng nhập</button>
							<p><a href="/account/register">Đăng ký</a></p>
						</div>
					</div>
					</form>
				</div>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-5">
				<div class="form-style form-login">
					<form accept-charset="UTF-8" action="/account/recover" id="recover_customer_password" method="post">
<input name="FormType" type="hidden" value="recover_customer_password">
<input name="utf8" type="hidden" value="true">
					<h3 class="form-heading">Quên mật khẩu</h3>
					<p class="form-description">Bạn đã có một tài khoản nhưng không nhớ mật khẩu.</p>
					<p>Hãy điền Email xuống phía dưới và nhận thông tin qua Email để có thể lấy lại mật khẩu.</p>
					
					
					<p>Email</p>
					<input type="email" value="" name="Email">
					<button class="btn-cart">Gửi thông tin</button>
					
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection()