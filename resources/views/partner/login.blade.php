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
<div class="partner-content">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div class="form-style form-login">
					<form accept-charset="UTF-8" action="{!!route('postLoginPartner')!!}" id="customer_login" method="post">
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
						<div class="col-md-2">
						</div>
						<div class="col-md-10">
							
							<button class="btn-cart">Đăng nhập</button>
							<p><a href="{!!route('getRegisterPartner')!!}">Đăng ký</a></p>
						</div>
					</div>
					</form>
				</div>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-5">
				<div class="form-style form-login">
					<form accept-charset="UTF-8" action="{!!route('sendResetLinkEmailPartner')!!}" id="recover_customer_password" method="post">
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
                        <script>alert('{{session('status')}}');</script>
                    @endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection()