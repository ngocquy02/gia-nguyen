<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ config('app.locale') }}">
<!-- Head -->
<head>
    <meta charset="utf-8" />
    <title>{{$Title or ''}}</title>

    <meta name="description" content="Dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="REFRESH" content="3; url={{route($route)}}">
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <base href="{{ asset('')}}" >

    <!--Basic Styles-->
    <link href="{{ asset('control/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('control/assets/css/font-awesome.min.css')}}" rel="stylesheet" />
    {{-- <link href="{{ asset('control/assets/css/weather-icons.min.css')}}" rel="stylesheet" /> --}}

    <!--Beyond styles-->
    <link id="beyond-link" href="{{ asset('control/assets/css/beyond.min.css')}}" rel="stylesheet" />
    {{-- <link href="{{ asset('control/assets/css/demo.min.css')}}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('control/assets/css/typicons.min.css')}}" rel="stylesheet" /> --}}
    <link href="{{ asset('control/assets/css/animate.min.css')}}" rel="stylesheet" />

    <!--Page Related styles-->
    <link href="{{ asset('control/assets/css/dataTables.bootstrap.css')}}" rel="stylesheet" />

    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script type="text/javascript" src="{{ asset('control/assets/js/skins.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('control/assets/js/jquery.min.js') }}"></script>
    
</head>
<!-- /Head -->
<!-- Body -->
<body class="body-500">
    <div class="error-header"> 
            <div class="alert alert-danger fade in radius-bordered alert-shadowed" style="text-align: center;">
                <i class="fa-fw fa fa-warning"></i>
                <strong>Warning</strong> Sau 3s sẽ tự chuyển trang.
            </div></div>
    <div class="container ">
        <section class="error-container text-center">
            <h1>ERROR</h1>
            <div class="error-divider">
                <h2>{{$Title or ''}}</h2>
                <p class="description">{{$msg or ''}}</p>
            </div>
            <a href="{{route($route)}}" class="return-btn"><i class="fa fa-home"></i>Quay lại</a>
        </section>
    </div>
</body>
<!--  /Body -->
</html>
