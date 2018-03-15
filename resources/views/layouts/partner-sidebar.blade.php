 <div class="hotline">
    <div class="header-hotline">
        <img src="assets/images/icon-partner.png" class="img-fluid" alt="Responsive image"><span>Đối tác</span>
    </div>
    @php
        $partners = App\Models\Partner::where(['IsActive' => 1])->limit(5)->get();
    @endphp    
    <div class="list-hotline">
        @if($partners->count()>0)
            @foreach($partners as $partner)
                <ul class="p-0">
                    <a href="{{$partner->Url}}" title=""><img src="{{asset('')}}/{{$partner->Img}}" class="img-fluid partner-img" alt="{{$partner->Name}}"></a>
                </ul>
            @endforeach
        @else
            <code>Không có đối tác</code>
        @endif
        

    </div>
</div>
<!-- Xưởng sản xuất -->
<div class="clearfix"></div>