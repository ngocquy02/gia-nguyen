 @if(session()->has('online'))
    @php
        $ktLifeTime=App\Models\Online::where('SessionId',session()->get('online'))->first();
        if($ktLifeTime)
        {
        
            $now=time();
            $kt=($now- strtotime($ktLifeTime->created_at))/600;
            if($kt>= 5)
            {
                if (App\Models\Online::count() > 0) {
                    $ktOnline=App\Models\Online::max('id');
                }
                else{$ktOnline=0;}
                $SessionId=session()->getId().$ktOnline;
                $online                 =   new App\Models\Online;
                $online->SessionId      =   $SessionId;
                $online->created_at     =   new DateTime();
                $online->updated_at     =   new DateTime();
                $online->save();
                session(['online' => $SessionId]);
            }
        }
        else
        {
            if (App\Models\Online::count() > 0) {
                $ktOnline=App\Models\Online::max('id');
            }
            else{$ktOnline=0;}
            $SessionId=session()->getId().$ktOnline;
            $online                 =   new App\Models\Online;
            $online->SessionId      =   $SessionId;
            $online->created_at     =   new DateTime();
            $online->updated_at     =   new DateTime();
            $online->save();
            session(['online' => $SessionId]);
        }
    @endphp
@else
    @php
        if (App\Models\Online::count() > 0) {
            $ktOnline=App\Models\Online::max('id');
        }
        else{$ktOnline=0;}
        $SessionId=session()->getId().$ktOnline;
        $online                 =   new App\Models\Online;
        $online->SessionId      =   $SessionId;
        $online->created_at     =   new DateTime();
        $online->updated_at     =   new DateTime();
        $online->save();
        session(['online' => $SessionId]);
    @endphp
@endif
       

 <div class="hotline">
    <div class="header-hotline">
        <img src="assets/images/icon-tktc.png" class="img-fluid" alt="Responsive image"><span>Thống kê truy cập</span>
    </div>
    <div class="list-hotline">
        <ul class="p-0 list-online">
             
            <li>
                <span>> Đang online :</span>
                <span class="value-online">
                    {{App\Models\Online::where([['created_at','>',(date('Y-m-d H:i:s',(time()-300)))]])->count()}}
                </span>
            </li>
            <li>
                <span>> Hôm nay:</span>
                <span class="value-online">
                 {{App\Models\Online::whereDate('created_at',date('Y-m-d'))->count()}}
             </span>
            </li>
            <li>
                <span>> Hôm qua:</span>
                <span class="value-online"> 

                </span>
            </li>
            <li>
                <span>> Tuần này:</span>
                <span class="value-online"> 

                </span>
            </li>
            <li>
                <span>> Tuần trước:</span>
                <span class="value-online"> 

                </span>
            </li>
            <li>
                <span>> Tháng này:</span>
                <span class="value-online"> 

                </span>
            </li>
            <li><span>> Tháng trước:</span><span class="value-online"> 33343</span></li>
            <li><span>> Tổng lượt truy cập:</span><span class="value-online"> 3334225</span></li>
        </ul>
    </div>
</div>
         <p><span class="fa fa-user-circle" aria-hidden="true"></span><span class="online">Đang online: </span></p>
                <p><span class="fa fa-group"></span><span class="online">Hôm nay: </span></p>
                <p><span class="fa fa-calendar-check-o"></span><span class="online">Tuần này: </span>{{App\Models\Online::whereBetween('created_at', [Carbon\Carbon::now()->startOfWeek(),Carbon\Carbon::now()->endOfWeek(),])->count()}}</p>
                <p><span class="fa fa-bar-chart"></span><span class="online">Tháng này: </span>{{App\Models\Online::whereMonth('created_at',date('m'))->count()}}</p>
                <p><span class="fa fa-line-chart"></span><span class="online">Tổng: </span>{!!App\Models\Online::count()!!}</p>