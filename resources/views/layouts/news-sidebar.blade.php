<div class="hotline">
    <div class="header-hotline">
        <img src="assets/images/icon-news.png" class="img-fluid" alt="Responsive image"><span>Tin tức mới nhất</span>
    </div>
    <!-- Tin tức mới nhất -->
    @php 
        $news=App\Models\Article::where(['IsActive'=>1])->orderBy('id','DESC')->limit(5)->get();
    @endphp
    
    <div class="list-hotline">
	    @if(count($news)>0)
	        	
	            @foreach($news as $value)
	                @if($loop->iteration ==1)
	                    <ul class="ul-news p-0 mb-0">
	                        <img src="{{$value->Img}}" class="img-fluid icon-user-name" alt="{{$value->Name}}">
	                        <h3><a href="{{getLinkById($value->CatId)}}/{{$value->Alias}}.html" title="">{{$value->Name}}</a></h3>
	                    </ul>
	                @else
	                    <ul class="ul-news">
	                        <li>
	                            <h3><a href="{{getLinkById($value->CatId)}}/{{$value->Alias}}.html" title="">{{$value->Name}}</a></h3>
	                        </li>
	                    </ul>
	                @endif
	               
	            @endforeach
	    @else
	        <code>Không có bài viết mới nhất</code>
	    @endif
    </div>
</div>
<!-- Đối tác -->
<div class="clearfix"></div>