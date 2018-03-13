<!DOCTYPE html>

<html lang="vi" class="mostly-customized-scrollbar">

<head>

    <meta charset="UTF-8" />

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="content-language" content="vi" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <meta name="robots" content="@yield('robot', 'noodp,noindex,nofollow')"" />

    <meta name='revisit-after' content='1 days' />

    <base href="{{asset('')}}" >

    <link rel="icon" href="{{asset('trademarks/favicon.png')}}" type="image/x-icon" />

    <link rel="canonical" href="{{url()->full()}}" />

    @include('layouts.share')   

    <!-- CSS -->

    <link rel="alternate" type="application/rss+xml" title="Tiêu đề của trang RSS" href="{{url()->full()}}/rss/" />

    <link rel="stylesheet" href="{{asset('assets/css/fonts.css?v=1.0.2')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css?v=1.0.5')}}">
    <link rel="stylesheet" href="{{asset('assets/css/menu.css?v=1.0.4')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/slick/slick-theme.css')}}">       

</head>

<body >

    <header class="header">

    @include('layouts.header')           

    </header>

    @include('layouts.menu')

    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-ms-12 col-xs-12 push-md-3 push-lg-3">
                    <!-- Main Slider -->
                    @include('layouts.slider')
                    <!-- End slider -->
                    <div class="clearfix"></div>
                    @yield('content')       
                    
                </div>
               @include('layouts.menu-sidebar')
                
            </div>
        </div>
    </div>
    <!-- Footer -->      

    @include('layouts.footer')
    

    <div id="fb-root"></div>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=648155585386495&autoLogAppEvents=1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>

</body>

<script type="text/javascript" src="{{asset('assets/js/jquery/jquery-1.11.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{asset('assets/slick/slick.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{asset('assets/js/menu/menu.js')}}" type="text/javascript" charset="utf-8"></script>
<!-- <script src="{{asset('assets/slick/slick.min.js')}}" type="text/javascript" charset="utf-8"></script> -->
<script>
$(document).ready(function() {
    $('.center').slick();
});
</script>
<div id="fb-root"></div>
<script>
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=133675973870873&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<script type="text/javascript">
    $("#cssmenu").menumaker({
        title: "Menu",
        format: "multitoggle"
    });
</script>

    @yield('jsProduct')

</html>