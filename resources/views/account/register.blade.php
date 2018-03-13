@extends('layouts.master')
@section('content')
<div class="main-breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li><a href="">Trang chủ</a></li>
					<li class="active">Đăng  ký tài khoản</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="account-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="form-style form-login">
					<form accept-charset="UTF-8" action="{!!route('postRegisterAccount')!!}" id="customer_register" method="post">
					{{ csrf_field() }}
					<h3 class="form-heading">Đăng ký tài khoản</h3>
					<p class="form-description">Nếu bạn có một tài khoản, xin vui lòng chuyển qua trang đăng nhập.</p>
					<div class="row">
						<div class="col-md-2">
							<p class="text-left">Họ và Tên *</p>
						</div>
						<div class="col-md-10">
							<input type="text" autofocus="" class="{{ $errors->has('FullName') ? ' has-error' : '' }}" name="FullName" requiredmsg="Vui lòng nhập đầy đủ Họ và Tên" placeholder="Nhập Họ và Tên">
							@if ($errors->has('FullName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('FullName') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p class="text-left">Email *</p>
						</div>
						<div class="col-md-10">
							<input type="email" class="{{ $errors->has('Email') ? ' has-error' : '' }}" name="Email"  requiredmsg="Vui lòng nhập địa chỉ Email" placeholder="Nhập địa chỉ Email">
							@if ($errors->has('Email'))
                                <span class="help-block">
                                    <strong>{{ ($errors->first('Email')=='The email has already been taken.') ? 'Email đã được đăng ký.' : $errors->first('Email') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p class="text-left">Mật khẩu *</p>
						</div>
						<div class="col-md-10">
							<input type="password" class="{{ $errors->has('Password') ? ' has-error' : '' }}"  requiredmsg="Vui lòng nhập Mật khẩu" name="Password" placeholder="Nhập mật khẩu">
							@if ($errors->has('Password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Password') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p class="text-left">Điện thoại</p>
						</div>
						<div class="col-md-10">
							<input type="text" value="" name="Phone" placeholder="Nhập Số điện thoại">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p class="text-left">Địa chỉ</p>
						</div>
						<div class="col-md-10">
							<input type="text" value="" name="Address" placeholder="Nhập địa chỉ liên hệ">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
						</div>
						<div class="col-md-10">
							<button class="btn-cart">Đăng ký</button>
							<p><a href="{!!route('getLoginAccount')!!}">Đăng nhập</a></p>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection()