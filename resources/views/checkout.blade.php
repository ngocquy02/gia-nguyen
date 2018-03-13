@extends('layouts.master')
@section('content')
<form method="post" action="{!!route('postCreateCart')!!}" class="formCheckout">
{{ csrf_field() }}
<div context="checkout" class="container checkout">
    <div class="main">
    	<div class="wrap clearfix">
            <div class="row">
            	<div class="col-md-4 col-sm-12 order-info" >
                    <div class="order-summary order-summary--custom-background-color ">
                        <div class="order-summary-header summary-header--thin summary-header--border">
                            <h2>
                                <label class="control-label">Đơn hàng</label>
                                <label class="control-label">({!!count(session()->get('cart'))!!})</label>
                            </h2>
                        </div>
                        <div class="order-items " >
                            <div class="summary-body summary-section summary-product">
                                <div class="summary-product-list">
                                    <ul class="product-list">
                                     @php
                                    $sumary=0;
                                    foreach (session()->get('cart') as $key => $value) {
                                        $item_product=App\Models\Product::Find($key);
                                    @endphp
                                        <li class="product product-has-image clearfix">
                                            <div class="product-thumbnail pull-left">
                                                <div class="product-thumbnail__wrapper">
                                                    <img width="50" alt="{!!$item_product->Name!!}" src="Upload/product/{!!$item_product->Img!!}" class="product-thumbnail__image">
                                                </div>
                                                <span class="product-thumbnail__quantity" aria-hidden="true">{!!$value['Quantity']!!}</span>
                                            </div>
                                            <div class="product-info pull-left">
                                                <span class="product-info-name">
                                                    <strong>{!!$item_product->Name!!}</strong>
                                                </span>
                                            </div>
                                            <strong class="product-price pull-right">
                                                {!!number_format($item_product->Price*$value['Quantity'])!!}₫
                                            </strong>
                                        </li>
                                        @php
                                            $sumary=$sumary+ ($value['Price']*$value['Quantity']);  }
                                        @endphp
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        <div class="summary-section border-top-none--mobile">
                            <div class="total-line total-line-total clearfix">
                                <span class="total-line-name pull-left">
                                    Tổng cộng
                                </span>
                                <span class="total-line-price pull-right">{!!number_format($sumary)!!}₫</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix hidden-sm hidden-xs">
                        <input class="btn btn-primary col-md-12 mt10 btn-checkout" type="submit"  value="ĐẶT HÀNG">
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 customer-info">
                    <div class="form-group m0">
                        <h2>
                            <label class="control-label">Thông tin mua hàng</label>
                        </h2>
                    </div>
                    <hr class="divider">
                        <div class="form-group {{ $errors->has('Email') ? ' has-error' : '' }}">
                            <input name="Email" placeholder="Email" value="@if(session()->has('account')) {!!session()->get('account.Email')!!} @endif" type="text" class="form-control " >
                            <div class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li>{{ $errors->has('Email') ? $errors->first('Email') : '' }}</li>
                                </ul>
                            </div>
                        </div>
                    <div class="billing">
                        <div class="form-group">
                            <span bind-show="otherAddress" class=" label label-info">Thông tin thanh toán và nhận hàng</span><br>
                            <span bind-show="otherAddress" class="label label-success">Thông tin thanh toán</span>
                        </div>
                        <div >
                            <div class="form-group {{ $errors->has('FullName') ? ' has-error' : '' }}">
                                <input name="FullName" value="@if(session()->has('account')) {!!session()->get('account.FullName')!!} @endif" class="form-control" placeholder="Họ và tên">
                                <div class="help-block with-errors">
                                    <ul class="list-unstyled">
                                        <li>{{ $errors->has('FullName') ? $errors->first('FullName') : '' }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('Phone') ? ' has-error' : '' }}">
                                <input type="text" value="@if(session()->has('account')) {!!session()->get('account.Phone')!!} @endif" name="Phone" class="form-control" placeholder="Số điện thoại" >
                                <div class="help-block with-errors">
                                    <ul class="list-unstyled">
                                        <li>{{ $errors->has('Phone') ? $errors->first('Phone') : '' }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('Address') ? ' has-error' : '' }}">
                                <input name="Address" value="@if(session()->has('account')) {!!session()->get('account.Address')!!} @endif" class="form-control" placeholder="Địa chỉ">
                                <div class="help-block with-errors">
                                    <ul class="list-unstyled">
                                        <li>{{ $errors->has('Address') ? $errors->first('Address') : '' }}</li>
                                    </ul>
                                </div>
                            </div>
                            <hr class="divider">
                        </div>
                    </div>
                    <div class="shipping hide" show="0">
                        <div class="form-group">
                            <span class="label label-success">
                                Thông tin nhận hàng
                            </span>
                        </div>
                        <div >
                            <div class="form-group {{ $errors->has('FullNameShip') ? ' has-error' : '' }}">
                                <input data-error="Vui lòng nhập họ tên" value="@if(session()->has('account')) {!!session()->get('account.FullName')!!} @endif" name="FullNameShip" class="form-control" placeholder="Họ và tên">
                                <div class="help-block with-errors">
                                    <ul class="list-unstyled">
                                        <li>{{ $errors->has('FullNameShip') ? $errors->first('FullNameShip') : '' }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="PhoneShip" value="@if(session()->has('account')) {!!session()->get('account.Phone')!!} @endif" class="form-control" placeholder="Số điện thoại">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input name="AddressShip" value="@if(session()->has('account')) {!!session()->get('account.Address')!!} @endif" class="form-control" placeholder="Địa chỉ">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="note" value="" class="form-control" placeholder="Ghi chú"></textarea><grammarly-btn><div data-reactroot="" class="_e725ae-textarea_btn _e725ae-not_focused" style="z-index: 2; transform: translate(340.656px, 462px);"><div class="_e725ae-transform_wrap"><div title="Protected by Grammarly" class="_e725ae-status">&nbsp;</div></div></div></grammarly-btn>
                    </div>
                    <div class="form-group" bind-show="requiresShipping">
                        <div class="checkbox">
                            <label class="btn btn-xs btn-success" id="addShip">           
                                Giao hàng đến địa chỉ khác
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group payment-method-list">
                        <h2>
                            <label class="control-label">Thanh toán</label>
                        </h2>                               
                        <div class="radio">
                            <label class="radio-wrapper">
                               
                                <span>Thanh toán khi giao hàng (COD)</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group clearfix hidden-md hidden-lg">
                        <input class="btn btn-primary col-md-12 mt10 btn-checkout" type="submit" value="ĐẶT HÀNG">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
@section('jsProduct')
<link rel="stylesheet" type="text/css" href="{{asset('css/checkout.css')}}">
    <script>
        $(document).ready(function(){
           $('#addShip').click(function(){
                if($('.shipping').attr('show')==0)
                {
                    $('.shipping').attr('show',1);
                    $('.shipping').removeClass('hide');
                    $('#addShip').html("Hủy");
                }
                else
                {
                    $('.shipping').attr('show',0);
                    $('.shipping').addClass('hide');
                    $('#addShip').html("Giao hàng Đến địa chỉ khác");
                }
           });
           $('form').submit(function(){
                $('input:submit').attr('disabled','disabled');
           });
        });
    </script>
@endsection