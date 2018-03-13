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
        <li class="active">Quản lý Admin</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Danh sách Admin
        </h1>
    </div>
    <!--Header Buttons-->
    <div class="header-buttons">
        <a class="btn btn-xs btn-blue white" href="{{route('getRegister')}}" style="width: 180px;margin-right: 20px;"><i class="fa fa-plus"></i> Thêm Admin</a>
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