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
			<div class="col-md-6">
				<div class="form-style form-login" style="padding: 0 0 50px 0;">
					<form accept-charset="UTF-8" action="{!!route('postLoginAccount')!!}" id="customer_login" method="post">
					{{ csrf_field() }}
					<h3 class="form-heading">Đăng nhập</h3>	
					<p class="help-block">{!!$msgLogin or ''!!}</p>				
					<div class="row">
						<div class="col-md-2">
							<p>Email*</p>
						</div>
						<div class="col-md-10">
							<input type="email" autofocus="" class="{{ $errors->has('Email') ? ' has-error' : '' }}" name="Email" required=""  requiredmsg="Vui lòng nhập địa chỉ Email" placeholder="Nhập địa chỉ Email">
							@if ($errors->has('Email'))
                                <span class="help-block">
                                    <strong>{{ ($errors->first('Email')=='The email has already been taken.') ? 'Email đã được đăng ký.' : $errors->first('Email') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p>Password*</p>
						</div>
						<div class="col-md-10">
							<input type="password" class="{{ $errors->has('Password') ? ' has-error' : '' }}"  requiredmsg="Vui lòng nhập Mật khẩu" name="Password" required="" placeholder="Nhập mật khẩu">
							@if ($errors->has('Password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Password') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button class="btn-cart">Đăng nhập</button>
							<p><a href="{!!route('getRegisterAccount')!!}">Đăng ký</a></p>
						</div>
						<div class="col-md-12">
							<div class="col-md-6">
					            <a id="facebook-login-button" href="{!!route('getLoginFb')!!}" style="color: #3b5998;border: 1px solid #3b5998;font-weight: 700;display: block;line-height: 36px;padding: 0 10px 0 0;text-decoration: none;cursor: pointer;">
					                <i class="fa fa-facebook" style="display: inline-block;padding:10px;background-color: blue;width: 38px;height: 36px;float: left;color: #fff;font-size: 18px;"></i>
					                <span style="margin-left: 10px;">Facebook</span>
					            </a>
					        </div>
					        <div class="col-md-6">
					            <a id="facebook-login-button" href="{!!route('getLoginGoogle')!!}" style="color: #3b5998;border: 1px solid #3b5998;font-weight: 700;display: block;line-height: 36px;padding: 0 10px 0 0;text-decoration: none;cursor: pointer;">
					                <i class="fa fa-google" style="display: inline-block;padding:10px;background-color: #ff0000;width: 38px;height: 36px;float: left;color: #fff;font-size: 18px;"></i>
					                <span style="margin-left: 10px;">Google</span>
					            </a>
					        </div>
						</div>
					</div>
					</form>
				</div>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-5">
				<div class="form-style form-login"  style="padding: 0 0 50px 0;">
					<form accept-charset="UTF-8" action="{!!route('sendResetLinkEmail')!!}" id="recover_customer_password" method="post">
					{{ csrf_field() }}
					<h3 class="form-heading">Quên mật khẩu</h3>
					<p>Nhập Email đăng ký để lấy lại mật khẩu.</p>
					<input type="email" value="" name="Email" placeholder="Nhập địa chỉ Email đã đăng ký">
					<button class="btn-cart">Gửi thông tin</button>					
					</form>
				 	@if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        <script>alert('{{ session('status') }}');</script>
                    @endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection()