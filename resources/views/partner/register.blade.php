@extends('layouts.master')
@section('content')
<div class="register-partner">
	<div class="container-fluid">
		<div class="row">
			<div class="header-name">
				<h1>ĐĂNG KÝ TRỞ THÀNH ĐỐI TÁC</h1>
			</div>
		</div>
	</div>
</div>
<div class="partner-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="form-style form-login">
					<form accept-charset="UTF-8" action="{!!route('postRegisterPartner')!!}" id="customer_register" method="post">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">
							<input type="text" autofocus="" class="{{ $errors->has('FullName') ? ' has-error' : '' }}" name="FullName" requiredmsg="Vui lòng nhập đầy đủ Họ và Tên" placeholder="Nhập Họ và Tên">
							@if ($errors->has('FullName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('FullName') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="col-md-6">
							<input type="email" class="{{ $errors->has('Email') ? ' has-error' : '' }}" name="Email" requiredmsg="Vui lòng nhập địa chỉ Email" placeholder="Địa chỉ Email">
							@if ($errors->has('Email'))
                                <span class="help-block">
                                    <strong>{{ ($errors->first('Email')=='The email has already been taken.') ? 'Email đã được đăng ký.' : $errors->first('Email') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<input type="text" class="{{ $errors->has('Phone') ? ' has-error' : '' }}" name="Phone"  requiredmsg="Vui lòng nhập Số điện thoại" placeholder="Số điện thoại">
							@if ($errors->has('Phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Phone') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="col-md-6">
							<input type="text" class="{{ $errors->has('Address') ? ' has-error' : '' }}"  requiredmsg="Vui lòng nhập Địa chỉ hợp tác" name="Address" placeholder="Địa chỉ hợp tác">
							@if ($errors->has('Address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Address') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<input type="text" class="{{ $errors->has('Company') ? ' has-error' : '' }}" name="Company"  requiredmsg="Vui lòng nhập Tên công ty" placeholder="Tên công ty">
							@if ($errors->has('Company'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Company') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="col-md-6">
							<input type="text" class="{{ $errors->has('Role') ? ' has-error' : '' }}"  requiredmsg="Vui lòng nhập chức vụ" name="Role" placeholder="Chức vụ">
							@if ($errors->has('Role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Role') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<textarea class="{{ $errors->has('CustomerType') ? ' has-error' : '' }}"  requiredmsg="Vui lòng nhập mô tả loại khách hàng" name="CustomerType" placeholder="Mô tả đối tượng khách hàng của bạn" row="3"></textarea>
							@if ($errors->has('CustomerType'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('CustomerType') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<textarea  class="{{ $errors->has('Content') ? ' has-error' : '' }}"  requiredmsg="Vui lòng nhập mô tả ý tưởng hợp tác" name="Content" placeholder="Mô tả ý tưởng hợp tác" row="3"></textarea>
							@if ($errors->has('Content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Content') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="row">
							<button class="btn-cart">Đăng ký</button>
						</div>
					</div>
					@if (session()->has('msg'))
						<div class="alert alert-warning">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{{session()->get('msg')}}
						</div>
						<script>alert('{{session('msg')}}');</script>
					@endif
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection()