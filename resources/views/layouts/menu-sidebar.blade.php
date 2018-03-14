 <div class="col-lg-3 col-md-3 col-ms-12 col-xs-12 pull-md-9 pull-lg-9">
    <div class="dm-sp">
        <span>Danh mục sản phẩm</span>
    </div>
    <div class="clearfix"></div>
    <div class="list-dm">
        <ul class="p-0">
            @php
                $listCatLeft=App\Models\Category::select('id','Alias', 'Name')
                                                ->where([
                                                    ['IsActive','=',1],
                                                    ['Level','=',1],
                                                    ['Type','=',3]
                                                    ])
                                                ->orderBy('Idx')
                                                ->get();
            @endphp
            @if($listCatLeft->count() > 0)
                @foreach($listCatLeft as $listCatLeft)
                    @php
                        $listCatLeftChildren=App\Models\Category::select('id','Alias', 'Name')->where([['IsActive','=',1],['Level','=',2],['ParentID','=', $listCatLeft->id],['Type','=',3]])->orderBy('Idx')->get();
                    @endphp
                    @if($listCatLeftChildren->count() > 0)
                    <li>
                       <h3><a href="{!!$listCatLeft->Alias!!}">{!!$listCatLeft->Name!!}<span class="fa fa-caret-right"></span></a></h3>
                        <ul class="cc-list-child">
                            @foreach($listCatLeftChildren as $listCatLeftChildren)
                            <li><h4><a href="{!!getLinkById($listCatLeftChildren->id)!!}">> {!!$listCatLeftChildren->Name!!}</a></h4></li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                        <li><h4><a href="{!!getLinkById($listCatLeft->id)!!}">>{!!$listCatLeft->Name!!}</a></h4></li>
                    @endif
                @endforeach
            @else
                <code>Danh mục sản phẩm đang cập nhật</code>
            @endif
        </ul>
    </div>
    
    <div class="clearfix"></div>
    <div class="hotline">
        <div class="header-hotline">
            <img src="assets/images/icon-support.png" class="img-fluid" alt="Responsive image"><span>Hotline hỗ trợ</span>
        </div>
        <div class="list-hotline">
            <ul class="user-support">
                <li><img src="assets/images/icon-user-support.png" class="img-fluid icon-user-name" alt="Responsive image"><span class="user-name">Mr.Đồng</span></li>
                <li><a href="" title="" class="phone-hotline"><img src="assets/images/icon-phone-user.png" class="img-fluid icon-user-phone" alt="Responsive image">0906 676 853</a> <a href="" title=""><img src="assets/images/icon-user-skype.png" class="img-fluid icon-user-skype" alt="Responsive image">Skype</a></li>
                <li><a href="mailto:?subject=feedback" class="mail-support"><img src="assets/images/icon-email-user.png" class="img-fluid icon-user-email" alt="Responsive image">Ctygianguyen.ad@gmail.com</a></li>
            </ul>
        </div>
    </div>
    <!-- Tin tức mới nhất -->
    @php 
        $news=App\Models\Article::where(['IsActive'=>1])->orderBy('id','DESC')->limit(5)->get();
    @endphp
    <div class="clearfix"></div>
    <div class="hotline">
        <div class="header-hotline">
            <img src="assets/images/icon-news.png" class="img-fluid" alt="Responsive image"><span>Tin tức mới nhất</span>
        </div>
        @if(count($news)>0)
        <div class="list-hotline">
            
                @foreach($news as $value)
                    @if($loop->iteration ==1)
                        <ul class="ul-news p-0 mb-0">
                            <img src="{{$value->Img}}" class="img-fluid icon-user-name" alt="Responsive image">
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
        </div>
        @else
            <code>Không có bài viết mới nhất</code>
        @endif
    </div>
    <!-- Đối tác -->
    <div class="clearfix"></div>
    <div class="hotline">
        <div class="header-hotline">
            <img src="assets/images/icon-partner.png" class="img-fluid" alt="Responsive image"><span>Đối tác</span>
        </div>
        @php
            $partner = App\Models\Partner::where(['IsActive' => 1])->limit(5)->get();
        @endphp    
        <div class="list-hotline">
            @if($partner->count()>0)
                <ul class="p-0">
                    <a href="{{$partner->Url}}" title=""><img src="{{asset('')}}/{{$partner->Img}}" class="img-fluid partner-img" alt="{{$partner->Name}}"></a>
                </ul>
            @else
                <code>Không có đối tác</code>
            @endif
            

        </div>
    </div>
    <!-- Xưởng sản xuất -->
    <div class="clearfix"></div>
    <div class="hotline">
        <div class="header-hotline">
            <img src="assets/images/icon-xsx.png" class="img-fluid" alt="Responsive image"><span>Xưởng sản xuất</span>
        </div>
        <div class="list-hotline">
            <ul class="p-0">
                <a href="" title=""><img src="Upload/article/xsx-01.jpg" class="img-fluid partner-img" alt="Responsive image"></a>
            </ul>
        </div>
    </div>
    <!-- Thống kê truy cập -->
    <div class="clearfix"></div>
    <div class="hotline">
        <div class="header-hotline">
            <img src="assets/images/icon-tktc.png" class="img-fluid" alt="Responsive image"><span>Thống kê truy cập</span>
        </div>
        <div class="list-hotline">
            <ul class="p-0 list-online">
                <li><span>> Hôm nay:</span><span class="value-online"> 333</span></li>
                <li><span>> Hôm qua:</span><span class="value-online"> 343</span></li>
                <li><span>> Tuần này:</span><span class="value-online"> 3332</span></li>
                <li><span>> Tuần trước:</span><span class="value-online"> 3333</span></li>
                <li><span>> Tháng này:</span><span class="value-online"> 33367</span></li>
                <li><span>> Tháng trước:</span><span class="value-online"> 33343</span></li>
                <li><span>> Tổng lượt truy cập:</span><span class="value-online"> 3334225</span></li>
            </ul>
        </div>
    </div>
    <!-- Facebook -->
    <div class="page-facebook">
        <div class="header-page-facebook">
            <img src="assets/images/logo-2.png" class="img-fluid" alt="Responsive image">
            
            <a href="" title="">www.gianguyenad.vn</a>
        </div>
        <div class="content-facebook">
            <img src="assets/images/avarta-fb.jpg" class="img-fluid" alt="Ảnh đại diện facebook">
            <div class="like-fb">
                <div class="fb-like" data-href="https://facebook.com/xjk.vn" data-width="243" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
            </div>
        </div>
    </div>
</div>