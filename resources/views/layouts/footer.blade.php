{{-- <footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
				<div class="header-name">
					<h3>Về chúng tôi</h3>
				</div>
				<div class="content-footer">
					<ul>
						<li>{{$company->Name}}</li>
						<li>{{$company->Name}}</li>
						<li><i class="fa fa-phone" aria-hidden="true"></i> {{$company->Phone}}</li>
						<li><i class="fa fa-envelope" aria-hidden="true"></i> {{$company->Email}}</li>
						<li><i class="fa fa-globe" aria-hidden="true"></i> motech.vn</li>
					</ul>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
				<div class="header-name">
					<h3>Thông tin </h3>
				</div>
				<div class="content-footer">
					<ul class="news-link">
						@php
							$listArticleHome=\App\Models\Category::where(['Type'=>1])->first();
						@endphp
						@if ($listArticleHome and $listArticleHome->articles()->where(['IsActive'=>1])->count() > 0)
							@foreach ($listArticleHome->articles()->where(['IsActive'=>1])->orderBy('created_at','desc')->limit(5)->get() as $element)
						<li><a href="{{getLinkById($element->CatId)}}/{{$element->Alias}}.html" title="{{$element->Name}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> {{$element->Name}}</a></li>
							@endforeach
						@endif
					</ul>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
				<div class="header-name">
					<h3>Tin tức nổi bật</h3>
				</div>
				<div class="content-footer">
					<ul class="news-link">
						@php
							$listArticleHot=\App\Models\Article::where(['IsActive'=>1,'IsHot'=>1])->orderBy('created_at','desc')->limit(5)->get();
						@endphp
						@if ($listArticleHot->count() > 0)
						@foreach ($listArticleHot as $element)
						<li><a href="{{getLinkById($element->CatId)}}/{{$element->Alias}}.html" title="{{$element->Name}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> {{$element->Name}}</a></li>
						@endforeach
						@endif
					</ul>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
				<div class="header-name">
					<h3>FANPAGE</h3>
				</div>
				<div class="content-footer">
	                <div class="fb-page" data-href="{!!$company->Facebook!!}" data-height="250" data-width="300" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
	                    <blockquote cite="{!!$company->Facebook!!}" class="fb-xfbml-parse-ignore">
	                        <a href="{!!$company->Facebook!!}">Facebook</a>
	                    </blockquote>
	                </div>
				</div>
			</div>
		</div>   	
	</div>
	<div class="copy-rigth">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<span>Bản quyền thuộc về </span><a href="" title="">Cường Thịnh SoftWare</a>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					
				</div>
			</div>
		</div>
	</div> 
</footer>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</footer>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5a6404544b401e45400c419e/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
 --}}
<div class="hotline_fix">	
	<a href="tel: {{$company->Phone}}"> 
		<div id="hiti_phone_div" class="hiti-phone hiti-green hiti-show hiti-static view"> 
			<div class="hiti-ph-circle"></div> 
			<div class="hiti-ph-circle-fill"></div> 
			<div class="hiti-ph-img-circle"><i class="fa fa-phone"></i></div> 
		</div> 
	</a>
</div>

<footer style="margin-top: 20px">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <img src="{{$company->Logo}}" class="img-fluid" alt="Responsive image" style="margin: auto">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 info-footer">
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
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mb-4 mt-2">
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
</footer>