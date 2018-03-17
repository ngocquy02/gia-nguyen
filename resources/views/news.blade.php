@extends('layouts.master')
@section('content')
<div class="list-sp">
    <div class="header-list-sp">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
                <div class="header-name">
                    <h2 class="m-0 p-0">
                        <a href="" title="">
                             TRANG CHỦ &#x3E;
                            @if(isset($RootName))
                                {{$RootName}}
                            @endif
                            @if(isset($checkParent))
                                 &#x3E; {{$checkParent}}
                            @endif
                            @if(isset($checkChild))
                                &#x3E; {{$checkChild}}
                            @endif

                        </a>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="list-news">
        @foreach($items as $item)
            @if($item->IsActive == 1)
            <div class="item-new row ml-0 mr-0">
                <div class="col-md-4 col-lg-4 pl-0">
                      <img src="{{ asset('') }}/{{$item->Img}}" class="img-fluid" alt="{{$item->Name}}">
                </div>
                <div class="col-md-8 col-lg-8">
                    <a href="{{getLinkById($item->CatId)}}/{{$item->Alias}}.html" title="{{$item->Name}}"><h3 class="name-news">{{$item->Name}}</h3></a>
                    <p>{!!$item->ShortContent!!}</p>
                    <a href="{{getLinkById($item->CatId)}}/{{$item->Alias}}.html" title="Xem chi tiết" class="float-right news-detail"> Xem chi tiết</a>
                </div>
            </div>
            @endif
        @endforeach
        <div class="clearfix"></div>
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
</div>


@endsection

@section('sidebar')
    @include('layouts/news-sidebar')
@endsection