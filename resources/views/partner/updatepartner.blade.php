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
<div class="partner-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="form-style form-login">
					@if ($errors->count() > 0)
						@foreach ($errors as $element)
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								{{$element->first()}}
							</div>
						@endforeach
					@endif
					<form accept-charset="UTF-8" action="{!!route('postUpdatePartner')!!}" id="customer_register" method="post">
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
							<p class="text-left">Công ty</p>
						</div>
						<div class="col-md-10">
							<input type="text" value="{!!$item->Company!!}" name="Company" placeholder="Tên công ty">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p class="text-left">Chức vụ</p>
						</div>
						<div class="col-md-10">
							<input type="text" value="{!!$item->Role!!}" name="Role" placeholder="Chức vụ">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p class="text-left">Trạng thái</p>
						</div>
						<div class="col-md-10">
							<div class="radio col-md-6">
								<label>
									<input type="radio" name="IsOnline" id="input" value="1" {{($item->IsOnline==1)?'checked="checked"' : ''}}>
									Online
								</label>
							</div>
							<div class="radio col-md-6" style="margin-top: 10px;">
								<label>
									<input type="radio" name="IsOnline" id="input" value="0" {{($item->IsOnline==0)?'checked="checked"' : ''}}>
									Offline
								</label>
							</div>
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