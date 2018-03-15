@extends('control.master')
@section('title',(isset($item))?'Sửa thông tin user':'Thêm user'))
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
                    <span class="widget-caption">{{isset($item)?'Sửa thông tin user':'Thêm thông tin user'}}</span>
                </div>
                <div class="widget-body">
                    <div id="registration-form">
                        <form role="form" action="{{isset($item)?route('postEdit'):route('postRegister')}}" method="post">
                        {{ csrf_field() }}
                            <div class="form-title">
                                Nhập thông tin 
                            </div>
                            <div class="form-group">
                                <span class="input-icon icon-right">
                                    <input hidden="" name="id" value="{{isset($item)? $item->id : ''}}">
                                    <input type="text" class="form-control" id="userameInput" name="FullName" placeholder="Full Name" value="{{isset($item)? $item->FullName : ''}}" required="">
                                    <i class="glyphicon glyphicon-user circular"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="input-icon icon-right">
                                    <input type="email" class="form-control" name="Email" id="emailInput" placeholder="Email Address" value="{{isset($item)? $item->Email : ''}}" required="">
                                    <i class="fa fa-envelope-o circular"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="input-icon icon-right">
                                    <input type="password" class="form-control" name="Password" id="passwordInput" placeholder="Password" required="">
                                    <i class="fa fa-lock circular"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="input-icon icon-right">
                                    <input type="password" class="form-control" name="ConfirmPassword" id="confirmPasswordInput" placeholder="Confirm Password" required="">
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
                                            <input type="text" class="form-control" placeholder="Facebook"  value="{{isset($item)? $item->Facebook : ''}}" required="" name="Facebook">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="input-icon icon-right">
                                            <input type="text" class="form-control" placeholder="Skype"  value="{{isset($item)? $item->Skype : ''}}" required="" name="Skype">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="input-icon icon-right">
                                            <input type="text" class="form-control" placeholder="Google Plus"  value="{{isset($item)? $item->Google : ''}}" required="" name="Google">
                                            <i class="glyphicon glyphicon-earphone"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <span class="input-icon icon-right">
                                            <input type="phone" class="form-control" placeholder="Phone"  value="{{isset($item)? $item->Phone : ''}}" required="" name="Phone">
                                            <i class="glyphicon glyphicon-phone"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="colored-blue">
                                        <span class="text">Auto Sign In After Registration</span>
                                    </label>
                                </div>
                            </div> --}}
                            <button type="submit" class="btn btn-blue">{{isset($item)? 'Lưu' : 'Thêm'}}</button>
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