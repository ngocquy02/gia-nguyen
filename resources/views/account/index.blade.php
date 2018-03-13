@extends('layouts.master')
@section('content')
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
<div class="account-content">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>Thông tin tài khoản</h3>
				<div class="">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>Họ và Tên: </td>
								<td><p>{!! Auth::guard('account')->user()->FullName  !!}</p></td>
							</tr>
							<tr>
								<td>Địa chỉ: </td>
								<td><p>{!! Auth::guard('account')->user()->Address  !!}</p></td>
							</tr>							
							<tr>
								<td>Số điện thoại: </td>
								<td>{!! Auth::guard('account')->user()->Phone  !!}</td>
							</tr>
						</tbody>
					</table>
					<a style="position: relative;bottom: 10px;" href="{!!route('getUpdateAccount')!!}" title=""><button class="btn-cart" title="Thay đổi thông tin tài khoản" type="button"><span>Thay đổi thông tin</span></button></a>
				</div>
				<!--inner-->
			</div>
			<div class="col-sm-12">				
				<div class="table-responsive">
					<fieldset>
						<table class="table table-bordered">
							<thead>
								<tr class="first last">
									<th rowspan="1">Mã đơn hàng</th>
									<th rowspan="1">Ngày</th>
									<th colspan="1">Trạng thái thanh toán</th>
									<th rowspan="1">Trạng thái vận chuyển</th>
									<th colspan="1">Thành tiền</th>
								</tr>
							</thead>
							<tbody>
							@php
								$listCarts=App\Models\Cart::where('Email',session()->get('account.Email'))->orderBy('id', 'desc')->get();
							@endphp
							@foreach($listCarts as $listCart)
								<tr class="first odd">
									<td>
										<a href="{!!route('getOrder',['CartCode'=>$listCart->CartCode])!!}">#{!!$listCart->CartCode!!}</a>
									</td>
									<td>{{$listCart->created_at->format('d/m/Y')}}</td>
									<td>
										{!!($listCart->IsPay == 0) ? 'Chưa thanh toán' : 'Đã thanh toán'!!}
									</td>
									<td>{!!($listCart->IsTransport == 0) ? 'Chưa giao hàng' : 'Đã giao hàng'!!}</td>
									<td class="a-right movewishlist">
									@php
										$sumPrice=App\Models\Cart::Find($listCart->id)->productcart()->sum('Price');
									@endphp
										{!!number_format($sumPrice)!!} ₫
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
@endsection()