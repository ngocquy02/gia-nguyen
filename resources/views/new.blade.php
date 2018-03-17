@extends('layouts.master')
@section('content')
<div class="list-sp">
    <div class="header-list-sp">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
                <div class="header-name">
                    <h2 class="m-0 p-0">
                        <a href="{{getLinkById($item->CatId)}}/{{$item->Alias}}.html" title="">
                            TRANG CHỦ &#x3E;
                            @if($check)
                                {!!$check->Name!!}
                            @endif
                            @if(isset($checkParent))
                                 &#x3E; {!!$checkParent->Name!!}
                            @endif
                            @if(isset($checkChild))
                                 &#x3E; {!!$checkChild->Name!!}
                            @endif
                             &#x3E; {!!$item->Name!!}
                        </a>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="content-sp">
        <div class="float-right">
            <span style="font-style: italic;font-size: 14px;margin-bottom: 10px;display: inline-block;"> 
                Đăng ngày:{!!$item->created_at->format('d/m/Y - h:i:s')!!}
            </span>
        </div>
       
       {!!$item->Content!!}
       {{-- <div class="fb-like" data-href="{{getLinkById($item->CatId)}}/{{$item->Alias}}.html" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div> --}}
    </div>
    <div class="clearfix"></div>
    <div class="news-lq">
        <span>Những tin tức khác</span>
    </div>
    <div class="clearfix"></div>
    <div class="list-news-lq">
        <ul class="p-0 m-0">
            @php
                $news = App\Models\Article::orderBy('created_at','desc')->limit(5)->get();  
            @endphp
            @if($news->count()>0)
                @foreach($news as $new)
                    <li><a href="{{getLinkById($new->CatId)}}\{{$new->Alias}}.html" title="">> {{$new->Name}}</a></li>
                @endforeach
            @else
                <code>Không có bài viết liên quan</code>
            @endif
        </ul>
    </div>
</div>
@endsection()
@section('sidebar')
    @include('layouts/news-sidebar')
@endsection