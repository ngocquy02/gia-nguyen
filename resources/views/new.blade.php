@extends('layouts.master')
@section('content')
<div class="list-sp">
    <div class="header-list-sp">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
                <div class="header-name">
                    <h2 class="m-0 p-0">
                        <a href="{{getLinkById($item->CatId)}}/{{$item->Alias}}.html" title="">
                            @if($check)
                                {!!$check->Name!!}
                            @endif
                            @if(isset($checkParent))
                                {!!$checkParent->Name!!}
                            @endif
                            @if(isset($checkChild))
                                {!!$checkChild->Name!!}
                            @endif
                            > {!!$item->Name!!}
                        </a>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="content-list-sp">
       {!!$item->Content!!}
       <div class="fb-like" data-href="{{getLinkById($item->CatId)}}/{{$item->Alias}}.html" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
    </div>
    <div class="clearfix"></div>  
    <div class="list-sp">
        <div class="header-list-sp">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="header-name">
                        <h2 class="m-0 p-0"><a title="">Các bài viết liên quan</a></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="content-list-sp row">
            @php
                $post = App\Models\Article::where(['CatId'=>$item->CatId,'IsActive'=>1])->limit(4)->get();
            @endphp
            @if(isset($post))
                @foreach($post as $value)
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 item-sp item-sp">
                        <div class="product-img">
                            <img src="{{$value->Img}}" class="img-fluid" alt="Responsive image">
                        </div>
                        <div class="product-name">
                            <h3><a href="{{getLinkById($item->CatId)}}/{{$item->Alias}}.html" title="">{{$value->Name}}</a></h3>
                            <div class="xem-them"><a href="{{getLinkById($item->CatId)}}/{{$item->Alias}}.html" title="">Xem thêm</a></div>
                        </div>
                    </div>
                @endforeach
                
            @else
                <code>Không có các sản phẩm cùng loại</code>
            @endif
            
        </div>
    </div>
</div>
@endsection()