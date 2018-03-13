@extends('layouts.master')
@section('content')
<div class="main-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="">Trang chủ</a></li>
                    <li class="active">Giỏ hàng</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- End Main Breadcrumb -->
<!-- Main Content -->
<div class="main-content">
    <div class="container">
        <div class="row cart cart_table">
        @if(session()->has('cart') && count(session()->get('cart')) > 0)
            <form method="post" action="{!!route('postUpdateCart')!!}">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered cart-table">
                            <thead>
                                <tr>
                                    <th class="text-center">Hình ảnh</th>
                                    <th class="text-center">Tên sản phẩm</th>
                                    <th class="text-center">Đơn giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Thành tiền</th>
                                    <th class="text-center">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                        @php
                        $sumary=0;
                        foreach (session()->get('cart') as $key => $value) {
                            $item_product=App\Models\Product::Find($key);
                        @endphp
                            <tr>
                                <td class="text-center">                                   
                                    <a href="{!!getLinkById($item_product->CatId)!!}/{!!$item_product->Alias!!}.html" title="{!!$item_product->Name!!}">
                                        <img width="50" alt="{!!$item_product->Name!!}" src="Upload/product/{!!$item_product->Img!!}">
                                    </a>                                    
                                </td>
                                <td class="text-center" valign="middle">
                                    <p class="">
                                        <a title="{!!$item_product->Name!!}" href="{!!getLinkById($item_product->CatId)!!}/{!!$item_product->Alias!!}.html">{!!$item_product->Name!!}</a><br>
                                        
                                    </p>
                                </td>
                                <td class="text-center"><p class="">{!!number_format($value['Price'])!!}₫</p></td>
                                <td class="text-center"><input type="number" min="1" max="50" class="item-quantity" value="{!!$value['Quantity']!!}" name="{!!$key!!}" ></td>
                                <td class="text-center"><p class="l">{!!number_format($value['Price']*$value['Quantity'])!!}₫</p></td>
                                <td class="text-center"><a class="fa fa-trash-o item-remove" href="{!!route('delItemCart',['id'=>$key])!!}" ></a></td>
                            </tr>
                        @php
                         $sumary=$sumary+ ($value['Price']*$value['Quantity']);  }
                        @endphp
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-9 col-xs-12" style="margin-bottom: 15px;">
                            <a href="" class="btn-cart">Mua hàng tiếp</a>
                            <button class="btn-cart">Cập nhật</button>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <table class="table table-bordered total-table">
                                <tbody><tr>
                                    <td class="text-right">Tổng tiền</td>
                                    <td class="text-right">{!!number_format($sumary)!!}₫</td>
                                </tr>
                            </tbody></table>
                            <a href="{!!route('getCheckOut')!!}" class="btn-cart pull-right">Thanh toán</a>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div class="col-md-12">
                <p>Chưa có sản phẩm nào trong giỏ hàng</p>
            </div>
        @endif
        </div>
    </div>           
</div>

@endsection
