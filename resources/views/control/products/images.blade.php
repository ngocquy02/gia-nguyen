@extends('control.master')
@section('title','Thêm hình ảnh cho sản phẩm')
@section('menu-left')
{!!getMenuSidebar('menu') !!}
@endsection
@section('content')
{{-- <script src="{{ asset('control/validate/form-validation.js') }}"></script>
 <script src="{{ asset('control/validate/jquery.validate.min.js') }}"></script> --}}
 <div class="page-breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{!!route('controller')!!}">Home</a>
        </li>
        <li class="active">Sản Phẩm</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Thêm hình ảnh cho sản phẩm
        </h1>
    </div>
    <!--Header Buttons-->
    <div class="header-buttons">
        <a class="sidebar-toggler active" >
            <i class="fa fa-arrows-h"></i>
        </a>
        <a class="fullscreen" id="fullscreen-toggler" >
            <i class="glyphicon glyphicon-fullscreen"></i>
        </a>
    </div>
</div>
<!-- /Page Header -->
<!-- Page Body -->
<div class="page-body">
<style>.DTTT.btn-group{display: none !important;}</style>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-pink">
                <span class="widget-caption">Form thêm hình ảnh cho sản phẩm</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                        <div class="row">
                        @if(isset($items) && count($items) >0)
                            @foreach($items as $item)
                            <div class="col-md-3" style="    margin-bottom: 10px;">
                                <img src="Upload/product/images/{{$item->Img}}" alt="" width="100%" height="182px">
                                <button style="position: absolute;bottom: 0;" class="btn btn-danger btn-xs delete" data-toggle="modal" data-target="#modal-danger{{$item->id}}"><i class="fa fa-trash-o"></i> Delete</button>
                                <div id="modal-danger{{$item->id}}" class="modal modal-message modal-danger fade" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Cảnh báo!!!!</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Bạn có muốn xóa hình ảnh?</p>
                                            </div>
                                            <div class="modal-footer">
                                            <form action="{{route('postProductImageDelete')}}" method="post" accept-charset="utf-8">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                                <button type="submit" class="btn btn-primary ok" >Đồng ý</button>
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Hủy</button>
                                            </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                            
                                </div>
                            </div>
                            @endforeach
                        @endif
                        </div>
                        <hr>
                    <form class="form-horizontal" action="{{route('postProductImage')}}" role="form" name="" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="ProdId" value="{{$ProdId}}">
                        <div class="row">
                            <div class="col-md-6">
                                <span><strong>Hình ảnh đại diện</strong></span>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-info btn-file">
                                            Browse… <input type="file" id="imgInp" name="Img[]" multiple>
                                        </span>
                                    </span>
                                    <input type="text" id="tb-sl" class="form-control" placeholder="Chọn 1 Hoặc nhiều hình ảnh" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="horizontal-space"></div>
                        <div>
                            <button type="submit" class="btn btn-default purple"><i class="fa fa-plus"> Thêm hình ảnh</i></button>
                            <a class="btn btn-primary" href="{{route('getProductsByCatId',['CatId'=>$CatId])}}"><span class="typcn typcn-arrow-back-outline"></span> Quay lại danh sách sản phẩm</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
$(document).ready( function() {
    $("#imgInp").change(function(){
        $('#tb-sl').val('Đã chọn '+ $(this).get(0).files.length+ ' hình ảnh');
    });
    $('.ok').click(function(){
        $(this).css('display','none');
    });
});
</script>
     {{-- <script src="{{ asset('control/assets/js/select.image.js') }}"></script> --}}
    <style>
    .btn-file {
    position: relative;
    overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
    #img-upload{
        width: 100%;
    }
    </style>
@endsection

