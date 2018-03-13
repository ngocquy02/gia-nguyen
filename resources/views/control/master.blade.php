<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ config('app.locale') }}">

<!-- Head -->

<head>

    <meta charset="utf-8" />

    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="description" content="Dashboard" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="icon" href="{{asset('trademarks/favicon.png')}}" type="image/x-icon" />

    <base href="{{ asset('')}}" >

    <!--Basic Styles-->

    <link href="{{ asset('control/assets/css/bootstrap.min.css')}}" rel="stylesheet" />

    <link href="{{ asset('control/assets/css/font-awesome.min.css')}}" rel="stylesheet" />

    {{-- <link href="{{ asset('control/assets/css/weather-icons.min.css')}}" rel="stylesheet" /> --}}

    <!--Beyond styles-->

    <link id="beyond-link" href="{{ asset('control/assets/css/beyond.min.css')}}" rel="stylesheet" />

    {{-- <link href="{{ asset('control/assets/css/demo.min.css')}}" rel="stylesheet" /> --}}

    <link href="{{ asset('control/assets/css/typicons.min.css')}}" rel="stylesheet" />

    <link href="{{ asset('control/assets/css/animate.min.css')}}" rel="stylesheet" />

    <!--Page Related styles-->

    <link href="{{ asset('control/assets/css/dataTables.bootstrap.css')}}" rel="stylesheet" />
    <link href="{{ asset('control/assets/css/tag.css')}}" rel="stylesheet" />

    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->

    @yield('callCk')

    <script type="text/javascript" src="{{ asset('control/assets/js/skins.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('control/assets/js/jquery.min.js') }}"></script>    

</head>

<!-- /Head -->

<!-- Body -->

<body>

    <!-- Loading Container -->

    <div class="loading-container">

        <div class="loader"></div>

    </div>

    <!--  /Loading Container -->

    <!-- Navbar -->

    <div class="navbar">

        <div class="navbar-inner">

            <div class="navbar-container">

                <!-- Navbar Barnd -->

                <div class="navbar-header pull-left" style="position: relative;bottom: 5px;">

                        <!-- <p style="line-height: 40px;color: #ffffff;font-size: 25px;font-weight: bold;">XJK ADMIN</p> -->

                        <h5 class="row-title before-success"><i class="fa fa-wrench blue"></i>Quản trị website</h5>

                </div>

                <div class="sidebar-collapse" id="sidebar-collapse">

                    <i class="collapse-icon fa fa-bars"></i>

                </div>

                <div class="navbar-header pull-left" style="position: relative;bottom: 5px; left: 40px;">

                        <!-- <p style="line-height: 40px;color: #ffffff;font-size: 25px;font-weight: bold;">XJK ADMIN</p> -->

                        <h5 class="row-title before-darkorange"><a href="" title="website" target="_blank"><i class="fa fa-home blue"></i>Đến website</a></h5>

                </div>

                

                <!-- /Navbar Barnd -->

                <div class="navbar-header pull-right">

                    <div class="navbar-account">

                        <ul class="account-area">

                            <li >

                                <a class="dropdown-toggle" data-toggle="dropdown" title="Thao tác tài khoản" href="#" aria-expanded="true">

                                    <i class="icon glyphicon glyphicon-user"></i>

                                </a>

                                <!--Messages Dropdown-->

                                <ul class="pull-right dropdown-menu dropdown-arrow dropdown-palegreen">

                                    <li>

                                        <a  tabindex="-1">

                                            <i class="fa fa-user"></i>

                                            {{Auth::user()->FullName}}

                                        </a>

                                    </li>

                                    <li>

                                        <a href="{{route('getEdit',['id'=>Auth::user()->id])}}" tabindex="-1">

                                            <i class="dropdown-icon glyphicon glyphicon-cog"></i>

                                            Thay đổi thông tin

                                        </a>

                                    </li>

                                    <li>

                                         <a href="{{ route('logout') }}"

                                                onclick="event.preventDefault();

                                                         document.getElementById('logout-form').submit();">

                                                <i class="dropdown-icon glyphicon glyphicon-log-out"></i>

                                                Đăng xuất

                                            </a>



                                            <form id="logout-form" action="{{ route('postLogout') }}" method="POST" style="display: none;">

                                                {{ csrf_field() }}

                                            </form>

                                    </li>

                                </ul>

                                <!--/Messages Dropdown-->

                            </li>

                            <li>

                                <div class="navbar-header pull-left" style="position: relative;bottom: 5px; left: 40px;">

                        <!-- <p style="line-height: 40px;color: #ffffff;font-size: 25px;font-weight: bold;">XJK ADMIN</p> -->

                        <h5 class="row-title before-darkorange"><a href="{!!route('getSitemap')!!}" title="Cập nhật Sitemap cho website" ><i class="fa fa-sitemap"></i>Cập nhật SiteMap</a></h5>

                </div>

                            </li>

                        </ul>

                        <!-- Settings -->

                    </div>

                </div>

                        <!-- Settings -->

                    </div>

                </div>

                <!-- /Account Area and Settings -->

            </div>

        </div>

    </div>

    <!-- /Navbar -->

    <!-- Main Container -->

    <div class="main-container container-fluid">

        <!-- Page Container -->

        <div class="page-container">  

            <!-- Page Sidebar -->

            <div class="page-sidebar" id="sidebar">

                <!-- Page Sidebar Header-->

                <div class="sidebar-header-wrapper">

                    <input type="text" class="searchinput" />

                    <i class="searchicon fa fa-search"></i>

                    <div class="searchhelper">Search Reports, Charts, Emails or Notifications</div>

                </div>

                <!-- /Page Sidebar Header -->

                <!-- Sidebar Menu -->

                @yield('menu-left')               

                </div>

            <!-- /Chat Bar -->

            <!-- Page Content -->

            <div class="page-content">

                <!-- Page Breadcrumb -->                

                    @yield('content')                

            <!-- /Page Content -->

            </div>

        </div>

        <!-- /Page Container -->

        <!-- Main Container -->

    </div>

    <!--Basic Scripts-->

    <script type="text/javascript" src="{{ asset('control/assets/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('control/assets/js/slimscroll/jquery.slimscroll.min.js') }}"></script>



    <!--Beyond Scripts-->

    <script type="text/javascript" src="{{ asset('control/assets/js/beyond.min.js') }}"></script>



    <!--Page Related Scripts-->

    <script type="text/javascript" src="{{ asset('control/assets/js/datatable/jquery.dataTables.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('control/assets/js/datatable/ZeroClipboard.js') }}"></script>

    <script type="text/javascript" src="{{ asset('control/assets/js/datatable/dataTables.tableTools.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('control/assets/js/datatable/dataTables.bootstrap.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('control/assets/js/datatable/datatables-init.js') }}"></script>

    <script type="text/javascript" src="{{ asset('control/assets/js/toastr/toastr.js') }}"></script>
    
    <script>

        InitiateSearchableDataTable.init();
    </script>

    @yield('jsCk')

</body>

<!--  /Body -->

</html>

