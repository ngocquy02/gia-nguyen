</html>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8" />
    <title>Đăng nhập vào trang quản trị</title>

    <meta name="description" content="login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <!--Basic Styles-->
    <link href="{{ asset('control/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('control/assets/css/font-awesome.min.css')}}" rel="stylesheet" />

    <!--Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

    <!--Beyond styles-->
    <link id="beyond-link" href="{{ asset('control/assets/css/beyond.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('control/assets/css/demo.min.css" rel="stylesheet')}}" />
    <link href="{{ asset('control/assets/css/animate.min.css')}}" rel="stylesheet" />
    {{-- <script src="{{ asset('assets/js/skins.min.js')}}"></script> --}}
</head>
<!--Head Ends-->
<!--Body-->
<body>
    <div class="login-container animated fadeInDown">
        <div class="loginbox bg-white">
            <div class="loginbox-title">Đăng nhập</div>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('postLogin') }}">
                        {{ csrf_field() }}
            <div class="loginbox-textbox {{ $errors->has('Email') ? ' has-error' : '' }}">
                <input type="text" name="Email" class="form-control" placeholder="Email" />
                @if ($errors->has('Email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('Email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="loginbox-textbox {{ $errors->has('Password') ? ' has-error' : '' }}">
                <input type="password" name="Password" class="form-control" placeholder="Password" />
                @if ($errors->has('Password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('Password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="loginbox-forgot">
                <a href="#">Forgot Password?</a>
            </div>
            <div class="loginbox-submit">
                <input type="submit" class="btn btn-primary btn-block" value="Login">
            </div>
            {{-- <div class="loginbox-signup">
                <a href="register.html">Sign Up With Email</a>
            </div> --}}
        </div>
        <div class="logobox">
        @if(isset($msg))
            <span class="help-block">
                <strong>{{ $msg }}</strong>
            </span>
        @endif
        </div>
    </div>
    {{-- <script src="{{ asset('control/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('control/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('control/assets/js/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ asset('control/assets/js/beyond.js')}}"></script>    --}}
</body>
</html>

