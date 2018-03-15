@extends('layouts.master')
@section('content')
<div class="list-sp">
    <div class="header-list-sp">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
                <div class="header-name">
                    <h2 class="m-0 p-0">
                        <a href="" title="">
                           TRANG CHỦ > KẾT QUẢ TÌM KIẾM > {{$Keyword or ''}}
                        </a>
                    </h2>
                </div>

            </div>

        </div>
    </div>
    <div class="clearfix"></div>
    <div class="content-list-sp row">
        @foreach($items as $value)
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 item-sp item-sp">
                <div class="product-img">
                    <img src="Upload/product/1.jpg" class="img-fluid" alt="Responsive image">
                </div>
                <div class="product-name">
                    <h3><a href="{{getLinkById($value->CatId)}}/{{$value->Alias}}.html" title="">{{$value->Name}}</a></h3>
                    <div class="xem-them"><a href="{{getLinkById($value->CatId)}}/{{$value->Alias}}.html" title="">Xem thêm</a></div>
                </div>
            </div>
        @endforeach
    </div>
     @if ($items->lastPage() > 1)
            <ul class="pagination float-right">
                @if($items->currentPage() != 1 && $items->lastPage() >= 3)
                    <li>
                        <a href="{{ $items->url($items->url(1)) }}" aria-label="Previous">
                            <span aria-hidden="true"><< Trang đầu</span>
                        </a>
                    </li>
                @endif
                @if($items->currentPage() != 1)
                    <li>
                        <a href="{{ $items->url($items->currentPage()-1) }}" aria-label="Previous">
                            <span aria-hidden="true">&#x3C;&#x3C;</span>
                        </a>
                    </li>
                @endif
                @for($i = max($items->currentPage()-2, 1); $i <= min(max($items->currentPage()-2, 1)+4,$items->lastPage()); $i++)
                @if($items->currentPage() == $i)
                <li class="active">
                @else
                <li>
                @endif
                    <a href="{{ $items->url($i) }}">{{ $i }}</a>
                </li>
                @endfor
                @if ($items->currentPage() != $items->lastPage())
                    <li>
                        <a href="{{ $items->url($items->currentPage()+1) }}" aria-label="Next">
                            <span aria-hidden="true">&#x3E;&#x3E;</span>
                        </a>
                    </li>
                @endif
                @if ($items->currentPage() != $items->lastPage() && $items->lastPage() >= 3)
                    <li>
                        <a href="{{ $items->url($items->lastPage()) }}" aria-label="Next">
                            <span aria-hidden="true">Trang cuối >></span>
                        </a>
                    </li>
                @endif
            </ul>
        @endif
</div>
@endsection
@section('jsProduct')

@endsection
@section('sidebar')
    @include('layouts/hotline-sidebar')
    @include('layouts/news-sidebar')
@endsection