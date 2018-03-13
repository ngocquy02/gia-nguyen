@extends('layouts.master')
@section('content')
<!-- Main Breadcrumb -->
<!-- End Main Breadcrumb -->
<!-- Main Content -->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="main-breadcrumb">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <ol class="breadcrumb">
                                <li><a href="#">Trang chủ</a></li>
                                <li class="active">{{$RootName}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="article">
                @if($item)
                    <h1 class="article-name">{!!$item->Name!!}</h1>
                    <div class="article-content">
                        {!!$item->Content!!}
                    </div>
                @else
                    <code>Giới thiệu công ty đang cập nhật!</code>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Content -->
@endsection