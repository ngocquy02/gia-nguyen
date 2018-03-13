@extends('layouts.master')
@section('content')

<!-- End Main Breadcrumb -->
<!-- Main Content -->
<div class="main-content">
     <div class="container-fluid">
        <div class="row">
            <div class="header-name">
                <h1>{!!$RootName!!}</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @if($items->count() > 0)
                        @foreach($items as $item)
                            <div class="post-slide row">
                                <div class="post-img col-md-5 col-lg-5 col-xs-12 col-sm-12"><a href="{{getLinkById($item->CatId)}}/{{$item->Alias}}.html" title="{{$item->Name}}"><img src="{{$item->Img}}" alt=""></a></div>
                                <div class="post-content col-md-7 col-lg-7 col-xs-12 col-sm-12">
                                    <h3 class="post-title"><a href="{{getLinkById($item->CatId)}}/{{$item->Alias}}.html" title="{{$item->Name}}">{{$item->Name}}</a></h3>
                                    <ul class="post-bar">
                                        <li><i class="fa fa-calendar"></i> {!!$item->created_at->format('d/m/Y h:s')!!}</li>
                                    </ul>
                                    <p class="post-description">{!!catchuoi(strip_tags($item->ShortContent),150)!!}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                    <code> Bài viết đang cập nhật</code>
                    @endif
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            {!!$items->links()!!}
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding: 0;">
                 <div class="blog-new">
                    <h2 class="blog-heading">DỊCH VỤ</h2>
                    <div class="blog-new-content">
                        <ul>
                        @php
                            $listDVNews=App\Models\Category::where(['IsActive'=>1,'Alias'=>'dich-vu','Type'=>3])->first();
                        @endphp
                        @if($listDVNews and $listDVNews->categorys()->where('IsActive',1)->count() > 0)
                            @foreach($listDVNews->categorys()->where('IsActive',1)->orderby('Idx')->get() as $listDVNew)
                            <li>
                                <h3 style="margin: 0;"><a class="bn-img" href="{!!getLinkById($listDVNew->id)!!}/" title="{!!$listDVNew->Name!!}">{!!$listDVNew->Name!!}
                                </a></h3>
                                <p class="description">{{$listDVNew->Description}}</p>
                            </li>
                            @endforeach
                        @else
                            <code>Bài viết đang cập nhật</code>
                        @endif
                        </ul>
                    </div>
                </div>
                <div class="blog-new">
                    <h2 class="blog-heading">Bài viết nổi bật</h2>
                    <div class="blog-new-content-hot">
                        <ul>
                        @php
                            $listArticleNews=App\Models\Article::where(['IsActive'=>1,'IsHot'=>1])->orderby('id')->limit(7)->get();
                        @endphp
                        @if($listArticleNews->count() > 0)
                            @foreach($listArticleNews as $listArticleNew)
                            <li>
                                <h3><a class="arti-hot" href="{!!getLinkById($listArticleNew->CatId)!!}/{!!$listArticleNew->Alias!!}.html" title=""><i class="fa fa-long-arrow-right" aria-hidden="true"></i> {!!$listArticleNew->Name!!}
                                </a></h3>
                            </li>
                            @endforeach
                        @else
                            <code>Bài viết đang cập nhật</code>
                        @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Content -->
@endsection