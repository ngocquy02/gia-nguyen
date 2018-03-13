@extends('layouts.master')
@section('content')
<!-- Main Content -->
<div class="content_nbp">
    <div class="container">
        <div class="row_pc error">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="text-center">ERROR</h2>
                <h3 class="text-center">{!!$error or 'Thông tin chưa chính xác!'!!}</h3>
                <p class="text-center">Xin lỗi bạn, chúng tôi không thể tìm kiếm được thông tin bạn yêu cầu hoặc có gì đó đã sai... Bạn vui lòng chọn sản phẩm khác hoặc trở lại Trang chủ!</p>
                <p class="text-center"><a href="/" class="btn-not-found" title="Trở lại trang chủ">Trang chủ</a></p>
            </div>
            <div class="clearfix clearfix-20"></div>
        </div>
    </div>
</div>
<!-- End Main Content -->
@endsection