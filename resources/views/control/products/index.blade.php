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
        <li class="active">Sản Phẩm</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Danh sách sản phẩm
        </h1>
    </div>
    <!--Header Buttons-->
    <div class="header-buttons">
        <a class="btn btn-xs btn-blue white" href="@if(isset($CatId)){{route('getAddProduct',['CatId'=>$CatId])}} @endif" style="width: 180px;margin-right: 20px;"><i class="fa fa-plus"></i> Thêm sản phẩm</a>
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
                <span class="widget-caption">Danh sách sản phẩm</span>
            </div>
            <div class="widget-body no-padding">
                <table class="table table-bordered table-hover table-striped" id="searchable">
                    <thead class="bordered-darkorange">
                        <tr role="row">
                            <th>Tên</th>
                            <th>Ẩn/ Hiện</th>
                            <th>Loại dịch vụ</th>
                            <th>Loại chiều</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if( isset($items) && count($items) > 0)
                        @foreach($items as $item)
                        <tr id="{{$item->id}}" class="getId">
                            <td class=" sorting_1">{{ $item->Name}}</td>
                            <td class=" ">
                                <label>
                                    <input class="checkbox-slider colored-blue" type="checkbox" @if($item->IsActive == 1) {{ 'checked="checked"'}} @endif>
                                    <span class="text IsActive" IsActive="{!!$item->IsActive!!}"></span>
                                </label>
                            </td>
                            <td class="center ">
                                <label>{{($item->IsHot==0)? 'Du lịch' :'Vận tải'}}</label>
                            </td>
                            <td class="center ">
                                <label>{{($item->IsHome==0)? '1 Chiều' :'2 Chiều'}}</label>
                            </td>
                            <td class="center ">
                                <a href="{!!route('getProduct',['id'=>$item->id])!!}" class="btn btn-info btn-xs edit" title="Thay đổi thông tin sản phẩm" style="margin-left: 10px;margin-right: 10px;">
                                    <span class="fa fa-edit"></span>
                                </a>
                                <button class="btn btn-danger btn-xs delete" title="Xóa sản phẩm" data-toggle="modal" data-target="#modal-danger{!!$item->id!!}"><span class="fa fa-trash-o"></span></button>
                                <div id="modal-danger{!!$item->id!!}" class="modal modal-message modal-danger fade" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Cảnh báo!!!!</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Bạn có muốn xóa {{$item->Name}}</p>
                                            </div>
                                            <div class="modal-footer">
                                            <form action="{{route('postProductDel')}}" method="post" accept-charset="utf-8">
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