$(document).ready(function(){
     $.ajaxSetup({ headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });
    $('.product-atc').click(function(){
        var id=$(this).attr('product-id');
        var price=$(this).attr('product-price');
        var qtt=$('#cart').attr('qtt');
        $.ajax({
        url:'{{route('postAddCart')}}', 
        type:'post',
        cache:false,
        data:{price:price,id:id},
        dataType:'html',
        success:function(msg){
            if(Number(qtt)==Number(msg)){
                tb='Đã tăng số lượng lên 1';
                Notify(tb, 'top-right', '5000', 'success', 'fa-check', true); 
            }
            else{
                tb='Đã thêm sản phẩm và giỏ hàng';
                $('#cart').attr('qtt',msg);
                $('#cart').html(msg);
            Notify(tb, 'top-right', '5000', 'success', 'fa-check', true); 
            }
        },
        error:function(){ Notify('Truyền dữ liệu thất bại', 'top-right', '5000', 'danger', 'fa-bolt', true);}
        });
    });
function Notify(message, position, timeout, theme, icon, closable) {
    toastr.options.positionClass = 'toast-' + position;
    toastr.options.extendedTimeOut = 0; //1000;
    toastr.options.timeOut = timeout;
    toastr.options.closeButton = closable;
    toastr.options.iconClass = icon + ' toast-' + theme;
    toastr['custom'](message);
}

});