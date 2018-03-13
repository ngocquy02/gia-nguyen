@extends('layouts.master')
@section('content')
<div class="main-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="">Trang chủ</a></li>

                    <li class="active breadcrumb-title">Kết quả tìm kiếm</li>

                </ol>
            </div>
        </div>
    </div>
</div>
    <!-- End Main Breadcrumb -->
    <!-- Main Content -->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">                                
                <h1>Kết quả tìm kiếm với từ khóa: {!!$Keyword!!}</h1>
                <div class="product-list-grid">
                    <div class="row">
                    @if($items->count() > 0)
                        @foreach($items as $item)
                            <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="product-carousel item">
                                <div class="prod-image">
                                        <a href="{{getLinkById($item->CatId)}}/{{$item->Alias}}.html">
                                            <img src="Upload/product/{{$item->Img}}" alt="{{$item->Name}}">
                                        </a>
                                    </div>
                                    <h3 class="product-name"><a href="{{getLinkById($item->CatId)}}/{{$item->Alias}}.html" title="{{$item->Name}}">{{str_limit($item->Name, $limit =50, $end = '...')}}</a></h3>
                                    <p class="price-box">
                                        @if($item->Sale>0)
                                        <span class="sale">
                                            <del>
                                                {{($item->Price*$item->Sale)/100 + $item->Price}}₫
                                            </del> -
                                        </span>
                                        @endif
                                        <span class="special-price"><span class="price product-price">{{($item->Price > 0) ? $item->Price.'₫':'Liên hệ'}}</span></span>
                                    </p>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <code> Sản phẩm đang cập nhật</code>
                    @endif
                        {!!$items->links()!!}
                    </div>
                </div>            
            </div>    
        </div>
    </div>
</div>
@endsection
@section('jsProduct')
<script >
    $(document).ready(function(){
     $.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
    $('.product-atc').click(function(){
        var id=$(this).attr('product-id');
        var price=$(this).attr('product-price');
        var qtt=$('#cart').attr('qtt');
        $.ajax({
        url:'{{route('postAddCart')}}', 
        type:'post',
        cache:false,
        data:{price:price,id:id},
        dataType:'html',
        success:function(msg){
            if(Number(qtt)==Number(msg)){
                tb='Đã tăng số lượng lên 1';
                Notify(tb, 'top-right', '5000', 'success', 'fa-check', true); 
            }
            else{
                tb='Đã thêm sản phẩm và giỏ hàng';
                $('#cart').attr('qtt',msg);
                $('#cart').html(msg);
            Notify(tb, 'top-right', '5000', 'success', 'fa-check', true); 
            }
        },
        error:function(){ Notify('Truyền dữ liệu thất bại', 'top-right', '5000', 'danger', 'fa-bolt', true);}
        });
    });
function Notify(message, position, timeout, theme, icon, closable) {
    toastr.options.positionClass = 'toast-' + position;
    toastr.options.extendedTimeOut = 0; //1000;
    toastr.options.timeOut = timeout;
    toastr.options.closeButton = closable;
    toastr.options.iconClass = icon + ' toast-' + theme;
    toastr['custom'](message);
}
});
</script>
@endsection