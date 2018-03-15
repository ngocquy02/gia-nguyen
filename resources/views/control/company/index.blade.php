@extends('control.master')
@section('title','Thông tin công ty')
@section('menu-left')
{!!getMenuSidebar('company') !!}
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
        <li class="active">Thông tin công ty</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Chi tiết thông tin công ty
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
<div class="row">
    <div class="col-md-12">
        <div class="profile-container">
            <div class="profile-header row">
                <div class="col-lg-2 col-md-4 col-sm-12 text-center">
                    <img src="@if (isset($item) && $item->Logo!='')
                    {{ $item->Logo }}
                    @else
                    control/assets/img/avatars/divyia.jpg
                @endif" alt="Logo của công ty" class="header-avatar" />
                </div>
                
                <div class="col-lg-5 col-md-8 col-sm-12 profile-info">
                    <div class="header-fullname">
                        @if (isset($item) && $item->Name!='')
                        {{ $item->Name }}
                        @else
                        Tên của công ty
                        @endif
                    </div>
                    <div class="header-information">
                        @if (isset($item) && $item->MetaDescription!='')
                        {{ $item->MetaDescription }}
                        @else
                        Mô tả về công ty
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 profile-stats">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 stats-col">
                            <div class="stats-value pink">286</div>
                            <div class="stats-title">Bài viết</div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 stats-col">
                            <div class="stats-value pink">803</div>
                            <div class="stats-title">Sản phẩm</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 inlinestats-col">
                            <i class="fa fa-phone"></i>
                        {{ $item->Phone or "Hotline của công ty"}}
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 inlinestats-col">
                            <i class="fa fa-calendar-o"></i>
                        {{ $item->created_at or " Ngày tạo website công ty"}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-body">
                <div class="col-lg-12">
                    <div class="tabbable">
                        <ul class="nav nav-tabs tabs-flat  nav-justified" id="myTab11">
                            <li class="tab-palegreen active">
                                <a data-toggle="tab" id="contacttab" href="#contacts">
                                    Thông tin liên hệ
                                </a>
                            </li>
                            <li class="tab-yellow">
                                <a data-toggle="tab" href="#settings">
                                    Thay đổi thông tin
                                </a>
                            </li>
                            <li class="tab-red">
                                <a data-toggle="tab" href="#khac">
                                    Khác
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content tabs-flat">
                            <div id="contacts" class="tab-pane active">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="profile-contacts">

                                            <div class="profile-badge orange"><i class="fa fa-phone orange"></i><span>Contacts</span></div>
                                            <div class="contact-info">
                                                <p>
                                                    Phone       : {{ $item->Phone or 'Hotline của công ty'}} <br>
                                                                
                                                    Email       :  {{ $item->Email or 'Email của công ty'}}
                                                           
                                                </p>
                                                <p>
                                                    Facebook    : {{ $item->Facebook or 'Facebook của công ty'}}<br>
                                                    
                                                    Google      :{{ $item->Google or 'Google Plus công ty'}}
                                                </p>
                                                <p>
                                                    Skype       :{{ $item->Skype or 'Skype của công ty'}}
                                                    <br>
                                                    Twitter     : {{ $item->Twitter or 'Twitter của công ty'}}
                                                </p>
                                            </div>
                                            <div class="profile-badge azure">
                                                <i class="fa fa-map-marker azure"></i><span>Location</span>
                                            </div>
                                            <div class="contact-info">
                                                <p>
                                                    Address: <br>{{ $item->Address or 'Địa chỉ của công ty'}}
                                                </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="animated flipInY" style="margin-top: 30px;height: 300px;">
                                    <style>
                                        iframe{width: 100%;height: 100%;}
                                    </style>
                                         {!! $item->Map or "Chưa có bản đồ công ty"!!}
                                        </div>
                                        <div>
                                            <form action="{{route('postCompanyMap')}}" name='frm_map' method="post" accept-charset="utf-8">
                                             {{ csrf_field() }}
                                             <input type="hidden" name="id" value="{{ $item->id or ''}}">
                                            <span><strong>Nhúng bản đồ</strong></span>
                                            <input class="form-control {{ $errors->has('Map') ? ' has-error' : '' }}" type="text" id="map" rows="3">
                                            <input type="text" name="Map" hidden="" id="toado">
                                            {{-- <textarea name="Map"  class="form-control {{ $errors->has('Map') ? ' has-error' : '' }}" rows="3" placeholder="Nhúng bản đồ"></textarea> --}}
                                            @if ($errors->has('Map'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('Map') }}</strong>
                                                </span>
                                            @endif
                                            <br>
                                            <button type="submit" class="btn btn-primary">Cập nhật Map</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="settings" class="tab-pane">
                                <form role="form" action="{{route('postCompany')}}" method="post" name='frm_company' accept-charset="utf-8">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $item->id}}">
                                    <div class="form-title">
                                        Thông tin công ty
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <span class="input-icon icon-right">
                                                    <input type="text" name="Name" class="form-control" placeholder="Nhập tên công ty" value="{{ $item->Name or ""}}">
                                                    <i class="fa fa-user blue"></i>
                                                </span>
                                                @if ($errors->has('Name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('Name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <span class="input-icon icon-right">
                                                    <input type="text" name="Email" class="form-control" value="{{ $item->Email or ""}}" placeholder="Nhập Email">
                                                    <i class="fa fa-envelope-o orange"></i>
                                                </span>
                                                @if ($errors->has('Email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('Email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <span class="input-icon icon-right">
                                                    <input type="text" name="Phone" value="{{ $item->Phone or ""}}" class="form-control" placeholder="Nhập Hotline">
                                                    <i class="glyphicon glyphicon-earphone yellow"></i>
                                                </span>
                                                @if ($errors->has('Phone'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('Phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <span class="input-icon icon-right">
                                                    <input type="text" name="Address" value="{{ $item->Address or ""}}" class="form-control" placeholder="Nhập Địa chỉ">
                                                    <i class="glyphicon glyphicon-phone palegreen"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="wide">
                                    <div class="form-title">
                                        Social Networks
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <span class="input-icon icon-right">
                                                    <input type="text" name="Facebook" value="{{ $item->Facebook or ""}}" class="form-control" placeholder="Nhập Facebook">
                                                    <i class="fa fa-facebook purple"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <span class="input-icon icon-right">
                                                    <input type="text" name="Twitter" value="{{ $item->Twitter or ""}}" class="form-control" placeholder="Nhập Twitter">
                                                    <i class="fa fa-twitter azure"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <span class="input-icon icon-right">
                                                    <input type="text" name="Google" value="{{ $item->Google or ""}}" class="form-control" placeholder=" Nhập Google Plus">
                                                    <i class="fa fa-google-plus-square red"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <span class="input-icon icon-right">
                                                    <input type="text" name="Zalo" value="{{ $item->Zalo or ""}}" class="form-control" placeholder="Nhập Zalo">
                                                    <i class="fa fa-flickr blue"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <span class="input-icon icon-right">
                                                    <input type="text" name="Skype" value="{{ $item->Skype or ""}}" class="form-control" placeholder="Nhập Skype">
                                                    <i class="fa fa-skype blue"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <span class="input-icon icon-right">
                                                    <input type="text" name="Viber" value="{{ $item->Viber or ""}}" class="form-control" placeholder="Nhập Viber">
                                                    <i class="fa fa-vimeo-square blue"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-title">
                                        Contact Information
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <span class="input-icon icon-right">
                                                Mã Google Analytic
                                                    <textarea name="Analytic" class="form-control" rows="3" >{{ $item->Analytic or ''}}</textarea>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <span class="input-icon icon-right">
                                                Mã Chatbox
                                                    <textarea name="Chatbox" class="form-control" rows="3" >{{ $item->Chatbox or ''}}</textarea>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="wide">
                                    <div class="form-title">
                                        Thông tin SEO
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            Meta Title
                                            <textarea name="MetaTitle"  class="form-control" rows="3"  placeholder="Nhập MetaTitle">{{ $item->MetaTitle or ''}}</textarea>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                Meta Description
                                            <textarea name="MetaDescription" class="form-control" rows="3"  placeholder="Nhập MetaDescription">{{ $item->MetaDescription or ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                Meta Keyword
                                            <textarea name="MetaKeyword" class="form-control" rows="3"  placeholder="Nhập MetaKeyword">{{ $item->MetaKeyword or ''}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Lưu </button>
                                </form>
                            </div>
                            <div id="khac" class="tab-pane">
                                    <div class="form-title">
                                        Hình ảnh
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <form role="form" action="{{ route('postCompanyLogo') }}" name='frm_logo' method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $item->id}}">
                                            <div class="form-group">
                                            Logo công ty
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-info btn-file">
                                                        Browse… <input type="file" id="imgInp" name="Logo">
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control" readonly>
                                            </div>
                                            <img id='img-upload'/>
                                                {{-- <input type="file" name="Logo" id="Logo" value="" placeholder="Chọn hình ảnh làm logo"> --}}
                                                @if ($errors->has('Logo'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('Logo') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                                <button type="submit" class="btn btn-primary">Thay đổi ảnh</button>
                                            </form>
                                        </div>
                                        <div class="col-sm-6">
                                            <form role="form" action="{{ route('postCompanyImg') }}" name='frm_img' method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $item->id}}">
                                            <div class="form-group">
                                                Ảnh nền
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <span class="btn btn-info btn-file">
                                                            Browse… <input type="file" id="imgImage" name="Img">
                                                        </span>
                                                    </span>
                                                    <input type="text" class="form-control"  placeholder="Chọn hình ảnh nền" readonly>
                                                </div>
                                                <img id='img-upload-image'/>
                                                @if ($errors->has('Img'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('Img') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <button type="submit" class="btn btn-primary">Thay đổi ảnh</button>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="{{ asset('control/assets/js/select.image.js') }}"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCO1AzjPipE1ByhCYlSDa07dvwNHLSPOJo&libraries=places"></script>

<script type="text/javascript">
 function map() {
    var input = document.getElementById('map');
    var autocomplete = new google.maps.places.Autocomplete(input);
     google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        var url = '<iframe src = "https://maps.google.com/maps?q=' + lat +','+lng +'&hl=es;z=14&amp;output=embed" style="width:100%;height:100%"></iframe>';
        $("#toado").val(url);

     })
 }
 google.maps.event.addDomListener(window, 'load', map);

</script>
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
#img-upload,#img-upload-image{
    width: 100%;
}
    </style>
@endsection