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
					<form accept-charset="UTF-8" action="{!!route('postUpdateAccount')!!}" id="customer_register" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="id" value="{!!$item->id!!}">
					<h3 class="form-heading">Thay đổi thông tin tài khoản</h3>
					<div class="row">
						<div class="col-md-2">
							<p class="text-left">Họ và Tên *</p>
						</div>
						<div class="col-md-10">
							<input type="text" class="{{ $errors->has('FullName') ? ' has-error' : '' }}" name="FullName" required="" requiredmsg="Vui lòng nhập đầy đủ Họ và Tên" placeholder="Nhập Họ và Tên" value="{!!$item->FullName!!}">
							@if ($errors->has('FullName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('FullName') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p class="text-left">Email</p>
						</div>
						<div class="col-md-10">
							<input type="text" value="{!!$item->Phone!!}" name="Email" placeholder="Cập nhật địa chỉ Email">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p class="text-left">Điện thoại</p>
						</div>
						<div class="col-md-10">
							<input type="text" value="{!!$item->Phone!!}" name="Phone" placeholder="Nhập Số điện thoại">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p class="text-left">Địa chỉ</p>
						</div>
						<div class="col-md-10">
							<input type="text" value="{!!$item->Address!!}" name="Address" placeholder="Nhập địa chỉ liên hệ">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
						</div>
						<div class="col-md-10">
							<button class="btn-cart">Lưu thay đổi</button>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection()
@section('jsProduct')
<script >
    $(document).ready(function(){
    	@if (session()->has('msg'))
    		alert('{{session()->get('msg')}}');
    	@endif
    });
</script>