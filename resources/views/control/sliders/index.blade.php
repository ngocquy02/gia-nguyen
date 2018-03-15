@extends('control.master')
@section('title',($type)=='Advertise'?'Danh sách quảng cáo':'Danh sách slide')
@section('menu-left')
{!!getMenuSidebar('slider') !!}
@endsection
@section('content')
<div class="page-breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{!!route('controller')!!}">Home</a>
        </li>
        <li class="active">
            @php
                switch ($type) {
                    case 'Slider':
                        echo "Slider";
                        break;
                    case 'Popup':
                        echo "Popup"; 
                        break;
                    case 'Advertise':
                        echo "Quảng cáo"; 
                        break; 
                    default:
                        echo "";
                }
            @endphp
        </li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
               @php
                    switch ($type) {
                        case 'Slider':
                            echo "Danh sách Slider";
                            break;
                        case 'Popup':
                            echo "Danh sách Popup"; 
                            break; 
                        case 'Advertise':
                            echo "Danh sách Quảng cáo"; 
                            break;
                        default:
                            echo "";
                    }
                @endphp
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
                <span class="widget-caption">
                    @php
                        switch ($type) {
                            case 'Slider':
                                echo "Danh sách hiển thị Slider";
                                break;
                            case 'Popup':
                                echo "Danh sách hiển thị Popup"; 
                                break;  
                             case 'Advertise':
                                echo "Danh sách hiển thị Quảng cáo"; 
                                break;      
                            default:
                                echo "";
                        }
                    @endphp
                </span>   
                <div class="header-buttons">
                    <a class="btn btn-ms btn-blue white" href="@php 
                        switch ($type) {
                            case 'Slider':
                                echo route('getAddSlider');
                                break;
                            case 'Popup':
                                echo route('getAddPopup');
                                break;  
                             case 'Advertise':
                                echo route('getAddAds'); 
                                break;      
                            default:
                                echo "";
                        }    
                      @endphp" style="width: 175px;margin-right: 20px;"><i class="fa fa-plus"></i> Thêm mới</a>
                </div>            
            </div>
            <div class="widget-body no-padding">
                <table class="table table-bordered table-hover table-striped" id="searchable">
                    <thead class="bordered-darkorange">
                        <tr role="row">
                            <th class="sorting_asc">Tên</th>
                            <th class="">Hình ảnh</th>
                            <th>Ẩn/ Hiện</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($items)>0)
                        @foreach($items as $item)
                        <tr id="{{$item->id}}" class="getId">
                            <td class="sorting_1">{{$item->Name}}</td>
                            <td class="center"><img style="width: 200px" src='{{$item->Img}}'></td>
                            <td>
                                <label>
                                    <input class="checkbox-slider colored-blue" type="checkbox" @if($item->IsActive == 1) {{ 'checked="checked"'}} @endif>
                                    <span class="text IsActive" IsActive="{!!$item->IsActive!!}"></span>
                                </label>
                            </td>
                            <td class="center ">
                                <a href="@php 
                                    switch ($type) {
                                        case 'Slider':
                                            echo route('getEditSlider',['id'=>$item->id]);
                                            break;
                                        case 'Popup':
                                            echo route('getEditPopup',['id'=>$item->id]);
                                            break;  
                                         case 'Advertise':
                                            echo route('getEditAds',['id'=>$item->id]); 
                                            break;      
                                        default:
                                            echo "";
                                    }    
                                  @endphp" class="btn btn-info btn-xs edit" title="Thay đổi hình ảnh Slider" style="margin-left: 10px;margin-right: 10px;">
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
                                                <p>
                                                    @php
                                                        switch ($type) {
                                                            case 'Slider':
                                                                echo "Bạn có muốn xóa Slider";
                                                                break;
                                                            case 'Popup':
                                                                echo "Bạn có muốn xóa Popup"; 
                                                                break;
                                                            case 'Advertise':
                                                                echo "Bạn có muốn xóa Quảng cáo"; 
                                                                break;         
                                                            default:
                                                                echo "";
                                                        }
                                                    @endphp
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                            <form action="@php 
                                                    switch ($type) {
                                                        case 'Slider':
                                                            echo route('postSliderDel');
                                                            break;
                                                        case 'Popup':
                                                            echo route('postPopupDel');
                                                            break;  
                                                         case 'Advertise':
                                                            echo route('postAdsDel'); 
                                                            break;      
                                                        default:
                                                            echo "";
                                                    }    
                                                  @endphp" method="post" accept-charset="utf-8">
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
    $.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
    $('span.IsActive').click(function(){
        var IsActive   =    $(this).attr('IsActive');
        var id     =    $(this).parents('.getId').attr('id');
        $.ajax({
            url:'{{route('postActiveSlider')}}', 
            type:'post',
            cache:false,
            data:{IsActive:IsActive,id:id},
            dataType:'html',
            success:function(msg){
                if (msg=='off') {Notify('Đã ẩn ', 'top-right', '5000', 'danger', 'fa-bolt', true);
                    $('span.IsActive').attr('IsActive',0);
                }
                else{Notify('Đã bật hiển thị ', 'top-right', '5000', 'success', 'fa-check', true);
                    $('span.IsActive').attr('IsActive',1);
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