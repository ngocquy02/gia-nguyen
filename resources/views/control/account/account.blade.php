@extends('control.master')
@section('title',isset($item) ? 'Sửa thành viên' : 'Thêm mới thành viên')
@section('menu-left')
{!!getMenuSidebar('account') !!}
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
        <li class="active">thành viên</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            {{ isset($item) ? 'Sửa thành viên' : 'Thêm thành viên' }}
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
                <span class="widget-caption">Form {{ isset($item) ? 'Sửa thành viên' : 'Thêm thành viên' }}</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                    <form class="form-horizontal" action="@if(isset($item)){{route('postEditAccount')}}@else{{route('postAddAccount')}}@endif" role="form" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$item->id or ''}}">
                        <div class="row">
                            <div class="col-md-6">
                                <span ><strong>Tên thành viên</strong></span>
                                <input type="text" name="FullName" class="form-control" placeholder="Nhập tên của thành viên" value="@if (old('FullName')){{old('FullName')}}@else{{ isset($item) ? $item->FullName : '' }}@endif">
                                @if ($errors->has('FullName'))
                                    <label class="error">{{ $errors->first('FullName') }}</label>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <span ><strong>Email thành viên</strong></span>
                                <input type="text" name="Email" class="form-control" placeholder="Nhập Email của thành viên" value="@if (old('Email')){{old('Email')}}@else{{isset($item) ? $item->Email : '' }}@endif">
                                @if ($errors->has('Email'))
                                    <label class="error">{{ $errors->first('Email') }}</label>
                                @endif
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span ><strong>Công ty</strong></span>
                                <input type="text" name="Company" class="form-control" placeholder="Nhập tên công ty của thành viên" value="@if (old('Company')){{old('Company')}}@else{{isset($item) ? $item->Company : '' }}@endif">
                                @if ($errors->has('Company'))
                                    <label class="error">{{ $errors->first('Company') }}</label>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <span ><strong>Chức vụ</strong></span>
                                <input type="text" name="Role" class="form-control" placeholder="Nhập chức vụ trong công ty" value="@if (old('Role')){{old('Role')}}@else{{isset($item) ? $item->Role : '' }}@endif">
                                @if ($errors->has('Role'))
                                    <label class="error">{{ $errors->first('Role') }}</label>
                                @endif
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span ><strong>Số điện thoại</strong></span>
                                <input type="text" name="Phone" class="form-control" placeholder="Nhập số điện thoại của thành viên" value="@if (old('Phone')){{old('Phone')}}@else{{isset($item) ? $item->Phone : '' }}@endif">
                                @if ($errors->has('Phone'))
                                    <label class="error">{{ $errors->first('Phone') }}</label>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <span ><strong>Địa chỉ</strong></span>
                                <input type="text" name="Address" class="form-control" placeholder="Nhập địa chỉ của thành viên" value="@if (old('Address')){{old('Address')}}@else{{isset($item) ? $item->Address : '' }}@endif">
                                @if ($errors->has('Address'))
                                        <label class="error">{{ $errors->first('Address') }}</label>
                                @endif
                                <br>
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
