@extends('control.master')
@section('title','Danh sách hiển thị ảnh Slider')
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
        <li class="active">Đơn hàng </li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Danh sách đơn hàng
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
<style>.DTTT.btn-group,.row.DTTTFooter,.dataTables_length{display: none !important;}</style>
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
                            <th>
                                <label>
                                    <input type="checkbox" class="check_del_all">
                                    <span class="text"></span>
                                </label>
                            </th>
                            <th class="sorting_asc">Họ và Tên</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Thời gian</th>
                            <th>Trạng thái</th>
                            <th>Đối tác</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($items)>0)
                        @foreach($items as $item)
                        <tr id="{{$item->id}}" class="getId">
                            <td>
                                <label>
                                    <input type="checkbox" class="check_del" idcheck="{{$item->id}}">
                                    <span class="text"></span>
                                </label>
                            </td>
                            <td >{{$item->FullName}}</td>
                            <td >{{$item->Email}}</td>
                            <td >{{$item->Phone}}</td>
                            <td class=" ">
                                <label>{{$item->created_at->format('d/m/Y')}}</label>
                            </td>
                            <td class=" ">
                                <label>@php
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
                                                default:
                                                    echo 'Chờ xác nhận';
                                                    break;
                                            }
                                        @endphp
                                </label>
                            </td>
                            <td >{{$item->partner()->first()->FullName or 'Chưa có đối tác'}}</td>
                            <td class="center ">
                                <a href="{!!route('getEditCartControl',['id'=>$item->id])!!}" class="btn btn-info btn-xs edit" title="Thay đổi hình ảnh Slider" style="margin-left: 10px;margin-right: 10px;">
                                    <span class="fa fa-edit"></span>
                                </a>
                                <button class="btn btn-danger btn-xs delete" title="Xóa Đơn hàng" data-toggle="modal" data-target="#modal-danger{!!$item->id!!}"><span class="fa fa-trash-o"></span></button>
                                <div id="modal-danger{!!$item->id!!}" class="modal modal-message modal-danger fade" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Cảnh báo!!!!</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Bạn có muốn xóa đơn hàng</p>
                                            </div>
                                            <div class="modal-footer">
                                            <form action="{{route('postCartDel')}}" method="post" accept-charset="utf-8">
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
                {{$items->links()}}
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
        $('#searchable thead th input.check_del_all').change(function() {
            var set = $("#searchable tbody tr input.check_del");
            var checked = $(this).is(":checked");
            $(set).each(function() {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });

        });
        $('#searchable tbody tr input.check_del').change(function() {
            $(this).parents('tr').toggleClass("active");
        });
        $('#delete_check').click(function(){
            var set = $("#searchable tbody tr input.check_del");
            var getid='';
            $(set).each(function() {
                if ($(this).is(":checked")) {
                    getid=(getid=='')?$(this).attr('idcheck'):getid+','+$(this).attr('idcheck');
                }
            });
            if(getid=='')
            {
                alert('Chưa chọn dòng cần xóa');
            }
            else
            {
                if(confirm('Bạn có muốn xóa những dòng đã chọn')==true)
                {
                    $.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
                    $.ajax({
                        url:'{{route('postArticleDelCheck')}}',
                        type:'post',
                        cache:false,
                        data:{getid:getid},
                        dataType:'html',
                        success:function(msg)
                            {
                               alert(msg);
                               location.reload();
                            },
                        error:function(){
                            alert('Lấy dữ liệu thất bại');
                        }
                        });
                }
            }
        });
    });
</script>
@endsection