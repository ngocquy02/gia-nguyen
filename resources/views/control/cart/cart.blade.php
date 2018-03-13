@extends('control.master')
@section('title','chi tiết đơn hàng')
@section('menu-left')
{!!getMenuSidebar('cart') !!}
@endsection
@section('content')
<div class="page-breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{!!route('controller')!!}">Home</a>
        </li>
        <li class="active"> Chi tiết đơn hàng </li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Chi tiết đơn hàng
        </h1>
    </div>
    <div class="header-buttons">
        <a class="sidebar-toggler active" >
            <i class="fa fa-arrows-h"></i>
        </a>
        <a class="fullscreen" id="fullscreen-toggler" >
            <i class="glyphicon glyphicon-fullscreen"></i>
        </a>
    </div>
</div>
<!-- /Page Header -->
<!-- Page Body -->
<div class="page-body">
    <div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="widget no-header ">
            <div class="widget-body colored-purple">
                <h4><span class="widget-caption"><strong>Thông tin khách hàng</strong></span></h4>
                <span class="widget-caption" style="margin-right: 30px"><strong>Họ và tên: </strong></span> <span>{!!$item->FullName!!}</span><br> 
                <span class="widget-caption" style="margin-right: 56px"><strong>Email: </strong></span> <span>{!!$item->Email!!}</span><br> 
                <span class="widget-caption" style="margin-right: 8px"><strong>Số điện thoại: </strong></span> <span>{!!$item->Phone!!}</span><br> 
                <span class="widget-caption" style="margin-right: 47px"><strong>Địa chỉ: </strong></span> <span>{!!$item->Address!!}</span><br> 
                <span class="widget-caption" style="margin-right: 47px"><strong>Công ty: </strong></span> <span>{!!$item->Company!!}</span><br> 
            </div>
        </div>
        <div class="widget no-header ">
            <div class="widget-body colored-purple">
                <h4><span class="widget-caption"><strong>Thông tin Vận chuyển</strong></span></h4>           
@php
    $Partner=\App\Models\Partner::Find($item->PartnerBy);
@endphp
                <span class="widget-caption" style="margin-right: 30px"><strong>Họ và tên: </strong></span> <span>{!!$Partner->FullName or '' !!}</span><br>
                <span class="widget-caption" style="margin-right: 8px"><strong>Số điện thoại: </strong></span> <span>{!!$Partner->Phone or ''!!}</span><br> 
                <span class="widget-caption" style="margin-right: 47px"><strong>Địa chỉ: </strong></span> <span>{!!$Partner->Address or ''!!}</span><br>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="widget no-header ">
            <div class="widget-body colored-purple">
                <h4><span class="widget-caption"><strong>Nội dung đơn hàng</strong></span></h4>
                    <hr>
                <span class="widget-caption" style="margin-right: 30px"><strong>Vị trí đi: </strong></span> <span>{!!$item->AddressStart!!}</span><br>
                <span class="widget-caption" style="margin-right: 30px"><strong>Vị trí đến: </strong></span> <span>{!!$item->AddressEnd!!}</span><br>
                @php
                    $URL = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".str_slug($item->AddressStart)."&destinations=".str_slug($item->AddressEnd)."&key=AIzaSyCdGf9-I3HWvCPgihLZiUSj7b3Iz2jDG9s";
                    $Data = json_decode(file_get_contents($URL));
                    $kc='';
                    if ($Data->status!='ok')
                    {
                        $kc1=$Data->rows[0]->elements[0]->distance->value;
                    }
                    else
                    {
                        $kc="không lấy được vị trí";
                    }
                @endphp
                <span class="widget-caption" style="margin-right: 30px"><strong>Khoản cách: </strong></span> <span>{!!is_numeric($kc) ? round($kc/1000,3). ' Km' :$kc!!}</span><br>
                <span class="widget-caption" style="margin-right: 30px"><strong>Khối lượng: </strong></span> <span>{!!$item->Weight!!} kg</span><br>
                <span class="widget-caption" style="margin-right: 30px"><strong>Loại xe: </strong></span> <span>{!!\App\Models\Category::Find($item->VehicleType)->Name!!}</span><br>
                <span class="widget-caption" style="margin-right: 47px"><strong>Hình thức: </strong></span> <span>{!!($item->Role==1)? 'Vận tải':'Du lịch'!!}</span><br> 
                <span class="widget-caption" style="margin-right: 47px"><strong>Chiều đi: </strong></span> <span>{!!($item->IsHome==1)? '2 Chiều':'1 Chiều'!!}</span><br> 
                <span class="widget-caption" style="margin-right: 47px"><strong>Giá tạm tính: </strong></span> <span>{!!$item->Price!!}</span><br> 
                <span class="widget-caption" style="margin-right: 47px"><strong>Ngày đi: </strong></span> <span>{!!$item->DateStart!!}</span><br> 
                <span class="widget-caption" style="margin-right: 47px"><strong>Giờ đi: </strong></span> <span>{!!$item->TimeStart!!}</span><br> 
            </div>
        </div>
        <div class="widget no-header ">
            <div class="widget-body colored-purple">
                <h4><span class="widget-caption"><strong>Trạng thái đơn hàng</strong></span></h4>
                    <hr>
                <span class="widget-caption" style="margin-right: 30px"><strong>Trạng thái đơn hàng: </strong></span> <span class="label label-purple">
                    @php
                        switch ($item->Status) {
                            case 0:
                                echo 'Chờ xác nhận';
                                break;
                            case 1:
                                echo 'Chờ nhận vận chuyển';
                                break;
                            case 2:
                                echo 'Đang vận chuyển';
                                break;
                            case 3:
                                echo 'Chờ xác nhận Hoàn thành';
                                break;
                            case 4:
                                echo 'Hoàn thành';
                                break;
                            case 5:
                                echo 'Hủy';
                                break;
                            default:
                                echo 'Chờ xác nhận';
                                break;
                        }
                    @endphp
                </span><br>
                <div class="clearfix"></div>
                <form action="{{route('postSendCartControl')}}" method="Post" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <input type="hidden" name="Status" value="{{$item->Status}}">
                    <span class="widget-caption" style="margin-right: 30px"><strong>Giá tạm tính đơn hàng: </strong></span> <input type="text" class="form-control" name="Price" value="{{$item->Price}}" placeholder="Giá vận chuyển"><br>
                    <span class="widget-caption" style="margin-right: 30px"><strong>Giá vận chuyển đơn hàng: </strong></span> <input type="text" class="form-control" name="PriceCod" value="{{$item->PriceCod}}" placeholder="Giá vận chuyển"><br>
                    <span><strong>Ghi chú</strong></span>
                    <textarea name="Note" id="inputNote" class="form-control" rows="3">{{$item->Note}}</textarea><br>
                    @if ($item->Status<=1)
                    <button type="submit" class="btn btn-success">Gửi đơn hàng đến đối tác</button>
                </form>
                    @elseif($item->Status<4)
                 <form action="{{route('postCancelCartControl')}}" method="Post" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <input type="hidden" name="Status" value="{{$item->Status}}">
                    <button type="submit" class="btn btn-success">Hủy đơn hàng</button>
                </form>
                    @endif
                    @if ($item->Status==3)
                <form action="{{route('postSuccessCartControl')}}" method="Post" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <input type="hidden" name="Status" value="{{$item->Status}}">
                    <button type="submit" class="btn btn-success" style="margin-top: 10px;">Xác nhận</button>
                </form>
                    @endif
                    @if (session()->has('msg'))
<script>alert("{{session()->get('msg')}}")</script>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection

