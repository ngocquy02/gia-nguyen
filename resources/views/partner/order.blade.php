@extends('layouts.master')
@section('content')
<div class="main-content">
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
	<div class="container">
		<div class="row">
			<h2>Chi tiết đơn hàng {!!$item->created_at->format('d/m/Y')!!}</h2>
			<div class="table-responsive">
				<fieldset>
					<table class="table table-bordered">
						<thead>
							<tr class="">
								<th>Tên khách</th>
								<th>Giá đơn hàng</th>
								<th>Giá vận chuyển</th>
								<th>Khối lượng</th>
								<th>Điểm đi</th>
								<th>Điểm đến</th>
								<th>Trạng thái</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{!!$item->FullName!!}</td>
								<td>{!!number_format($item->Price)!!} ₫</td>
								<td>{!!number_format($item->PriceCod)!!} ₫</td>
								<td>{!!$item->Weight!!}</td>
								<td>{!!$item->AddressStart!!}</td>
								<td>{!!$item->AddressEnd!!}</td>
								<td>{!!$item->IsHome==0 ? '1 Chiều':'2 Chiều'!!}</td>
								<td>@php
									switch ($item->Status) {
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
                                        case 4:
                                            echo 'Đã hủy';
                                            break;
                                        default:
                                            echo 'Chờ xác nhận';
                                            break;
                                    }
								@endphp</td>
							</tr>
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
							<p><i class="fa fa-phone-square" aria-hidden="true"></i> {!!$item->Phone!!}</p>
							<p><i class="fa fa-map-marker" aria-hidden="true"></i> {!!$item->Address!!}</p>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="">
						<h3>Thông tin Vận chuyển</h3>
						<div class="">
							<p><i class="fa fa-map-marker" aria-hidden="true"></i> Điểm đi: {!!$item->AddressStart!!}</p>
							<p><i class="fa fa-map-marker" aria-hidden="true"></i> Điểm đến: {!!$item->AddressEnd!!}</p>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="">					
						@if ($item->Status < 3 )
						<form action="{{ route('postSuccessCartPartner') }}" method="post" accept-charset="utf-8">
							{{ csrf_field() }}
							<input type="hidden" name="id" value="{{$item->id}}">
							<button type="submit" class="btn-cart">Hoàn thành</button>
						</form>
						@else
						<button type="button" class="btn-cart">{{($item->Status == 3)?'Chờ xác nhận hoàn thành':'Đã hoàn thành'}}</button>
						@endif
					</div>
					<div class="clearfix"></div>
					@if (session()->has('msg'))
                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>{{session()->get('msg')}}</strong>
                        </div>
                    @endif
					<!--inner-->
				</div>
			</div>
			<!--cart-collaterals-->
		</div>
	</div>
</div>
@endsection()