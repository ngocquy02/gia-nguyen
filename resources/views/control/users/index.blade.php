@extends('control.master')
@section('title','Danh sách user')
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
                        @if($users->count()>0)
                            @foreach($users as $user)
                                <tr id="" class="getId">
                                    <td>
                                        <label>
                                            <input class="check_del" idcheck="{{$user->id}}" type="checkbox">
                                            <span class="text"></span>
                                        </label>
                                    </td>
                                     <td class="sorting_1">
                                       {{$user->FullName}} 
                                    </td>
                                    <td class=" sorting_2">
                                       {{$user->Phone}}  
                                    </td>
                                    <td class=" sorting_3">
                                       {{$user->Email}} 
                                    </td>
                                    <td class="center "><button class="btn btn-warning  btn-circle btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="<img style='width:180px;height:180px;' src=''>"><i class="glyphicon glyphicon-camera"></i></button></td>
                                    
                                    <td class="center ">
                                        <a href="{{route('getEdit',['id'=>$user->id])}}" class="btn btn-info btn-xs edit" title="Thay đổi thông tin sản phẩm" style="margin-left: 10px;margin-right: 10px;">
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
                                                    <form action="{{route('delUser')}}" method="post" accept-charset="utf-8">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$user->id}}">
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
                     {{-- {{$items->links()}} --}}
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- /Page Body -->
</div>
@endsection