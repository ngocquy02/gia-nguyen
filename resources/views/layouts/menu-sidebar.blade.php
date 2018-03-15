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
                            <li><h4><a href="{!!getLinkById($listCatLeftChildren->id)!!}">&#x3E;&nbsp;{!!$listCatLeftChildren->Name!!}</a></h4></li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                        <li><h4><a href="{!!getLinkById($listCatLeft->id)!!}">{!!$listCatLeft->Name!!}</a></h4></li>
                    @endif
                @endforeach
            @else
                <code>Danh mục sản phẩm đang cập nhật</code>
            @endif
        </ul>
    </div>
    <div class="clearfix"></div>
    @include('layouts/hotline-sidebar')
    
    <div class="clearfix"></div>
    
    @yield('sidebar')
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