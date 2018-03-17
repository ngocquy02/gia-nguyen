@extends('layouts.master')
@section('slider')
    @include('layouts.slider')
@endsection
@section('content')
    
<div class="list-sp">
    <div class="header-list-sp">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
                <div class="header-name">
                    <h2 class="m-0 p-0">
                        <a href="" title="">
                            Trang chủ
                            @if($RootName)
                           &#x3E;&nbsp;   {!!$RootName!!}
                            @endif
                            @if(isset($checkParent))
                            &#x3E;&nbsp;   {!!$checkParent!!}
                            @endif 
                            @if(isset($checkChild))
                            &#x3E;&nbsp;   {!!$checkChild!!}
                            @endif
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
<script src="{{asset('js/owl.carousel.min.1.js')}}"></script>
<script >
    $(document).ready(function(){
        $.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
        $('#check-role').change(function(){
            if ($(this).val()==1) {
                $('.chieudi').html('<div class="col-md-6"><div class="radio"><label id="1chieu"><input type="radio" name="IsHome" id="input" value="0" checked="checked">1 Chiều</label></div></div>');
            } else {
                $('.chieudi').html('<div class="col-md-6"><div class="radio"><label id="1chieu"><input type="radio" name="IsHome" id="input" value="0" checked="checked">1 Chiều</label></div></div><div class="col-md-6"><div class="radio"><label id="2chieu"><input type="radio" name="IsHome" value="1">2 Chiều</label></div></div>')
            }
        });
        $('#checkprice').click(function(){
            var AddressStart=$('input[name="AddressStart"]').val();
            var AddressEnd=$('input[name="AddressEnd"]').val();
            var Role=$('select[name="Role"]').val();
            var IsHome=$('input:radio[name="IsHome"]:checked').val();
            var Weight=$('input[name="Weight"]').val();
            var VehicleType=$('select[name="VehicleType"]').val();
            console.log(Role);
            if (AddressStart=='') {alert('Chưa nhập địa chỉ đi!');}
            else {
                if (AddressEnd=='') {alert('Chưa nhập địa chỉ đến');} 
                else {
                    if (Role==1 && Weight=='') {alert('Chưa nhập khối lượng!');} 
                    else {
                        $.ajax({
                        url:'{{route('postcheckKm')}}', 
                        type:'post',
                        cache:false,
                        data:{AddressStart:AddressStart,AddressEnd:AddressEnd,Role:Role,IsHome:IsHome,Weight:Weight,VehicleType:VehicleType},
                        dataType:'html',
                        success:function(msg){                        
                            $('#tinhgia').html(msg);
                        },
                        error:function(){ alert('Truyền dữ liệu thất bại');}
                        });
                    }
                }
            }
        });
    });
</script>
@endsection
@section('sidebar')
@endsection