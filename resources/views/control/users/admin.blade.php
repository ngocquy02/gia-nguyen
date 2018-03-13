@extends('control.master')
@section('title','Danh sách hiển thị ảnh Slider')
@section('menu-left')
{!!getMenuSidebar('') !!}
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
        <li class="active">Admin</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Thông tin Admin
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
        <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="widget flat radius-bordered">
                <div class="widget-header bg-blue">
                    <span class="widget-caption">Thay đổi thông tin</span>
                </div>
                <div class="widget-body">
                    <div id="registration-form">
                        <form role="form" action="{{route('postEdit')}}" method="post" name="frm_admin_edit">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$item->id}}">
                            <div class="form-title">
                                Thông tin đăng nhập
                                @if(session('msg'))
                                    @push('scripts')
                                    <script>$(document).ready(function(){Notify("{{ session('msg') }}", "top-right", "5000", "success", "fa-check", true);});</script>
                                    @endpush
                                @endif
                            </div>
                            <div class="form-group  {{ $errors->has('FullName') ? ' has-error' : '' }}">
                                <span class="input-icon icon-right">
                                    <input type="text" value="{{$item->FullName}}" class="form-control" id="userameInput" name="FullName" placeholder="Full Name">
                                    <i class="glyphicon glyphicon-user circular"></i>
                                </span>
                                @if ($errors->has('FullName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('FullName') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group  {{ $errors->has('Email') ? ' has-error' : '' }}">
                                <span class="input-icon icon-right">
                                    <input type="text" class="form-control" value="{{$item->Email}}" name="Email" id="emailInput" placeholder="Email Address">
                                    <i class="fa fa-envelope-o circular"></i>
                                </span>
                                @if ($errors->has('Email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group   {{ $errors->has('Password') ? ' has-error' : '' }}">
                                <span class="input-icon icon-right">
                                    <input type="password" class="form-control" name="Password" id="Password" placeholder="Password">
                                    <i class="fa fa-lock circular"></i>
                                </span>
                                @if ($errors->has('Password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group   {{ $errors->has('ConfirmPassword') ? ' has-error' : '' }}">
                                <span class="input-icon icon-right">
                                    <input type="password" class="form-control" name="ConfirmPassword" id="confirmPassword" placeholder="Confirm Password">
                                    <i class="fa fa-lock circular"></i>
                                </span>
                                @if ($errors->has('ConfirmPassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ConfirmPassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-blue">Lưu thay đổi</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection