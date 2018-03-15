<div class="hotline">
    <div class="header-hotline">
        <img src="assets/images/icon-support.png" class="img-fluid" alt="Responsive image"><span>Hotline hỗ trợ</span>
    </div>

    <div class="list-hotline">
        @php
            $hotlines = App\Models\Hotline::where(['IsActive' => 1])->get();
        @endphp
        @if($hotlines -> count()>0)
            @foreach($hotlines as $hotline)
                <ul class="user-support">
                    <li><img src="assets/images/icon-user-support.png" class="img-fluid icon-user-name" alt="Responsive image"><span class="user-name">{{$hotline->Name}}</span></li>
                    <li><a href="tel:{{$hotline->Phone}}" title="" class="phone-hotline"><img src="assets/images/icon-phone-user.png" class="img-fluid icon-user-phone" alt="Responsive image">{{$hotline->Phone}}</a> <a href="{{$hotline->Sky}}" title=""><img src="assets/images/icon-user-skype.png" class="img-fluid icon-user-skype" alt="Responsive image">Skype</a></li>
                    <li><a href="mailto:{{$hotline->Email}}" class="mail-support"><img src="assets/images/icon-email-user.png" class="img-fluid icon-user-email" alt="Responsive image">{{$hotline->Email}}</a></li>
                </ul>
            @endforeach
        @else
            <code>Không có Hotline</code>

        @endif
    </div>
</div>