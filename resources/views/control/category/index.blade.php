@extends('control.master')
@section('title','Danh sách danh mục')
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
        <li class="active">Danh mục</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Quản lý danh mục
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
<style>.DTTT.btn-group{display: none !important;}</style>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-yellow">
                <span class="widget-caption">Danh sách danh mục</span>
            <div class="header-buttons">
                @if (! App\Models\Category::where('Type',1)->first())
                <a class="btn btn-blue white" href="{{route('getAddHomeCategory')}}" style="width: 160px;margin-right: 20px;"><i class="fa fa-plus"></i> Thêm Trang Chủ</a>
                @endif
                @if (! App\Models\Category::where('Type',5)->first())
                <a class="btn btn-blue white" href="{{route('getAddAboutCategory')}}" style="width: 160px;margin-right: 20px;"><i class="fa fa-plus"></i> Thêm Giới Thiệu</a>
                @endif
                @if (! App\Models\Category::where('Type',2)->first())
                <a class="btn btn-blue white" href="{{route('getAddContactCategory')}}" style="width: 160px;margin-right: 20px;"><i class="fa fa-plus"></i> Thêm Liên Hệ</a>
                @endif
                <a class="btn btn-blue white" href="{{route('getAddCategoryProduct',['ParentId'=>0])}}" style="width: 160px;margin-right: 20px;"><i class="fa fa-plus"></i> Danh mục sản phẩm </a>
                <a class="btn btn-blue white" href="{{route('getAddCategoryArticle',['ParentId'=>0])}}" style="width: 160px;margin-right: 20px;"><i class="fa fa-plus"></i> Danh mục bài viết</a>
            </div>
            </div>
            <div class="widget-body no-padding">
                <div class="dd dd-draghandle darker" id="menu">
                @if(isset($items) && count($items) > 0)
                   <?php menuMutil($items); ?>
                @endif
                </div>
                <div>
                <button class="btn btn-success tooltip-success" id="update" data-toggle="tooltip" data-placement="top" title="Lưu vị trí cho danh mục">Cập nhật vị trí</botton>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
{{-- <script src="{{asset('control/assets/js/jquery-1.8.2.js')}}"></script> --}}
<!-- demo scripts -->
<script src="{{asset('control/assets/js/jquery-ui.js')}}"></script>
<script>
    $(document).ready(function(){
         $.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
        $('#update').click(function(){
            var level=$('#menu').find('ol');
            var data_lv='';
            for (var i =0;i<= level.length - 1; i++) {
                level1=level.eq(i).children();
                ParentId=level.eq(i).attr('id');
               for (var j = 0; j < level1.length; j++) {
                data_lv=(data_lv=='') ? j+'(,)'+level1.eq(j).attr('data-id') : data_lv+'(;)'+j+'(,)'+level1.eq(j).attr('data-id');
               }
            }
            $.ajax({
            url:'{{route('postIdxCategory')}}', 
            type:'post',
            cache:false,
            data:{data_lv:data_lv},
            dataType:'html',
            success:function(msg){
                Notify(msg, 'top-right', '5000', 'success', 'fa-check', true);             
            },
            error:function(){ Notify('Lưu dữ liệu thất bại'+data_lv, 'top-right', '5000', 'danger', 'fa-bolt', true);}
            });
        });
        $('button.active').click(function(){
            id=$(this).attr('IsActive');
            $.ajax({
            url:'{{route('postActiveCategory')}}', 
            type:'post',
            cache:false,
            data:{id:id},
            dataType:'html',
            success:function(msg){
                if (msg=='on') 
                {
                    $('button[IsActive="'+id+'"]').attr('class','btn btn-xs btn-blue active');
                    $('button[IsActive="'+id+'"]').html('Hiện');
                    Notify('Đã hiện danh mục', 'top-right', '5000', 'success', 'fa-check', true);             
                }
                else
                {
                    $('button[IsActive="'+id+'"]').attr('class','btn btn-xs btn-darkorange active');
                    $('button[IsActive="'+id+'"]').html('Ẩn');
                    Notify('Đã ẩn danh mục', 'top-right', '5000', 'danger', 'fa-bolt', true);
                }
            },
            error:function(){ Notify('Lưu dữ liệu thất bại', 'top-right', '5000', 'danger', 'fa-bolt', true);}
            });
        });
        $('.ok').click(function(){
            $(this).css('display','none');
        });
        $('.dd-handle').click(function(){
            if($(this).parent().children('ol').attr('show')==1)
            {
                $(this).parent().children('ol').removeClass('show');
                $(this).parent().children('ol').attr('show','0');
                $(this).parent().children('ol').addClass('hidden');
                $(this).html('<i class="normal-icon fa fa-th-list "></i> <i class="normal-icon fa fa-angle-right"></i>');
            }
            else
            {
                $(this).parent().children('ol').removeClass('hidden');
                $(this).parent().children('ol').attr('show','1');
                $(this).parent().children('ol').addClass('show');
                $(this).html('<i class="normal-icon fa fa-th-list "></i> <i class="normal-icon fa fa-angle-down"></i>');
            }
        });
    });
</script>
<script>
$(function() {
    for (var i =0;i<= $('#menu').find('ol').length - 1; i++) {
        var id=$('#menu').find('ol').eq(i).attr('id');
        $('#'+id).sortable({ 
            placeholder: "ui-sortable-placeholder" 
        });
    }
});
</script>
<style type="text/css" media="screen">
    .ui-sortable li.ui-state-default:first-child {  
        border-top: 0;   
}  
    
.ui-sortable li.ui-state-default:last-child {  
    border-bottom: 0;  
}  

.ui-sortable-placeholder {  
  border: 3px dashed #aaa;  
  height: 45px;  
  width: 100%;  
  background: #ccc;  
}  
.ui-sortable li.ui-state-default1:first-child {  
        border-top: 0;   
}  
    
.ui-sortable li.ui-state-default1:last-child {  
    border-bottom: 0;  
}  

.ui-sortable1-placeholder {  
  border: 3px dashed #aaa;  
  height: 45px;  
  width: 100%;  
  background: #ccc;  
}
.ui-sortable li.ui-state-default2:first-child {  
        border-top: 0;   
}  
    
.ui-sortable li.ui-state-default2:last-child {  
    border-bottom: 0;  
}  

.ui-sortable2-placeholder {  
  border: 3px dashed #aaa;  
  height: 45px;  
  width: 100%;  
  background: #ccc;  
}    
.rigth{
    float: right;
    position: relative;
    bottom: 0px;
}
</style>
@endsection
