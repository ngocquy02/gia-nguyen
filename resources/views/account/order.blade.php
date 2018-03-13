@extends('layouts.master')
@section('content')
<div class="main-breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li><a href="">Trang chủ</a></li>
					<li class="active">Đơn hàng</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="account-content">
	<div class="container">
		<div class="row">
			<h2>Chi tiết đơn hàng {!!$item->created_at->format('d/m/Y')!!}</h2>
			<div class="table-responsive">
				<fieldset>
					<table class="table table-bordered">
						<thead>
							<tr class="">
								<th>Sản phẩm</th>
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Thành tiền</th>
							</tr>
						</thead>
						<tbody>
						@php
							$listProducts=App\Models\Cart::Find($item->id)->productcart()->get();
						@endphp
						@foreach($listProducts as $listProduct)
							<tr>
								<td>{!!$listProduct->Name!!}</td>
								<td>{!!number_format($listProduct->Price)!!} ₫</td>
								<td>{!!$listProduct->Quantity!!}</td>
								<td>{!!number_format($listProduct->Price*$listProduct->Quantity)!!} ₫</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</fieldset>
			</div>
			<!-- BEGIN CART COLLATERALS -->
			<div class="row">
				<div class="col-sm-4">
					<div class="">
						<h3>Thông tin thanh toán</h3>
						<div class="">
							<p>Trạng thái thanh toán:{!!($item->IsPay == 0) ? 'Chưa thanh toán' : 'Đã thanh toán'!!}</p>
							<p>{!!$item->Phone!!}</p>
							<p>{!!$item->Address!!}</p>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="">
						<h3>Thông tin giao hàng</h3>
						<div class="">
							<p>Trạng thái vận chuyển: {!!($item->IsTransport == 0) ? 'Chưa giao hàng' : 'Đã giao hàng'!!}</p>
							<p>{!!$item->PhoneShip!!}</p>
							<p>{!!$item->AddressShip!!}</p>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<h3>Tổng tiền hóa đơn</h3>
					<div class="">
						<table class="table">
							<tbody>
								<tr>
								@php
									$sumPrice=App\Models\Cart::Find($item->id)->productcart()->sum('Price');
								@endphp
									<td> Tổng tiền </td>
									<td class="text-right"><span class="price">{!!number_format($sumPrice)!!} ₫</span></td>
								</tr>
							</tbody>
						</table>
					</div>
					<!--inner-->

				</div>
			</div>

			<!--cart-collaterals-->
		</div>
	</div>
</div>
@endsection()