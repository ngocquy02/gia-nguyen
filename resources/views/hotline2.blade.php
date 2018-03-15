@extends('control.master')
@section('title',isset($item)?'Sửa Hotline':'Thêm hotline')
@section('menu-left')
{!!getMenuSidebar('hotline') !!}
@endsection
@section('content')
<div class="page-breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{!!route('controller')!!}">Home</a>
        </li>
        <li class="active">Hotline</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            {{isset($item) ? 'Sửa Hotline':'Thêm Hotline'}}
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
                    <span class="widget-caption">{{isset($item)?'Sửa Hotline':'Thêm Hotline'}}</span>
                </div>
                <div class="widget-body">
                    <div id="registration-form">
                        <form role="form" action="{{isset($item)? route('postEditHotline',['id'=>$item->id]):route('postAddHotline')}}" method="post">
                        {{ csrf_field() }}
                            <div class="form-title">
                                Nhập thông tin hotline
                            </div>
                            <div class="form-group">
                                @if(isset($item))
                                    <input type="id" name="id" hidden="" value="{{$item->id}}">
                                @endif
                                <span class="input-icon icon-right">
                                    <input type="text" class="form-control" id="userameInput" placeholder="Tên" name="Name" value="{{isset($item)? $item->Name :''}}" required="">
                                    <i class="glyphicon glyphicon-user circular"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="input-icon icon-right">
                                    <input type="text" class="form-control" name="Email" id="emailInput" placeholder="Email" value="{{isset($item)? $item->Email :''}}" required>
                                    <i class="fa fa-envelope-o circular"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="input-icon icon-right">
                                    <input type="text" class="form-control" name="Phone" placeholder="Số điện thoại" value="{{isset($item)? $item->Phone :''}}" required>
                                    <i class="fa fa-phone"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="input-icon icon-right">
                                    <input type="text" class="form-control" name="Skype" placeholder="Skype" value="{{isset($item)? $item->Skype :''}}" required>
                                    <i class="fa fa-skype"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <strong>Hiện hotline</strong>
                                <label style="margin-top: 10px;">
                                    <input class="checkbox-slider slider-icon colored-blue" @if(isset($item) && $item->IsActive ==1) {{'checked="checked"'}} @endif type="checkbox" name="IsActive">
                                    <span class="text"></span>
                                </label>
                            </div>
                            <center>
                                <button type="submit" class="btn btn-blue">{{isset($item)?"Chỉnh sửa":"Thêm"}}</button>
                            </center>
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