@extends('control.master')
@section('title','Danh sách hiển thị ảnh Slider')
@section('menu-left')
{!!getMenuSidebar('') !!}
@endsection
@section('content')
<div class="page-breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{!!route('controller')!!}">Home</a>
        </li>
        <li class="active">User</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Thông tin user
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
                    <span class="widget-caption">Đăng ký thông tin</span>
                </div>
                <div class="widget-body">
                    <div id="registration-form">
                        <form role="form" action="{{route('postRegister')}}" method="post">
                        {{ csrf_field() }}
                            <div class="form-title">
                                Nhập thông tin đăng nhập
                            </div>
                            <div class="form-group">
                                <span class="input-icon icon-right">
                                    <input type="text" class="form-control" id="userameInput" name="FullName" placeholder="Full Name">
                                    <i class="glyphicon glyphicon-user circular"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="input-icon icon-right">
                                    <input type="text" class="form-control" name="Email" id="emailInput" placeholder="Email Address">
                                    <i class="fa fa-envelope-o circular"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="input-icon icon-right">
                                    <input type="text" class="form-control" name="Password" id="passwordInput" placeholder="Password">
                                    <i class="fa fa-lock circular"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="input-icon icon-right">
                                    <input type="text" class="form-control" name="ConfirmPassword" id="confirmPasswordInput" placeholder="Confirm Password">
                                    <i class="fa fa-lock circular"></i>
                                </span>
                            </div>
                            <div class="form-title">
                                Thông tin liên hệ
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="input-icon icon-right">
                                            <input type="text" class="form-control" placeholder="Facebook">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="input-icon icon-right">
                                            <input type="text" class="form-control" placeholder="Skype">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="input-icon icon-right">
                                            <input type="text" class="form-control" placeholder="Google Plus">
                                            <i class="glyphicon glyphicon-earphone"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="input-icon icon-right">
                                            <input type="text" class="form-control" placeholder="Phone">
                                            <i class="glyphicon glyphicon-phone"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="colored-blue">
                                        <span class="text">Auto Sign In After Registration</span>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-blue">Register</button>
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