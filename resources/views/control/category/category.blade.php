@extends('control.master')
@section('title',isset($item) ? 'Sửa danh mục' : 'Thêm danh mục')
@section('menu-left')
{!!getMenuSidebar('menu') !!}
@endsection
@section('content')
<script src="{{ asset('control/validate/form-validation.js') }}"></script>
 <script src="{{ asset('control/validate/jquery.validate.min.js') }}"></script>
 <div class="page-breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{!!route('controller')!!}">Home</a>
        </li>
        <li class="active">danh mục</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            {{ isset($item) ? 'Sửa danh mục' : 'Thêm danh mục' }}
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
            <div class="widget-header bordered-bottom bordered-pink">
                <span class="widget-caption">Form {{ isset($item) ? 'Sửa danh mục' : 'Thêm danh mục' }}</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                    <form class="form-horizontal" action="@if(isset($item)){{route('postEditCategory')}}@else{{route('postAddCategory')}}@endif" role="form" name="{{'frm_category'}}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$item->id or ''}}">
                        <input type="hidden" name="ParentID" value="{{$item->ParentID or $ParentId}}">
                        <input type="hidden" name="Type" value="{{$item->Type or $Type}}">
                        <input type="hidden" name="Level" value="{{$Level or 0}}">
                        <div class="row">
                            <div class="col-md-6">
                                <span ><strong>Tên danh mục</strong></span>
                                <input type="text" name="Name" value="@if(isset($item)){{ $item->Name}}@endif" placeholder="Nhập tên danh mục" class="form-control">
                                <label name="Name"  class="error" style="display: none;"></label>
                                    @if ($errors->has('Name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Name') }}</strong>
                                        </span>
                                    @endif
                                <div class="horizontal-space"></div>
                            </div>
                            <div class="col-md-6">
                                <span ><strong>Alias danh mục</strong></span>
                                <input type="text" name="Alias" value="@if(isset($item)){{ $item->Alias}}@endif" placeholder="Tên không dấu của danh mục" class="form-control">
                                <label name="Alias" class="error" style="display: none"></label>
                                @if ($errors->has('Alias'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Alias') }}</strong>
                                    </span>
                                @endif
                                <div class="horizontal-space"></div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-8">
                                <span ><strong>Mô tả</strong></span>
                                <input type="text" name="Description" value="{{ $item->Description or ''}}" placeholder="Nhập mô tả của danh mục" class="form-control">
                                @if ($errors->has('Description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Description') }}</strong>
                                    </span>
                                @endif
                                <div class="horizontal-space"></div>
                            </div>
                            <div class="col-md-4">
                                <span ><strong>Hiện danh mục</strong> &nbsp&nbsp&nbsp</span>
                                <label style="margin-top: 10px;">
                                    <input class="checkbox-slider slider-icon colored-blue" @if(isset($item) && $item->IsActive ===1) checked="checked" @endif type="checkbox" name="IsActive">
                                    <span class="text"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="col-md-6">
                                    <span><strong>Hình ảnh icon</strong></span>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-info btn-file">
                                                Browse… <input type="file" id="imgIcon" name="Icon">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <img id='img-upload-icon'/>
                                </div>
                                <div class="col-md-6">
                                    @if(isset($item) && $item->Icon!='') <img src="{{asset($item->Icon)}}"   class="img-responsive" alt="Image"> @endif
                                    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-6">
                                    <span><strong>Hình ảnh đại diện</strong></span>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-info btn-file">
                                                Browse… <input type="file" id="imgImage" name="Img">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <img id='img-upload-image'/>
                                </div>
                                <div class="col-md-6">
                                    @if(isset($item)&& $item->Img!='') <img src="{{asset($item->Img)}}"  class="img-responsive" alt="Image"> @endif
                                    
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="col-md-6">
                                    <span><strong>Hình ảnh Banner</strong></span>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-info btn-file">
                                                Browse… <input type="file" id="imgBanner" name="Banner">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <img id='img-upload-banner'/>
                                </div>
                                <div class="col-md-6">
                                    @if(isset($item) && $item->Banner!='') <img src="{{asset($item->Banner)}}"  class="img-responsive" alt="Image"> @endif
                                </div>
                            </div>
                        </div>
                       <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="row-title before-lightred"> Nội dung SEO</h5>             
                            </div>
                            <div class="col-md-6">
                                <span><strong>Meta Title</strong></span><code> Khoản 10 - 70 ký tự</code><br><br>
                                <textarea name="MetaTitle" id="input" class="form-control" rows="3" placeholder="Nhập nội dung Title" >{{ $item->MetaTitle or ''}}</textarea>
                                
                            </div>
                            <div class="col-md-6">
                                <span><strong>Meta Keyword </strong></span><code>Khoản 3 từ khóa, mỗi từ ngăn cách nhau bởi dấu ','</code><br><br>
                                <textarea name="MetaKeyword" id="input" class="form-control" rows="3" placeholder="Nhập nội dung Meta Keyword">{{ $item->MetaKeyword or ''}}</textarea>
                                
                            </div>
                            <div class="col-md-12">
                                <span><strong>Meta Description</strong></span> <code>Khoản 70 - 160 ký tự</code><br><br>
                                <textarea name="MetaDescription" id="input" class="form-control" rows="3" placeholder="Nhập nội dung Meta Description">{{ $item->MetaDescription or ''}}</textarea>
                                
                            </div>
                        </div>
                        <div class="horizontal-space"></div>
                        <div>
                            <button type="submit" class="btn btn-default purple"><i class="fa fa-plus"> Lưu</i></button>
                            <a href="{{route('getCategorys')}}" title="Quay lại danh sách danh mục"><button class="btn btn-info tooltip-info" data-toggle="tooltip" data-placement="top" >Hủy</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@if(isset($item))
    <script>
        $(document).ready(function(){ 
            $.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
        // Kiểm tra Tên danh mục đã tồn tại chưa
            $('input[name="Name"]').change(function(){
                var Name   =    $(this).val();
                var ParentID=$('input[name="ParentID"]').val();
                var id     =    $('input[name="id"]').val();
                var _token =    $('input[name="_token"]').val();
                $.ajax({
                    url:'{{route('postCheckNameEdit')}}',
                    type:'post',
                    cache:false,
                    data:{Name:Name,_token:_token,id:id,ParentID:ParentID},
                    dataType:'html',
                    success:function(msg)
                        {
                           if (msg=='Tên danh mục đã tồn tại') 
                           {
                                $(':input[type="submit"]').prop('disabled', true);
                                $('label[name="Name"]').html(msg);
                                $('label[name="Name"]').css('display','inline-block');
                            }
                           else{
                                $('label[name="Name"]').html('');
                                $('label[name="Name"]').css('display','none');
                                $(':input[type="submit"]').prop('disabled', false);
                            }
                        }
                    });
            });
            // End check Name
// Kiểm tra Alias
            $('input[name="Alias"]').change(function(){
                var Alias   =    $(this).val();
                var ParentID=$('input[name="ParentID"]').val();
                var id     =    $('input[name="id"]').val();
                var _token =    $('input[name="_token"]').val();
                $.ajax({
                    url:'{{route('postCheckAliasEdit')}}',
                    type:'post',
                    cache:false,
                    data:{Alias:Alias,_token:_token,id:id,ParentID:ParentID},
                    dataType:'html',
                    success:function(msg)
                        {
                           if (msg!='ok') {
                                $('label[name="Alias"]').html(msg);
                                $('label[name="Alias"]').css('display','inline-block');
                                $(':input[type="submit"]').prop('disabled', true);
                            }
                           else{
                                $('label[name="Alias"]').remove('');
                                $('label[name="Alias"]').css('display','none');
                                $(':input[type="submit"]').prop('disabled', false);
                            }
                        }
                    });
            });
            // end Check Alias
        });
    </script>
@else
    <script>
        $(document).ready(function(){
            $.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
            // Kiểm tra Tên danh mục đã tồn tại chưa
            $('input[name="Name"]').change(function(){
                var Name=$(this).val();
                var Type=$('input[name="Type"]').val();
                var ParentID=$('input[name="ParentID"]').val();
                var _token=$('input[name="_token"]').val();
                $.ajax({
                    url:'{{route('postCheckNameAdd')}}',
                    type:'post',
                    cache:false,
                    data:{Name:Name,Type:Type,ParentID:ParentID,_token:_token},
                    dataType:'html',
                    success:function(msg)
                        {
                           if(msg!='Tên danh mục đã tồn tại') {
                                $('label[name="Name"]').css('display','none');
                                $('input[name="Alias"]').val(msg);
                                if($('label[name="Alias"]').css('display')=='none')
                                    {$(':input[type="submit"]').prop('disabled', false);}
                            }
                           else{
                            $('label[name="Name"]').html(msg);
                            $('label[name="Name"]').css('display','inline-block');
                            if($('label[name="Alias"]').css('display')=='none'){
                                $(':input[type="submit"]').prop('disabled', true);
                            }
                        }
                        }
                    });
                // Kiểm tra Alias

            });
            // Kiểm tra Alias danh mục đã tồn tại chưa
            // $.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
            $('input[name="Alias"]').change(function(){
                var Alias=$(this).val();
                var ParentID=$('input[name="ParentID"]').val();
                var _token=$('input[name="_token"]').val();
                $.ajax({
                    url:'{{route('postCheckAliasAdd')}}',
                    type:'post',
                    cache:false,
                    data:{'Alias':Alias,ParentID:ParentID},
                    dataType:'html',
                    success:function(msg)
                        {
                           if (msg!='ok') {
                                $('label[name="Alias"]').html(msg);
                                $('label[name="Alias"]').css('display','inline-block');
                                if($('label[name="Name"]').css('display')=='none'){
                                    $(':input[type="submit"]').prop('disabled', true);
                                }
                            }
                           else{
                                $('label[name="Alias"]').html('');
                                $('label[name="Alias"]').css('display','none');
                                if($('label[name="Name"]').css('display')=='none'){
                                    $(':input[type="submit"]').prop('disabled', false);
                                }
                            }
                        }
                    });
            });
        });
    </script>
@endif
     <script src="{{ asset('control/assets/js/select.image.js') }}"></script>
    <style>
        .btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
#img-upload-icon,#img-upload-image,#img-upload-banner{
    width: 100%;
}
    </style>
@endsection
