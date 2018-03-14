@extends('layouts.master')
@section('slider')
    @include('layouts.slider')
@endsection
@section('content')
<div class="list-sp">
    @php
        $category = App\Models\Category::Where(['Type' =>3,'Level' =>1])->get();   
    @endphp
    @if($category->count() > 0 )
        @foreach($category as $value)
            <div class="header-list-sp">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="header-name">
                            <h2 class="m-0 p-0"><a href="{{getLinkById($value->id)}}" title="">{{$value->Name}}</a></h2>
                        </div>
                    </div>
                    <div class="xem-them"><a href="{{getLinkById($value->id)}}" title="">Xem thêm >></a></div>
                </div>
            </div>
            <div class="clearfix"></div>

            @php
                $listCatID=$value->categorys()->get();
                if ($loop->first==true){
                    $product = App\Models\Product::Where(['CatId'=>$value->id,'IsActive'=>1])->limit(8)->get();
                }else{
                    $product = App\Models\Product::Where(['CatId'=>$value->id,'IsActive'=>1])->limit(4)->get();
                }
            @endphp
            <div class="content-list-sp row">
                @if($product->count()>0)
                    @foreach($product as $value2)
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 item-sp item-sp">
                            <div class="product-img">
                                <img src="{{ asset($value2->Img) }}" class="img-fluid" alt="Responsive image">
                            </div>
                            <div class="product-name">
                                <h3><a href="{{getLinkById($value2->CatId)}}/{{$value2->Alias}}.html" title="">{{$value2->Name}}</a></h3>
                                <div class="xem-them"><a href="{{getLinkById($value2->CatId)}}/{{$value2->Alias}}.html" title="">Xem thêm</a></div>
                            </div>
                        </div>
                    @endforeach
                @else
                     <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 item-sp item-sp">
                         <code>Không có sản phẩm</code>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <code>
            Không có danh mục sản phẩm
        </code>
    @endif
</div>
@endsection
@section('jsProduct')
@endsection
