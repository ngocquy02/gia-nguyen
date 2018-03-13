@extends('layouts.master')
@section('content')
<div class="main-content">
	<div class="main-breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ol class="breadcrumb">
						<li><a href="">Trang chủ</a></li>
						<li class="active">Tài khoản</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Thông tin tài khoản</h3>
				<div style="display:block;width:100%;">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>Mã đối tác: </td>
								<td><p>{!! Auth::guard('partner')->user()->Code  !!}</p></td>
							</tr>
							<tr>
								<td>Họ và Tên: </td>
								<td><p>{!! Auth::guard('partner')->user()->FullName  !!}</p></td>
							</tr>
							<tr>
								<td>Địa chỉ: </td>
								<td><p>{!! Auth::guard('partner')->user()->Address  !!}</p></td>
							</tr>							
							<tr>
								<td>Số điện thoại: </td>
								<td>{!! Auth::guard('partner')->user()->Phone  !!}</td>
							</tr>
							<tr>
								<td>Công ty: </td>
								<td>{!! Auth::guard('partner')->user()->Company  !!}</td>
							</tr>
							<tr>
								<td>Chức vụ: </td>
								<td>{!! Auth::guard('partner')->user()->Role  !!}</td>
							</tr>
							<tr>
								<td>Số tiền hiện có: </td>
								<td>{!! Auth::guard('partner')->user()->Coin  !!} VND</td>
							</tr>
							<tr>
								<td>Trạng thái: </td>
								<td>{!! (Auth::guard('partner')->user()->IsOnline==1) ? 'Online' : 'Offline'  !!}</td>
							</tr>
						</tbody>
					</table>
					<a style="position: relative;bottom: 10px;" href="{!!route('getUpdatePartner')!!}" title=""><button class="btn-cart" title="Thay đổi thông tin tài khoản" type="button"><span>Thay đổi thông tin</span></button></a>
					<a style="position: relative;" class="btn-cart" data-toggle="modal" href='#modal-id'>Thay đổi mật khẩu</a>
					<div class="modal fade" id="modal-id">
						<div class="modal-dialog">
							<div class="modal-content">
								<form accept-charset="UTF-8" action="{!!route('postChangePassword')!!}" id="customer_login" method="post" class="form-style">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Modal title</h4>
									</div>
									<div class="modal-body" style="padding: 15px 20%;">
											{{ csrf_field() }}	
											<div class="row">
												<input type="password" class="{{ $errors->has('Password') ? ' has-error' : '' }}" name="Password" required=""  title="Nhập mật khẩu cũ" placeholder="Mật khẩu cũ">
												@if ($errors->has('Password'))
					                                <span class="help-block">
					                                    <strong>{{ $errors->first('Password') }}</strong>
					                                </span>
					                            @endif
											</div>
											<div class="row">
												<input type="password" class="{{ $errors->has('NewPassword') ? ' has-error' : '' }}"  title="Vui lòng nhập Mật khẩu mới" name="NewPassword" required="" placeholder="Nhập mật khẩu mới">
												@if ($errors->has('NewPassword'))
					                                <span class="help-block">
					                                    <strong>{{ $errors->first('NewPassword') }}</strong>
					                                </span>
					                            @endif
											</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn-cart" data-dismiss="modal">Close</button>
										<button type="submit" class="btn-cart">Lưu thay đổi</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--inner-->
			</div><div class="clearfix"></div>
			<div class="col-sm-12">				
				<div class="table-responsive">
					<fieldset>
						<table class="table table-bordered">
							<thead>
								<tr class="first last">
									<th rowspan="1">Mã đơn hàng</th>
									<th rowspan="1">Ngày</th>
									<th colspan="1">Trạng thái</th>
									<th colspan="1">Thành tiền</th>
								</tr>
							</thead>
							<tbody>
							@php
								$listCarts=\App\Models\Partner::Find(Auth::guard('partner')->id())->carts()->orderBy('created_at','desc')->get();
							@endphp
							@foreach($listCarts as $listCart)
								<tr class="first odd">
									<td>
										<a href="{!!route('getOrderPartner',['CartCode'=>$listCart->CartCode])!!}">#{!!$listCart->CartCode!!}</a>
									</td>
									<td>{{$listCart->created_at->format('d/m/Y H:m:s')}}</td>
									<td>
										@php
											switch ($listCart->Status) {
                                                case 0:
                                                    echo 'Chờ xác nhận';
                                                    break;
                                                case 1:
                                                    echo 'Chờ nhận vận chuyển';
                                                    break;
                                                case 2:
                                                    echo 'Đang vận chuyển';
                                                    break;
                                                case 3:
                                                    echo 'Chờ xác nhận Hoàn thành';
                                                    break;
                                                case 4:
                                                    echo 'Hoàn thành';
                                                    break;
                                                default:
                                                    echo 'Chờ xác nhận';
                                                    break;
                                            }
										@endphp
									</td>
									<td class="a-right movewishlist">
										{!!number_format($listCart->Price)!!} ₫
									</td>
								</tr>
							@endforeach				
							</tbody>
						</table>
					</fieldset>
				</div>				
			</div>
			
		</div>
	</div>
</div>
@if(session('msg'))
<script>
		alert('{{session('msg')}}');
</script>
@endif
@endsection()