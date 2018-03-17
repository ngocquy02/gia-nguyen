@extends('layouts.master')
@section('content')
<!-- Main Breadcrumb -->
<!-- End Main Breadcrumb -->
<!-- Main Content -->
<div class="list-sp">
    <div class="header-list-sp">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
                <div class="header-name">
                    @php
                        $Cat = App\Models\Category::where(['Alias' =>$root,'Type'=>5])->first();
                        $about = App\Models\Article::where(['CatId' => $Cat->id])->first();         
                    @endphp
                    <h2 class="m-0 p-0">
                        <a href="" title="">
                            TRANG CHỦ &#x3E; GIỚI THIỆU
                        </a>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="content-list-sp">
        @if($about->count()>0)
            {!!$about->Content!!}
        @else
            <code>Chưa có giới thiệu </code>
        @endif


    </div>
    <div class="clearfix"></div>  
</div>
<!-- End Main Content -->
@endsection

@section('sidebar')
    @include('layouts/news-sidebar')
@endsection