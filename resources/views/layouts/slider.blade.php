<div class="slider">
    <div class="center">
        @php
            $sliders=App\Models\Slider::where(['IsActive'=>1,'Type' =>'Slider'])->get();
        @endphp
        @if($sliders->count() > 0)
            @foreach($sliders as $slider)
                <div class="item-slider">
                    <a href="{{$slider->Url}}"><img class="img-fluid" src="{!!asset($slider->Img)!!}" alt="{!!$slider->Name!!}"></a>
                </div>
            @endforeach
        @else
            <code>Chưa có hình Ảnh Slider</code>
        @endif
    </div>
</div>
 