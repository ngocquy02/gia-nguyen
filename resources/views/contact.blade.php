@extends('layouts.master')
@section('content')
<div class="list-sp">
    <div class="header-list-sp">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
                <div class="header-name">
                    <h2 class="m-0 p-0">
                        <a href="{{$root}}" title="">
                             TRANG CHỦ &#x3E; LIÊN HỆ
                        </a>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

      <div class="content-list-sp row">
        
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 40px">
            <form action="{{route('postContact')}}" method="POST" role="form">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="text" class="form-control contact" id="full-name" placeholder="Họ và Tên của khách hàng" required="" name="FullName">
                    
                    <input type="email" class="form-control contact" id="email" placeholder="Email" required="" name="Email">
                    
                    <input type="phone" class="form-control contact" id="" placeholder="Số điện thoại" required="" name="Phone">
                   
                    <textarea name="Content" id="input" class="form-control contact" rows="3" required="required" placeholder="Góp ý của khách hàng" style="min-height: 100px;" required=""></textarea>
                </div>
                <div class="text-center" style="margin-bottom: 15px">{{$Thankyou or '' }}</div>
                <center>
                    <button type="submit" class="btn btn-primary text-center">
                        Gửi và nhận xét
                    </button>
                </center>
            </form>          
        </div>
        <div  class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
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
@endsection

@section('jsProduct')
    <script type="text/javascript">
        function contact(){

        }
    </script>
@endsection
@section('sidebar')
    @include('layouts/news-sidebar')
@endsection