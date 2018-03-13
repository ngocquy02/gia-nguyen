@extends('layouts.master')
@section('content')
<div class="main-breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li><a href="">Trang chủ</a></li>
					<li class="active">Thông báo</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="partner-content">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">				
				<div class="table-responsive">
					<fieldset>
						<table class="table table-bordered">
							<thead>
								<tr class="first last">
									<th rowspan="1">STT</th>
									<th rowspan="1">Ngày</th>
									<th colspan="1">Trạng thái</th>
									<th colspan="1">Đơn hàng nhận bởi</th>
									<th colspan="1">Thao tác</th>
								</tr>
							</thead>
							<tbody>
							@if ($notification->count() > 0)
							@php
								$stt=1;
							@endphp
								@foreach($notification as $notification)
									<tr class="first odd">
										<td>
											{{$stt}}
										</td>
										<td>{{$notification->created_at->format('d/m/Y')}}</td>
											@php
											$checkRead=\App\Models\NotificationPartner::where(['PartnerId'=>Auth::guard('partner')->user()->id,'NotifiId'=>$notification->id])->first();
											@endphp
										<td id="read{{$checkRead->id}}">
											@php
	                                            switch ($checkRead->IsRead) {
	                                                case 0:
	                                                    echo 'Chưa xem';
	                                                    break;
	                                                case 1:
	                                                    echo 'Đã xem';
	                                                    break;
	                                                default:
	                                                    echo 'Chưa xem';
	                                                    break;
	                                            }
	                                        @endphp
										</td>
										<td >
											@php
	                                            $getCart=\App\Models\Cart::Find($checkRead->CartId);
	                                        @endphp
	                                        @if ($getCart and $getCart->PartnerBy != null)
		                                        {{-- @php
	                                        		$getPartner=\App\Models\Partner::Find($getCart->PartnerBy);
		                                        @endphp --}}
		                                        {{'Đã nhận'}}
		                                    @else
		                                        {{'Chưa nhận'}}
	                                        @endif
										</td>
										<td class="a-right movewishlist">
											<a class="btn btn-detai bnt-xs" data-toggle="modal" href='#{{$notification->id}}' isread="{{$checkRead->IsRead}}" idnotifi="{{$checkRead->id}}">Chi tiết</a>
											<div class="modal fade" id="{{$notification->id}}">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title">Chi tiết thông báo</h4>
														</div>
														<div class="modal-body">
															{!!$notification->Content!!}
														</div>
														<div class="modal-footer">
															<button type="button" class="btn-detai bnt-xs btn btn-default" data-dismiss="modal">Close</button>
															<form action="{{ route('postAddCartPartner') }}" method="post" accept-charset="utf-8">
                        									{{ csrf_field() }}
															<input type="hidden" name="CartId" value="{{$checkRead->CartId}}">
															<button type="submit" class="btn-detai bnt-xs btn">Nhận đơn hàng</button>
															</form>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
									@php
										$stt++;
									@endphp
								@endforeach		
							@endif
							</tbody>
						</table>
					</fieldset>
				</div>				
			</div>
			
		</div>
	</div>
</div>
@endsection
@section('jsProduct')
<script >
    $(document).ready(function(){
    	$('a.btn-detai').click(function(){
	    	var getread=$(this).attr('isread');
	    	if(getread==0)
	    	{
	    		$.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
	    		var id=$(this).attr('idnotifi');
		        $.ajax({
			        url:'{{route('postReadNotification')}}', 
			        type:'post',
			        cache:false,
			        data:{id:id},
			        dataType:'html',
			        success:function(msg){
			            if (msg==1) {$('#read'+id).html('Đã xem')}
			        },
			        error:function(){ alert('Truyền dữ liệu thất bại');}
		        });

	    	}
    	});
    	@if (session()->has('msg'))
    		alert('{{session()->get('msg')}}');
    	@endif
    });
</script>
@endsection