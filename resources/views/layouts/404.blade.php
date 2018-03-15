@extends('layouts.master')
@section('content')
<!-- Main Breadcrumb -->
    <div class="list-sp">
        <div class="content-sp red">
            <h1 class="text-center">404</h1>
            <h3 class="text-center">Không tìm thấy trang!</h3>
            <p class="text-center">Xin lỗi bạn, chúng tôi không thể tìm kiếm được trang web bạn yêu cầu hoặc có gì đó đã sai... Bạn vui lòng nhập lại tìm kiếm hoặc trở lại Trang chủ!</p>
            <p class="text-center"><a href="{{url('')}}" class="btn-not-found" title="Trở lại trang chủ">Trang chủ</a></p>
        </div>
    </div>

<!-- End Main Content -->
@endsection

@section('sidebar')
    @include('layouts/hotline-sidebar')
    @include('layouts/news-sidebar')
@endsection