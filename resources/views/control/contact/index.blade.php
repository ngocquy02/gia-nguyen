@extends('control.master')
@section('title','Danh sách Liên hệ')
@section('menu-left')
{!!getMenuSidebar('contact') !!}
@endsection
@section('content')
<div class="page-breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{!!route('controller')!!}">Home</a>
        </li>
        <li class="active">Slider</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Danh sách Slider
        </h1>
    </div>
    <!--Header Buttons-->
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
<style>.DTTT.btn-group{display: none !important;}</style>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-yellow">
                <span class="widget-caption">Danh sách đơn hàng</span>              
            </div>
            <div class="widget-body no-padding">
                <table class="table table-bordered table-hover table-striped" id="searchable">
                    <thead class="bordered-darkorange">
                        <tr role="row">
                            <th class="sorting_asc">Họ và Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Góp ý</th>
                            <th>Thời gian</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($items)>0)
                        @foreach($items as $item)
                        <tr id="{{$item->id}}" class="getId">
                            <td class="center sorting_1">{{$item->FullName}}</td>
                            <td class="center sorting_1">{{$item->Email}}</td>
                            <td class="center sorting_1">{{$item->Phone}}</td>
                            <td class="center sorting_1"><a href="javascript:void(0);" class="btn btn-default" data-container="body" data-titleclass="bordered-blue" data-class="" data-toggle="popover" data-placement="top" data-title="Góp ý của khách hàng" data-content="{!!$item->Content!!}" data-original-title="" title=""> Góp ý</a></td>
                            <td class="center sorting_1">{{$item->created_at->format('d/m/Y')}}</td>
                            <td class="center ">
                                <button class="btn btn-danger btn-xs delete" title="Xóa liên hệ" data-toggle="modal" data-target="#modal-danger{!!$item->id!!}"><span class="fa fa-trash-o"></span> Xóa</button>
                                <div id="modal-danger{!!$item->id!!}" class="modal modal-message modal-danger fade" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Cảnh báo!!!!</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Bạn có muốn xóa liên hệ</p>
                                            </div>
                                            <div class="modal-footer">
                                            <form action="{{route('postContactDel')}}" method="post" accept-charset="utf-8">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                                <button type="submit" class="btn btn-primary ok">Đồng ý</button>
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Hủy</button>
                                            </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->                                            
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function(){
       $('.ok').click(function(){
       $(this).css('display','none');
    });
    });
</script>
@endsection