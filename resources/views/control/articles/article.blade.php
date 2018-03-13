@extends('control.master')
@section('title',isset($item) ? 'Sửa bài viết' : 'Thêm bài viết')
@section('callCk')
<script src="{{asset('_plugins_/ckeditor/ckeditor.js')}}"></script>
@endsection
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
        <li class="active">Bài Viết</li>
    </ul>
</div>
<!-- /Page Breadcrumb -->
<!-- Page Header -->
<div class="page-header position-relative">
    <div class="header-title">
        <h1>
            {!!isset($item) ? 'Sửa bài viết' : 'Thêm bài viết'!!}
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
                <div class="widget-header bordered-bottom bordered-pink">
                    <span class="widget-caption">Form {!!isset($item) ? 'Sửa bài viết' : 'Thêm bài viết'!!}</span>
                </div>
                <div class="widget-body">
                    <div id="horizontal-form">
                        <form class="form-horizontal" action="{{(isset($item)) ? route('postEditArticle') : route('postAddArticle')}}" role="form" name="{{(isset($item)) ? 'frm_article_edit' : 'frm_article_add'}}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$item->id or ''}}">
                            <input type="hidden" name="CatId" value="{{$CatId}}">
                            @if ($errors->count() > 0)
                            <div class="row">
                                @foreach ($errors as $element)
                                    <div class="alert alert-warning">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{$element}}
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <span ><strong>Tên bài viết</strong></span>
                                    <input type="text" name="Name" value="{{ $item->Name or ''}}"  placeholder="Nhập tên bài viết" class="form-control">
                                    <label name="Name"  class="error" style="display: none;"></label>
                                    <div class="horizontal-space"></div>
                                </div>
                                <div class="col-md-6">
                                    <span ><strong>Alias bài viết</strong></span>
                                    <input type="text" name="Alias" value="{{ $item->Alias or ''}}"  placeholder="Tên không dấu của bài viết" class="form-control">
                                    <label name="Alias" class="error" style="display: none"></label>
                                    <div class="horizontal-space"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <span ><strong>Hiện sản phẩm</strong> &nbsp&nbsp&nbsp</span>
                                    <label style="margin-top: 10px;">
                                        <input class="checkbox-slider slider-icon colored-blue" @if(isset($item) && $item->IsActive ==1) checked="checked" @endif type="checkbox" name="IsActive">
                                        <span class="text"></span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <span ><strong>Sản phẩm nổi bật</strong> &nbsp&nbsp&nbsp</span>
                                    <label style="margin-top: 10px;">
                                        <input class="checkbox-slider slider-icon colored-blue" @if(isset($item) && $item->IsHot ==1) checked="checked" @endif type="checkbox" name="IsHot">
                                        <span class="text"></span>
                                    </label>
                                </div>
                                <div class="col-md-4 hidden">
                                    <span ><strong>Hiển thị Home</strong> &nbsp&nbsp&nbsp</span>
                                    <label style="margin-top: 10px;">
                                        <input class="checkbox-slider slider-icon colored-blue" @if(isset($item) && $item->IsHome ==1) checked="checked" @endif type="checkbox" name="IsHome">
                                        <span class="text"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span><strong>Hình ảnh đại diện</strong></span>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-info btn-file">
                                                Browse… <input type="file" id="imgInp" name="Img">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <img id='img-upload'/>
                                </div>
                                <div class="col-md-6">
                                    <span><strong>Tag</strong></span>
                                    <div class="input-group">
                                        <input type="text" name="Tag" value="{{ $tags or ''}}" class="form-control autocomple" data-role="tagsinput" style="height: 34px;" id="tags">
                                    </div>
                                    <img id='img-upload'/>
                                </div>
                                <div class="col-md-6">
                                    @if(isset($item)) <img src="{{asset($item->Img)}}" style="height: 300px;margin-top: 50px;"  class="img-responsive" alt="Image" on> @endif
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span><strong>Nội dung ngắn</strong></span>
                                    <textarea class="form-control mytextarea"  name="short_content" placeholder="Nội dung ngắn">@if(isset($item)){{ $item->ShortContent}}@endif</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span><strong>Nội dung chi tiết</strong></span>
                                    <textarea class="form-control mytextarea" name="content" placeholder="Nội dung chi tiết">@if(isset($item)){{ $item->Content}}@endif</textarea>
                                </div>
                            </div>
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
                                    <span><strong>Meta Descripton</strong></span> <code>Khoản 70 - 160 ký tự</code><br><br>
                                    <textarea name="MetaDescription" id="input" class="form-control" rows="3" placeholder="Nhập nội dung Meta Descripton">{{ $item->MetaDescription or ''}}</textarea>                                    
                                </div>
                            </div>
                            <div class="horizontal-space"></div>
                            <div>
                                <button type="submit" class="btn btn-default purple"><i class="fa fa-plus"> Thêm</i></button>
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
// Kiểm tra Tên sản phẩm đã tồn tại chưa
            $('input[name="Name"]').change(function(){
                var Name   =    $(this).val();
                var CatId=$('input[name="CatId"]').val();
                var id     =    $('input[name="id"]').val();
                var _token =    $('input[name="_token"]').val();
                $.ajax({
                    url:'{{route('postCheckNameEditArticle')}}',
                    type:'post',
                    cache:false,
                    data:{Name:Name,_token:_token,id:id,CatId:CatId},
                    dataType:'html',
                    success:function(msg)
                        {
                           if (msg=='Tên sản phẩm đã tồn tại') 
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
                var CatId = $('input[name="CatId"]').val();
                var id     =    $('input[name="id"]').val();
                var _token =    $('input[name="_token"]').val();
                $.ajax({
                    url:'{{route('postCheckAliasEditArticle')}}',
                    type:'post',
                    cache:false,
                    data:{Alias:Alias,_token:_token,id:id,CatId:CatId},
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
            // Kiểm tra Tên sản phẩm đã tồn tại chưa
            $('input[name="Name"]').change(function(){
                var Name=$(this).val();
                var CatId=$('input[name="CatId"]').val();
                var _token=$('input[name="_token"]').val();
                $.ajax({
                    url:'{{route('postCheckNameAddArticle')}}',
                    type:'post',
                    cache:false,
                    data:{Name:Name,_token:_token,CatId:CatId},
                    dataType:'html',
                    success:function(msg)
                        {
                           if (msg!='Tên sản phẩm đã tồn tại') {
                                $('label[name="Name"]').css('display','none');
                                $('input[name="Alias"]').val(msg);
                                $(':input[type="submit"]').prop('disabled', false);
                            }
                           else{
                            $('label[name="Name"]').html(msg);
                            $('label[name="Name"]').css('display','inline-block');
                            $(':input[type="submit"]').prop('disabled', true);
                        }
                        }
                    });
                // Kiểm tra Alias

            });
            // Kiểm tra Alias sản phẩm đã tồn tại chưa
            // $.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
            $('input[name="Alias"]').change(function(){
                var Alias=$(this).val();
                var CatId=$('input[name="CatId"]').val();
                var _token=$('input[name="_token"]').val();
                $.ajax({
                    url:'{{route('postCheckAliasAddArticle')}}',
                    type:'post',
                    cache:false,
                    data:{'Alias':Alias,CatId:CatId},
                    dataType:'html',
                    success:function(msg)
                        {
                           if (msg!='ok') {
                                $('label[name="Alias"]').html(msg);
                                $('label[name="Alias"]').css('display','inline-block');
                                $(':input[type="submit"]').prop('disabled', true);
                            }
                           else{
                                $('label[name="Alias"]').html('');
                                $('label[name="Alias"]').css('display','none');
                                $(':input[type="submit"]').prop('disabled', false);
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
#img-upload{
    width: 100%;
}
    </style>
@endsection
@section('jsCk')
    <script type="text/javascript">CKEDITOR.replace('short_content'); </script>
    <script type="text/javascript">CKEDITOR.replace('content'); </script>
    <!--Bootstrap Tags Input-->
    <script src="{{ asset('control/assets/js/tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script type="text/javascript">
       
    </script>
@endsection
