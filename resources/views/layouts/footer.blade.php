
<div class="hotline_fix">	
	<a href="tel: {{$company->Phone}}"> 
		<div id="hiti_phone_div" class="hiti-phone hiti-green hiti-show hiti-static view"> 
			<div class="hiti-ph-circle"></div> 
			<div class="hiti-ph-circle-fill"></div> 
			<div class="hiti-ph-img-circle"><i class="fa fa-phone"></i></div> 
		</div> 
	</a>
</div>

{{-- <footer style="margin-top: 20px">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <img src="{{$company->Logo}}" class="img-fluid" alt="Responsive image" style="margin: auto">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6 info-footer">
                <h2>{{$company->Name}}</h2>
                <address>
                    <span class="kt-footer">[A]</span><span> : {{$company->Address}}</span>
                    <br>
                    <span class="kt-footer">[M]</span><span> : {{$company->Phone}}</span>
                    <br>
                    <span class="kt-footer">[E]</span><span> : {{$company->Email}}</span> <span class="kt-footer">[W]</span><span> : gianguyen.vn</span>
                    <br>
                    <span class="kt-footer">[T]</span><span> : Thứ 2 đến thứ 6: <strong>8h00 - 17h00</strong> | Thứ 7: <strong>8h00 - 12h00</strong></span>
                </address>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 mb-4 mt-2">
                {!! isset($company) ? $company->Map : ""!!}
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="float-left"><span>Phát triển bởi: GIANGUYENAD </span></div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="float-right"><span>Liên kết với chúng tôi: </span>
                    	<img src="assets/images/icon-fb.png" class="img-fluid" alt="Responsive image">
                    	<img src="assets/images/icon-skype.png" class="img-fluid" alt="Responsive image">
                    	<img src="assets/images/icon-youtube.png" class="img-fluid" alt="Responsive image">
                    	<img src="assets/images/icon-google.png" class="img-fluid" alt="Responsive image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer> --}}

<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <img src="assets/images/logo-footer.png" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 info-footer">
                <h2>{{$company->Name}}</h2>
                <address>
                        <span class="kt-footer">[A]</span><span> : {{$company->Address}}</span>
                        <br>
                        <span class="kt-footer">[M]</span><span> : {{$company->Phone}}</span>
                        <br>
                        <span class="kt-footer">[E]</span><span> : {{$company->Email}}</span> <span class="kt-footer">[W]</span><span> : gianguyen.vn</span>
                        <br>
                        <span class="kt-footer">[T]</span><span> : Thứ 2 đến thứ 6: <strong>8h00 - 17h00</strong> | Thứ 7: <strong>8h00 - 12h00</strong></span>
                    </address>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mb-4 mt-2">
               {!! $company->Map!!}
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="float-left"><span>Phát triển bởi: GIANGUYENAD </span>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="float-right"><span>Liên kết với chúng tôi: </span>
                        <img src="assets/images/icon-fb.png" class="img-fluid" alt="Responsive image">
                        <img src="assets/images/icon-skype.png" class="img-fluid" alt="Responsive image">
                        <img src="assets/images/icon-youtube.png" class="img-fluid" alt="Responsive image">
                        <img src="assets/images/icon-google.png" class="img-fluid" alt="Responsive image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>