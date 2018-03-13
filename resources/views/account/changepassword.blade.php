@extends('layouts.master')
@section('content')
<div class="main-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="">Trang chủ</a></li>
                    <li class="active">Thay đổi mật khẩu</li>
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
                    <form accept-charset="UTF-8" action="{!!route('postPasswordReset')!!}" id="customer_register" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="Token" value="{!!$Token!!}">
                    <input type="hidden" name="Email" value="{!!$Email!!}">
                    <h3 class="form-heading">Thay đổi mật khẩu tài khoản</h3>
                    <p class="form-description">Nếu bạn đã nhớ mật khẩu, xin vui lòng chuyển qua trang đăng nhập.</p>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-2">
                            <p class="text-left">Mật khẩu *</p>
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
                            <p class="text-left">Nhập lại Mật khẩu *</p>
                        </div>
                        <div class="col-md-10">
                            <input type="password" class="{{ $errors->has('PasswordConfirm') ? ' has-error' : '' }}"  requiredmsg="Vui lòng nhập lại Mật khẩu" name="PasswordConfirm" required="" placeholder="Nhập lại mật khẩu">
                            @if ($errors->has('PasswordConfirm'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('PasswordConfirm') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10">
                            <button class="btn-cart">Lưu thay đổi</button>
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