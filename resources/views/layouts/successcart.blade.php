@extends('layouts.master')
@section('content')
<div class="container success">
    <div class="main">
        <div class="wrap clearfix">
            <div class="row thankyou-infos">
                <div class="row">
                <div class="col-md-6 thankyou-message">
                    @php 
                        $getCart=App\Models\Cart::where('CartCode',$CartCode)->first();
                    @endphp
                    <div class="col-md-12 col-sm-12 thankyou-message-text">
                        <h3>Cảm ơn Quý khách đã đặt hàng</h3>
                        <p>                        
                            Một email xác nhận đã được gửi tới {!!$getCart->Email!!}. Xin vui lòng kiểm tra email của Quý khách                       
                        </p>
                        <div style="font-style: italic;">
                            
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 customer-info">
                        <div class="shipping-info">
                            <div class="row">                                
                                <div class="col-md-6 col-sm-6">
                                    <div class="">
                                        <div class="order-summary-header">
                                            <h4>
                                                <label class="control-label">Thông tin nhận hàng</label>
                                            </h4>
                                        </div>
                                        <div class="summary-section no-border no-padding-top">
                                            <p class="address-name">
                                                {!!$getCart->FullNameShip!!}
                                            </p>
                                            <p class="address-address">
                                                {!!$getCart->AddressShip!!}
                                            </p>
                                            <p class="address-phone">
                                                {!!$getCart->PhoneShip!!}
                                            </p>
                                            
                                        </div>
                                    </div>
                                </div>                               
                                <div class="col-md-6 col-sm-6">
                                    
                                    <div class="">
                                        <div class="order-summary-header">
                                            <h4>
                                                <label class="control-label">Thông tin thanh toán</label>
                                            </h4>
                                        </div>
                                        <div class="summary-section no-border no-padding-top">
                                            <p class="address-name">
                                                {!!$getCart->FullName!!}
                                            </p>
                                            <p class="address-address">
                                                {!!$getCart->Address!!}
                                            </p>
                                            <p class="address-phone">
                                               {!!$getCart->Phone!!}
                                            </p>                                            
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="">
                                        <div class="order-summary-header">
                                            <h4>
                                                <label class="control-label">Hình thức thanh toán</label>
                                            </h4>
                                        </div>
                                        <div class="summary-section no-border no-padding-top">
                                            <span>Thanh toán khi giao hàng (COD)</span>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="col-md-6 col-sm-6">
                                    <div class="">
                                        <div class="order-summary-header">
                                            <h4>
                                                <label class="control-label">Hình thức vận chuyển</label>
                                            </h4>
                                        </div>
                                        <div class="summary-section no-border no-padding-top">                 <span>Giao hàng tận nơi - Miễn phí</span>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="order-success">
                            <a href="" class="order-summary">
                                Tiếp tục mua hàng
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 order-info" >
                    <div class="order-summary">
                        <h4>
                            <label class="control-label">Đơn hàng</label>
                            #{!!$getCart->CartCode!!}
                        </h4>
                    </div>
                    <div class="order-summary ">
                        <div class="order-items " >
                            <div class="summary-body ">
                                <div class="summary-product-list">
                                    <ul class="product-list">
                                    @php
                                        $productCart=App\Models\Cart::Find($getCart->id)->productcart()->get();
                                        $summary=0;
                                    @endphp
                                    @foreach($productCart as $productCart)
                                    @php
                                        $product=App\Models\Product::Find($productCart->ProdId);
                                    @endphp
                                        <li class="product product-has-image clearfix">
                                            <div class="product-thumbnail pull-left">
                                                <div class="product-thumbnail__wrapper">         
                                                    <img src="Upload/product/{!!$product->Img!!}" alt="{!!$product->Name!!}" width="50" class="product-thumbnail__image">                                                    
                                                </div>
                                            </div>
                                            <div class="product-info pull-left">
                                                <span class="product-info-name">
                                                    <strong>{!!$product->Name!!}</strong>
                                                    <label class="print">x{!!$productCart->Quantity!!}</label>
                                                </span>
                                            </div>
                                            <strong class="product-price pull-right">
                                                {!!number_format($productCart->Quantity*$productCart->Price)!!} ₫
                                            </strong>
                                        </li> 
                                        <hr>
                                        @php
                                            $summary=$summary+$productCart->Quantity*$productCart->Price;
                                        @endphp                                       
                                    @endforeach                                    
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="summary-section">
                            <div class="total-line total-line-total clearfix">
                                <span class="total-line-name total-line-name--bold pull-left">
                                    <strong>Tổng cộng</strong>
                                </span>
                                <span class="total-line-price pull-right">
                                    <strong>{!!number_format($summary)!!} ₫</strong>
                                </span>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

