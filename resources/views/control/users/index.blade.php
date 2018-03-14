@extends('control.master')
@section('title','Danh sách sản phẩm')
@section('menu-left')
{!!getMenuSidebar('menu') !!}
@endsection
@section('content')
<div class="page-breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{!!route('controller')!!}">Home</a>
        </li>
        <li class="active">Quản lý User</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Danh sách User
        </h1>
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
                    <span class="widget-caption">Danh sách user</span>
                    <div class="header-buttons">
                        <a class="btn btn-blue white" href="{{route('getRegister')}}" style="width: 180px;margin-right: 20px;"><i class="fa fa-plus"></i> Thêm</a>
                    </div>
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
                                <th>Tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Ảnh đại diện</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="" class="getId">
                                <td>
                                    <label>
                                        <input type="checkbox" class="check_del" idcheck="">
                                        <span class="text"></span>
                                    </label>
                                </td>
                                <td class=" sorting_1"></td>
                                <td class=" ">
                                    <label>
                                        <input class="checkbox-slider colored-blue" type="checkbox" >
                                        <span class="text IsActive" IsActive=""></span>
                                    </label>
                                </td>
                                <td class=" ">
                                    <label>
                                        <input class="checkbox-slider colored-blue" type="checkbox" >
                                        <span class="text IsHot" IsHot=""></span>
                                    </label>
                                </td>
                                <td class="center "><button class="btn btn-warning  btn-circle btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="<img style='width:180px;height:180px;' src=''>"><i class="glyphicon glyphicon-camera"></i></button></td>
                                
                                <td class="center ">
                                    <a href="" class="btn btn-info btn-xs edit" title="Thay đổi thông tin sản phẩm" style="margin-left: 10px;margin-right: 10px;">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                    <button class="btn btn-danger btn-xs delete" title="Xóa sản phẩm" data-toggle="modal" data-target="#modal-danger"><span class="fa fa-trash-o"></span></button>
                                    <div id="modal-danger" class="modal modal-message modal-danger fade" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title">Cảnh báo!!!!</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Bạn có muốn xóa </p>
                                                </div>
                                                <div class="modal-footer">
                                                <form action="" method="post" accept-charset="utf-8">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="">
                                                    <button type="submit" class="btn btn-primary ok">Đồng ý</button>
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Hủy</button>
                                                </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                                
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                     {{-- {{$items->links()}} --}}
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- /Page Body -->
</div>
<script>
$(document).ready(function(){
    $.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
    $('span.IsActive').click(function(){
        var IsActive   =    $(this).attr('IsActive');
        var id     =    $(this).parents('.getId').attr('id');
        $.ajax({
            url:'{{route('postActiveProduct')}}', 
            type:'post',
            cache:false,
            data:{IsActive:IsActive,id:id},
            dataType:'html',
            success:function(msg){
                if (msg=='off') {Notify('Đã ẩn sản phẩm', 'top-right', '5000', 'danger', 'fa-bolt', true);
                    $('span.IsActive').attr('IsActive',0);
                }
                else{Notify('Đã bật hiển thị sản phẩm', 'top-right', '5000', 'success', 'fa-check', true);
                    $('span.IsActive').attr('IsActive',1);
                }
            },
            error:function(){ Notify('Lưu dữ liệu thất bại', 'top-right', '5000', 'danger', 'fa-bolt', true);}
            });
    }); 
    $('span.IsHot').click(function(){
        var IsHot   =    $(this).attr('IsHot');
        var id     =    $(this).parents('.getId').attr('id');
        $.ajax({
            url:'{{route('postHotProduct')}}', 
            type:'post',
            cache:false,
            data:{IsHot:IsHot,id:id},
            dataType:'html',
            success:function(msg){
                if (msg=='off') {Notify('Đã tắt Nổi Bật', 'top-right', '5000', 'danger', 'fa-bolt', true);
                    $('span.IsHot').attr('IsHot',0);
                }
                else{Notify('Đã bật Nổi Bật', 'top-right', '5000', 'success', 'fa-check', true);
                    $('span.IsHot').attr('IsHot',1);
                }                
            },
            error:function(){ Notify('Lưu dữ liệu thất bại', 'top-right', '5000', 'danger', 'fa-bolt', true);}
            });
        });
    $('span.IsHome').click(function(){
        var IsHome   =    $(this).attr('IsHome');
        var id     =    $(this).parents('.getId').attr('id');
        $.ajax({
            url:'{{route('postSliderProduct')}}', 
            type:'post',
            cache:false,
            data:{IsHome:IsHome,id:id},
            dataType:'html',
            success:function(msg){
                if (msg=='off') {Notify('Đã tắt hiển thị Slider', 'top-right', '5000', 'danger', 'fa-bolt', true);
                    $('span.IsHome').attr('IsHome',0);
                }
                else{Notify('Đã bật hiển thị Slider', 'top-right', '5000', 'success', 'fa-check', true);
                    $('span.IsHome').attr('IsHome',0);
                }
            },
            error:function(){ Notify('Lưu dữ liệu thất bại', 'top-right', '5000', 'danger', 'fa-bolt', true);}
            });
    });
    $('.ok').click(function(){
        $(this).css('display','none');
    });
});

</script>
@endsection