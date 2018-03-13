<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Notification;
use App\Models\NotificationPartner;
use App\Models\Partner;
use App\Models\Category;
use App\Http\Request\SendCartRequest;
use Mail;
use DateTime;
// use Cart,Auth,DB;

class CartController extends Controller
{
    /*------------------------------Lấy danh sách đơn hàng----------------------------------------*/
    public function getCartControl()
    {
    	$items=Cart::orderBy('created_at','desc')->paginate(20);
        return view('control.cart.index',compact('items'));
    }
    /*----------------------------- Xem chi tiết đơn hàng----------------------------------------*/
    public function getEditCartControl($id)
    {
    	$item=Cart::Find($id);
    	if ($item) {
	        return view('control.cart.cart',compact('item'));
    	}
    	else
    	{
    		$route='getCategorys';
            $msg='Thông tin đơn hàng chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin đơn hàng chưa chính xác']);
    	}	
    }
    
    /*-----------------------------Xóa đơn hàng--------------------------------------------*/
    public function postCartDel(Request $request)
    {
        $cart=Cart::Find($request->id);
        $cart->delete();
        return redirect()->route('getCartControl');
    }
    /*----------------------------------END xóa đơn hàng---------------------------------------*/
    /*-----------------------------Update đơn hàng--------------------------------------------*/
    public function postEditCartControl(Request $request)
    {
        $cart=Cart::Find($request->id);
        $cart->IsPay=(isset($request->IsPay)) ? 1 : 0;
        $cart->IsTransport=(isset($request->IsTransport)) ? 1 : 0;
        $cart->save();
        return redirect()->back();
    }
    /*----------------------------------END Update đơn hàng---------------------------------------*/
    /*-----------------------------Update đơn hàng--------------------------------------------*/
    public function postSendCartControl(Request $request)
    {
        $cart=Cart::Find($request->id);
        if ($cart) {
            if ($cart->Notification!=null && Notification::Find($cart->Notification)) {
               $NotificationId=$cart->Notification;
            }
            else
            {
                $chieu=($cart->IsHome==1)?'2 Chiều' : '1 Chiều';
                $Content=
                '<span>Điểm đi: </span>'.$cart->AddressStart.'<br>'.
                '<span>Điểm đến: </span>'.$cart->AddressEnd.'<br>'.
                '<span>Khối lượng: </span>'.$cart->Weight.'<br>'.
                '<span>Loại xe: </span>'.Category::Find($cart->VehicleType)->Name.'<br>'.
                '<span>Giá: </span>'.number_format($request->Price).'<br>'.
                '<span>Giá Vận chuyển: </span>'.number_format($request->PriceCod).'<br>'.
                '<span>Ngày đi: </span>'.$cart->DateStart.'<br>'.
                '<span>Giờ đi: </span>'.$cart->TimeStart;
                '<span>Chiều đi: </span>'.$chieu;
                $Note=$request->Note;
                $Notification=new Notification;
                $Notification->Title='Xác nhận vận chuyển!';
                $Notification->Content=$Content;
                $Notification->Note=$Note;
                $Notification->save();
                $NotificationId=$Notification->id;
            }
            $partners=Partner::where(['IsOnline'=>1,'IsActive'=>1])->where('Coin','>=',0)->get();
            if ($partners->count() > 0) {
                $checkSend=0;
                foreach ($partners as $partner) {
                    if (!$partner->carts()->where('Status',2)->first()) {
                        NotificationPartner::updateOrCreate(
                            ['PartnerId'=>$partner->id,'NotifiId'=>$NotificationId,'CartId'=>$cart->id],
                            ['IsRead'=>0]
                        );
                       $checkSend++;
                    }
                }
                $msg=($checkSend==0)? "Không có đối tác nào có thể nhận đơn hàng" : 'Đã gửi đến '.$checkSend.' đối tác';
            }
            else
            {
                $msg="Không có đối tác nào có thể nhận đơn hàng";
            }
            $cart->Price=$request->Price;
            $cart->PriceCod=$request->PriceCod;
            $cart->DateStart=$request->DateStart;
            $cart->TimeStart=$request->TimeStart;
            $cart->Notification=$NotificationId;
            $cart->Status=1;
            $cart->save();
            return redirect()->back()->with('msg',$msg);
        }
        else
        {
            $route='getCategorys';
            $msg='Thông tin đơn hàng chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin đơn hàng chưa chính xác']);
        }
    }
    /*----------------------------------END Update đơn hàng---------------------------------------*/
     /*-----------------------------Hủy đơn hàng--------------------------------------------*/
    public function postCancelCartControl(Request $request)
    {
        $cart=Cart::Find($request->id);
        if ($cart) {
            if ($cart->Status>0 and $cart->Status<4) {
                $cart->Status=5;
                $cart->save();
                $msg='Đã hủy đơn hàng';
            } else {
                $msg='Đơn hàng không thể hủy';
            }
            return redirect()->back()->with('msg',$msg);
        }
        else
        {
            $route='getCategorys';
            $msg='Thông tin đơn hàng chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin đơn hàng chưa chính xác']);
        }
    }
    /*----------------------------------END hủy đơn hàng---------------------------------------*/  
    /*-----------------------------Xác nhận đơn hàng--------------------------------------------*/
    public function postSuccessCartControl(Request $request)
    {
        $cart=Cart::Find($request->id);
        if ($cart) {
            if ($cart->Status==3) {
                $cart->Status=4;
                $cart->save();
                $msg='Đã Xác nhận đơn hàng đơn hàng';
            } else {
                $msg='Đơn hàng không thể hoàn thành';
            }
            return redirect()->back()->with('msg',$msg);
        }
        else
        {
            $route='getCategorys';
            $msg='Thông tin đơn hàng chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin đơn hàng chưa chính xác']);
        }
    }
    /*----------------------------------END Xác nhận đơn hàng---------------------------------------*/   
}
