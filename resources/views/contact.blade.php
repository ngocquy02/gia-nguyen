@extends('layouts.master')
@section('content')
<!-- End Main Breadcrumb -->
<!-- Main Content -->
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="header-name">
                <h1>LIÊN HỆ</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 form-style form-contact">
                <form accept-charset='UTF-8' action='{!!route('postContact')!!}' id='contact' method='post'>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <i class="fa fa-user" aria-hidden="true" style="position: absolute;    color: #fff;left: 16px;top: 11px;background-color: #ccc;padding: 12px 15px;"></i>
                            <input type="text" value="" name="FullName" title="Họ và Tên" placeholder="Họ và Tên của khách hàng" class="input-text ">
                            <div class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li style="color: red">{{ $errors->has('FullName') ? $errors->first('FullName') : '' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <i class="fa fa-envelope-o" aria-hidden="true" style="position: absolute;    color: #fff;left: 16px;top: 11px;background-color: #ccc;padding: 12px 15px;"></i>
                            <input type="text" value="" class="input-text" name="Email" placeholder="E-Mail">
                            <div class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li style="color: red">{{ $errors->has('Email') ? $errors->first('Email') : '' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <i class="fa fa-phone" aria-hidden="true" style="position: absolute;    color: #fff;left: 16px;top: 11px;background-color: #ccc;padding: 12px 15px;"></i>
                            <input type="text" value="" class="input-text" name="Phone" placeholder="Số điện thoại">
                            <div class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li style="color: red">{{ $errors->has('Phone') ? $errors->first('Phone') : '' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <i class="fa fa-pencil" aria-hidden="true" style="position: absolute;    color: #fff;left: 16px;top: 11px;background-color: #ccc;padding: 30px 15px;"></i>
                            <textarea name="Content" title="Góp ý của khách hàng" placeholder="Góp ý của khách hàng" class="required-entry input-text" cols="5" rows="3"></textarea>
                            <div class="help-block with-errors">
                                <ul class="list-unstyled">
                                    <li style="color: red">{{ $errors->has('Content') ? $errors->first('Content') : '' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-10">
                            <button type="submit" class="btn-cart">Gửi nhận xét</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="color: blue">{!!$Thankyou or '' !!}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 footer-info ">
                <div class="contact-info">
                    <h3>{!!$company->Name!!}</h3>
                    <p><span class="fa fa-map-marker"></span>{!!$company->Address!!}</p>
                    <p><span class="fa fa-phone"></span>{!!$company->Phone!!}</p>
                    <p><span class="fa fa-envelope"></span><a href="mailto:{!!$company->Email!!}">{!!$company->Email!!}</a></p>
                    <p><span class="fa fa-ravelry"></span><a href="motech.vn">motech.vn</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Content -->    
<div class="container">
    <div class="main-maps">
        <style>iframe{width: 100%;height: 300px;}</style>
        {!! $company->Map!!} 
    </div>
</div>
@endsection