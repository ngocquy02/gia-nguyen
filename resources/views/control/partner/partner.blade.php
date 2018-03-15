@extends('control.master')
@section('title',isset($item) ? 'Sửa đối tác' : 'Thêm mới đối tác')
@section('menu-left')
{!!getMenuSidebar('partner') !!}
@endsection
@section('content')
<script src="{{ asset('control/validate/form-validation.js') }}"></script>
 <script src="{{ asset('control/validate/jquery.validate.min.js') }}"></script>
 <div class="page-breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{!!route('controller')!!}">Home</a>
        </li>
        <li class="active">Đối tác</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            {{ isset($item) ? 'Sửa đối tác' : 'Thêm đối tác' }}
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
                <span class="widget-caption">Form {{ isset($item) ? 'Sửa đối tác' : 'Thêm đối tác' }}</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                    <form class="form-horizontal" action="@if(isset($item)){{route('postEditPartner')}}@else{{route('postAddPartner')}}@endif" role="form" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$item->id or ''}}">
                        <div class="row">
                            <div class="col-md-6">
                                <span ><strong>Tên đối tác</strong></span>
                                <input type="text" name="Name" class="form-control" placeholder="Nhập tên của đối tác" value="@if (old('Name')){{old('Name')}}@else{{ isset($item) ? $item->Name : '' }}@endif">
                                @if ($errors->has('Name'))
                                    <label class="error">{{ $errors->first('Name') }}</label>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <span ><strong>Đường dẫn</strong></span>
                                <input type="text" name="Url" class="form-control" placeholder="Nhập đường dẫn của đối tác" value="@if (old('Url')){{old('Url')}}@else{{isset($item) ? $item->Url : '' }}@endif">
                                @if ($errors->has('Url'))
                                    <label class="error">{{ $errors->first('Url') }}</label>
                                @endif
                                <br>
                                {{-- @if(isset($item))
            
                                    <img src="{{$item->Img}}" style="width: 100%">
                                @endif --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span><strong>Hình ảnh đại diện</strong></span>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-info btn-file">
                                            Browse… <input type="file" id="imgInp" name="Img">
                                        </span>
                                    </span>
                                    <input type="text" class="form-control" readonly placeholder="Chọn hình ảnh" value="{{isset($item)?$item->Img:''}}">
                                </div>
                                @if ($errors->has('Img'))
                                    <label name="Img" class="error" >{{$errors->first('Img')}}</label>
                                @endif
                                <span ><strong>Hiện đối tác</strong></span>
                                <label style="margin-top: 10px;">
                                    <input class="checkbox-slider slider-icon colored-blue" @if(isset($item) && $item->IsActive ===1) checked="checked" @endif type="checkbox" name="IsActive">
                                    <span class="text"></span>
                                </label>
                                <img id='img-upload'/>
                            </div>
                        </div>
                        <div class="horizontal-space"></div>
                        <div>
                            <button type="submit" class="btn btn-default purple"><i class="fa fa-plus"> Lưu</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<script src="{{ asset('control/assets/js/select.image.js') }}"></script>
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
