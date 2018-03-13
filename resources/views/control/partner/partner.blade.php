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
                                <input type="text" name="FullName" class="form-control" placeholder="Nhập tên của đối tác" value="@if (old('FullName')){{old('FullName')}}@else{{ isset($item) ? $item->FullName : '' }}@endif">
                                @if ($errors->has('FullName'))
                                    <label class="error">{{ $errors->first('FullName') }}</label>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <span ><strong>Email đối tác</strong></span>
                                <input type="text" name="Email" class="form-control" placeholder="Nhập Email của đối tác" value="@if (old('Email')){{old('Email')}}@else{{isset($item) ? $item->Email : '' }}@endif">
                                @if ($errors->has('Email'))
                                    <label class="error">{{ $errors->first('Email') }}</label>
                                @endif
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span ><strong>Công ty</strong></span>
                                <input type="text" name="Company" class="form-control" placeholder="Nhập tên công ty của đối tác" value="@if (old('Company')){{old('Company')}}@else{{isset($item) ? $item->Company : '' }}@endif">
                                @if ($errors->has('Company'))
                                    <label class="error">{{ $errors->first('Company') }}</label>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <span ><strong>Biển số xe</strong></span>
                                <input type="text" name="Role" class="form-control" placeholder="Nhập biển số xe" value="@if (old('Role')){{old('Role')}}@else{{isset($item) ? $item->Role : '' }}@endif">
                                @if ($errors->has('Role'))
                                    <label class="error">{{ $errors->first('Role') }}</label>
                                @endif
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span ><strong>Số điện thoại</strong></span>
                                <input type="text" name="Phone" class="form-control" placeholder="Nhập số điện thoại của đối tác" value="@if (old('Phone')){{old('Phone')}}@else{{isset($item) ? $item->Phone : '' }}@endif">
                                @if ($errors->has('Phone'))
                                    <label class="error">{{ $errors->first('Phone') }}</label>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <span ><strong>Địa chỉ</strong></span>
                                <input type="text" name="Address" class="form-control" placeholder="Nhập địa chỉ của đối tác" value="@if (old('Address')){{old('Address')}}@else{{isset($item) ? $item->Address : '' }}@endif">
                                @if ($errors->has('Address'))
                                        <label class="error">{{ $errors->first('Address') }}</label>
                                @endif
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span ><strong>CMND</strong></span>
                                <input type="text" name="Cmnd" class="form-control" placeholder="Nhập số Chứng minh nhân dân" value="@if (old('Cmnd')){{old('Cmnd')}}@else{{isset($item) ? $item->Cmnd : '' }}@endif">
                                @if ($errors->has('Cmnd'))
                                    <label class="error">{{ $errors->first('Cmnd') }}</label>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <span ><strong>Ngày tháng năm sinh</strong></span>
                                <input type="date" name="Birthday" id="input" class="form-control" value="@if (old('Birthday')){{old('Birthday')}}@else{{isset($item) ? $item->Birthday : '' }}@endif" required="required" title="">
                                @if ($errors->has('Birthday'))
                                        <label class="error">{{ $errors->first('Birthday') }}</label>
                                @endif
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span ><strong>Giấy phép lái xe</strong></span>
                                <input type="text" name="Gplx" class="form-control" placeholder="Nhập giấy phép lái xe của đối tác" value="@if (old('Gplx')){{old('Gplx')}}@else{{isset($item) ? $item->Gplx : '' }}@endif">
                                @if ($errors->has('Gplx'))
                                    <label class="error">{{ $errors->first('Gplx') }}</label>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <span ><strong>Giấy tờ xe</strong></span>
                                <input type="text" name="Gtx" class="form-control" placeholder="Nhập Giáy tờ xe của đối tác" value="@if (old('Gtx')){{old('Gtx')}}@else{{isset($item) ? $item->Gtx : '' }}@endif">
                                @if ($errors->has('Gtx'))
                                        <label class="error">{{ $errors->first('Gtx') }}</label>
                                @endif
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span ><strong>Phương tiện</strong></span>
                                <input type="text" name="CustomerType" class="form-control" placeholder="Nhập loại xe" value="@if (old('CustomerType')){{old('CustomerType')}}@else{{isset($item) ? $item->CustomerType : '' }}@endif">
                                @if ($errors->has('CustomerType'))
                                        <label class="error">{{ $errors->first('CustomerType') }}</label>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <span ><strong>Nội dung hợp tác</strong></span>
                                <input type="text" name="Content" class="form-control" placeholder="Nhập nội dung tác" value="@if (old('Content')){{old('Content')}}@else{{ isset($item) ? $item->Content : '' }}@endif">
                                @if ($errors->has('Content'))
                                        <label class="error">{{ $errors->first('Content') }}</label>
                                @endif
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span ><strong>Kích hoạt</strong></span>
                                <label style="margin-top: 10px;">
                                    <input class="checkbox-slider slider-icon colored-blue" @if(isset($item) && $item->IsActive ==1) checked="checked" @endif type="checkbox" name="IsActive">
                                    <span class="text"></span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <span ><strong>Số tiền</strong></span>
                                <input type="number" name="Coin" class="form-control" placeholder="Nhập số tiền cho đối tác" value="@if (old('Coin')){{old('Coin')}}@else{{ $item->Coin or 0 }}@endif">
                                @if ($errors->has('Coin'))
                                    <label class="error">{{ $errors->first('Coin') }}</label>
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
