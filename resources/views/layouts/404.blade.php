@extends('layouts.master')
@section('content')
<!-- Main Breadcrumb -->
<div class="main-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="">Trang chủ</a></li>
                    <li class="active">Không tìm thấy trang</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- End Main Breadcrumb -->
<!-- Main Content -->
<div class="main-content">
    <div class="container">
        <div class="row not_found">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="text-center">404</h2>
                <h3 class="text-center">Khôg tìm thấy trang!</h3>
                <p class="text-center">Xin lỗi bạn, chúng tôi không thể tìm kiếm được trang web bạn yêu cầu hoặc có gì đó đã sai... Bạn vui lòng nhập lại tìm kiếm hoặc trở lại Trang chủ!</p>
                <p class="text-center"><a href="/" class="btn-not-found" title="Trở lại trang chủ">Trang chủ</a></p>
            </div>
        </div>
    </div>
</div>
<!-- End Main Content -->
@endsection