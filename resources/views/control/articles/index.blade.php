@extends('control.master')
@section('title','Danh sách bài viết')
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
        <li class="active">Bài viết</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Danh sách bài viết
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
<style>.DTTT.btn-group,.row.DTTTFooter,.dataTables_length{display: none !important;}</style>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-yellow">
                <span class="widget-caption">Danh sách các bài viết</span>
                <div class="header-buttons">
                    <a class="btn btn-blue white" href="{{route('getAddArticle',['CatId'=>$CatId])}}" style="width: 180px;margin-right: 20px;"><i class="fa fa-plus"></i> Thêm bài viết</a>
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
                            <th>Ẩn/ Hiện</th>
                            <th>Nổi bật</th>
                            <th>Ảnh đại diện</th>
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
                            <td class=" sorting_1">{{$item->Name}}</td>
                            <td class=" ">
                                <label>
                                    <input class="checkbox-slider colored-blue" type="checkbox" @if($item->IsActive == 1) {{ 'checked="checked"'}} @endif>
                                    <span class="text IsActive" IsActive="{!!$item->IsActive!!}"></span>
                                </label>
                            </td>
                            <td class=" ">
                                <label>
                                    <input class="checkbox-slider colored-blue" type="checkbox" @if($item->IsHot == 1) {{ 'checked="checked"'}} @endif>
                                    <span class="text IsHot" IsHot="{!!$item->IsHot!!}"></span>
                                </label>
                            </td>
                            <td class="center "><button class="btn btn-warning  btn-circle btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="<img style='width:180px;height:180px;' src='{{$item->Img}}'>"><i class="glyphicon glyphicon-camera"></i></button></td>
                            
                            <td class="center ">
                                <a href="{!!route('getArticle',['id'=>$item->id])!!}" class="btn btn-info btn-xs edit" title="Thay đổi thông tin sản phẩm" style="margin-left: 10px;margin-right: 10px;">
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
                                            <form action="{{route('postArticleDel')}}" method="post" accept-charset="utf-8">
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
    $('span.IsActive').click(function(){
        var IsActive   =    $(this).attr('IsActive');
        var id     =    $(this).parents('.getId').attr('id');
        $.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
        $.ajax({
            url:'{{route('postActiveArticle')}}', 
            type:'post',
            cache:false,
            data:{IsActive:IsActive,id:id},
            dataType:'html',
            success:function(msg){
                if (msg=='off') {Notify('Đã ẩn bài viết', 'top-right', '5000', 'danger', 'fa-bolt', true);
                    $('#'+id+' span.IsActive').attr('isactive',0);
                }
                else{Notify('Đã bật hiển thị bài viết', 'top-right', '5000', 'success', 'fa-check', true);
                    $('#'+id+' span.IsActive').attr('isactive',1);
                }
            },
            error:function(){ Notify('Lưu dữ liệu thất bại', 'top-right', '5000', 'danger', 'fa-bolt', true);}
            });
    });
    $('span.IsHot').click(function(){
        var IsHot   =    $(this).attr('IsHot');
        var id     =    $(this).parents('.getId').attr('id');
        $.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
        $.ajax({
            url:'{{route('postHotArticle')}}', 
            type:'post',
            cache:false,
            data:{IsHot:IsHot,id:id},
            dataType:'html',
            success:function(msg){
                if (msg=='off') {Notify('Đã ẩn bài viết nổi bật', 'top-right', '5000', 'danger', 'fa-bolt', true);
                    $('#'+id+' span.IsHot').attr('ishot',0);
                }
                else{Notify('Đã bật hiển thị bài viết nổi bật', 'top-right', '5000', 'success', 'fa-check', true);
                    $('#'+id+' span.IsHot').attr('ishot',1);
                }
            },
            error:function(){ Notify('Lưu dữ liệu thất bại', 'top-right', '5000', 'danger', 'fa-bolt', true);}
            });
    }); 
    $('.ok').click(function(){
        $(this).css('display','none');
    });
</script>
@endsection