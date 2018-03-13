<div class="box-heading"><h2>Logo thương hiệu</h2><br><span class="icon-new-hot"><i class="fa fa-handshake-o" aria-hidden="true"></i></span></div>
<div class="row">
    <div class="partner-list-carousel  owl-carousel">
    @php
    $listPartners=App\Models\Partner::all();
    @endphp
@foreach($listPartners as $listPartner)
    <div class="item-partner">
        <div class="product-carousel">
            <div class="">
                <a href="">
                    <img src="Upload/partner/{{$listPartner->Img}}" title="{{$listPartner->Name}}" alt="{{$listPartner->Name}}">
                </a>
            </div>
        </div>
    </div>
@endforeach
    </div>
</div>