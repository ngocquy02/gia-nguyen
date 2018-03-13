@extends('control.master')
@section('title','Danh sách các thành viên')
@section('menu-left')
{!!getMenuSidebar('account') !!}
@endsection
@section('content')
<div class="page-breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{!!route('controller')!!}">Home</a>
        </li>
        <li class="active">thành viên</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            Danh sách các thành viên
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
                <span class="widget-caption">Danh sách các thành viên</span>   
                <div class="header-buttons">
                    <a class="btn btn-ms btn-blue white" href="{{route('getAddAccount')}}" style="width: 175px;margin-right: 20px;"><i class="fa fa-plus"></i> Thêm thành viên</a>
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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Hình thức Đk</th>
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
                            <td>{!!$item->FullName!!}</td>
                            <td>
                                {{$item->Email or 'Chưa cập nhật'}}
                            </td>
                            <td>
                                {{$item->Phone or 'Chưa cập nhật'}}
                            </td>
                            <td>
                                <?php
                                switch($item->Provider){
                                    case 'Register':
                                        echo "Đăng ký tay";
                                        break;
                                
                                    case 'Facebook':
                                        echo "Đăng ký Facebook";
                                        break;
                                
                                    case 'Google':
                                        echo "Đăng ký Google";
                                        break;
                                
                                    default:
                                        echo "Đăng ký tay";
                                }                                   
                                ?>
                            </td>
                            <td class="center ">
                                <a href="{!!route('getEditAccount',['id'=>$item->id])!!}" class="btn btn-info btn-xs edit" title="Sửa thông tin thành viên" style="margin-left: 10px;margin-right: 10px;">
                                    <span class="fa fa-edit"></span>
                                </a>
                                <button class="btn btn-danger btn-xs delete" title="Xóa thành viên" data-toggle="modal" data-target="#modal-danger{!!$item->id!!}"><span class="fa fa-trash-o"></span></button>
                                <div id="modal-danger{!!$item->id!!}" class="modal modal-message modal-danger fade" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Cảnh báo!!!!</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Bạn có muốn xóa {!!$item->Name!!}</p>
                                            </div>
                                            <div class="modal-footer">
                                            <form action="{{route('postAccountDel')}}" method="post" accept-charset="utf-8">
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
                    url:'{{route('postAccountDelCheck')}}',
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