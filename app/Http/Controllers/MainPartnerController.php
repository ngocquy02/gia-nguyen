<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\Partner;
use App\Models\Cart;
use App\Models\Password_Change;
use App\Models\NotificationPartner;
use App\Http\Requests\RegisterPartnerRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Http\Requests\ChangPasswordPartnerRequest;
use App\Http\Requests\PasswordMailRequest;
use App\Http\Requests\PasswordResetRequest;
use Mail,Socialite, DateTime;

class MainPartnerController extends Controller
{
    /*Get Login Partner*/
    public function getLoginPartner()
    {
    	if(Auth::guard('partner')->check())
    	{
    		return redirect()->route('getPartnerMain');
    	}
        else
        {
            if (Auth::guard('account')->check()) {
                Auth::guard('account')->logout();
            }
	    	$company=Company::where('Locale','vi-vn')->first();
			$header['title']       	=	"Đăng nhập vào hệ thống";
			$header['description'] 	=	'Đăng Nhập vào hệ thống';
			$header['keywords']    	=	$company->MetaKeyword;
			$header['image']       	=	$company->Logo;
	    	return view('partner.login',['company'=>$company,'root'=>'','header'=>$header]);        	
        }
    }
    /*        post Login Partner*/
    public function postLoginPartner(LoginRequest $request)
    {
    	if (Auth::guard('partner')->attempt(['Email' => $request->Email, 'Password' => $request->Password, 'IsActive' => 1])) 
    	{
    		return redirect()->route('getPartnerMain');
		}
    	else
    	{
    		$company=Company::where('Locale','vi-vn')->first();
			$header['title']       		=	"Đăng nhập vào hệ thống";
			$header['description'] 		=	'Đăng Nhập vào hệ thống';
			$header['keywords']    		=	$company->MetaKeyword;
			$header['image']       		=	$company->Logo;
			$msgLogin              		=	'Tên đăng nhập hoặc mật khẩu không chính xác';
	    	return view('partner.login',['company'=>$company,'root'=>'','header'=>$header,'msgLogin'=>$msgLogin]);
    	}
    }
    // Get Register Partner
    public function getRegisterPartner()
    {
    	if(Auth::guard('partner')->check())
    	{
    		return redirect()->route('getPartnerMain');
    	}
        else
        {
	    	$company=Company::where('Locale','vi-vn')->first();
			$header['title']       		=	"Đăng ký thành viên";
			$header['description'] 		=	'Đăng ký thành viên để nhận được nhiều ưu đãi';
			$header['keywords']    		=	$company->MetaKeyword;
			$header['image']       		=	$company->Logo;
	    	return view('partner.register',['company'=>$company,'root'=>'','header'=>$header]);
	    }
    }
    // Post Register Partner
    public function postRegisterPartner(RegisterPartnerRequest $request)
    {
        $company=Company::where('Locale','vi-vn')->first();
        $mailcc=$company->Email;
    	$password=str_random(10);
    	$token=csrf_token();
		$Partner=Partner::Create([
		'FullName'        =>	$request->FullName,
		'Email'           =>	$request->Email,
		'Company'         =>	$request->Company,
        'Role'            =>    $request->Role,
		'Code'            =>	rand(100000,999999),
		'Address'         =>	$request->Address,
		'Phone'           =>	$request->Phone,
		'CustomerType'    =>	$request->CustomerType,
		'Content'         =>	$request->Content,
		'Password'        =>	bcrypt($password),
		'remember_token'  =>	$token,
		]);
		$data = array(
                'FullName'          =>      $Partner->FullName,
				'Code'         	=>		$Partner->Code,
				'Url'         		=>		route('getLoginPartner'),
				'Password'     		=>		$password,
                'Email'             =>      $Partner->Email,
				'Emailcc'     		=>		$mailcc,
    			);
    		\Mail::send('partner.activeByMail', $data, function ($message) use ($data){
                $message->to($data['Email'], $data['FullName']);
    		    $message->to($data['Emailcc']);
    		    $message->subject('Kích hoạt tài khoản');
    		});
            if (Mail::failures()) {
                return redirect()->back()->with(['msg'=>'Gửi thất bại! Vui lòng thử lại!']);
            }
    	return redirect()->back()->with(['msg'=>'Vui lòng kiểm tra Mail để kích hoạt tài khoản']); 
    }
    // Get Logout Partner
    public function getLogoutPartner()
    {
    	Auth::guard('partner')->logout();
    	return redirect()->route('getIndex');    
    }
    // Get Partner
    public function getPartnerMain()
    {
    	if (Auth::guard('partner')->check()) {
    		$company=Company::where('Locale','vi-vn')->first();
			$header['title']       		=	"Thông tin tài khoản";
			$header['description'] 		=	'Thông tin tài khoản và đơn hàng';
			$header['keywords']    		=	$company->MetaKeyword;
			$header['image']       		=	$company->Logo;
	    	return view('partner.index',['company'=>$company,'root'=>'','header'=>$header]);
    	}
    	else
    	{
    		return redirect()->route('getLoginPartner');
    	}	
    }
    // Thông tin tài khoản
    public function getUpdatePartner()
    {
    	if (Auth::guard('partner')->check()) {
    		$company=Company::where('Locale','vi-vn')->first();
			$header['title']       		=	"Thay đổi thông tin tài khoản";
			$header['description'] 		=	'Thay đổi thông tin tài khoản';
			$header['keywords']    		=	$company->MetaKeyword;
			$header['image']       		=	$company->Logo;
			$item=Auth::guard('partner')->user();
	    	return view('partner.updatepartner',['company'=>$company,'root'=>'','header'=>$header,'item'=>$item]);
    	}
    	else
    	{
    		return redirect()->route('getLoginPartner');
    	}	
    }
    // Thông báo
    public function getNotificationPartner()
    {
    	if (Auth::guard('partner')->check()) {
    		$notification=Partner::Find(Auth::guard('partner')->user()->id)->notification()->orderBy('created_at','desc')->get();
    		$company=Company::where('Locale','vi-vn')->first();
			$header['title']       		=	"Thay đổi thông tin tài khoản";
			$header['description'] 		=	'Thay đổi thông tin tài khoản';
			$header['keywords']    		=	$company->MetaKeyword;
			$header['image']       		=	$company->Logo;
	    	return view('partner.notification',['company'=>$company,'root'=>'','header'=>$header,'notification'=>$notification]);
    	}
    	else
    	{
    		return redirect()->route('getLoginPartner');
    	}	
    }
    // Đánh dấu đã xem
    public function postReadNotification(Request $request)
    {
    	if($request->ajax())
    	{
	    	if (Auth::guard('partner')->check()) {
	    		$notification=NotificationPartner::Find($request->id);
	    		if ($notification) {
	    			$notification->IsRead=1;
	    			$notification->save();
	    			$msg=1;
	    		} else {
	    			$msg=0;
	    		}
	    		return $msg;
	    	}
	    	else
	    	{
	    		return redirect()->route('getLoginPartner');
	    	}	
	    }
    }
    // Nhận đơn hàng
    public function postAddCartPartner(Request $request)
    {
        if (Auth::guard('partner')->check()) {
            $id=$request->CartId;
            $Partner=Partner::Find(Auth::guard('partner')->id());
            $cart=Cart::Find($id);
            if ($cart and $cart->PartnerBy==null){
                if ($Partner->Coin >= $cart->PriceCod) {
                    $cart->PartnerBy=Auth::guard('partner')->user()->id;
                    $cart->Status=2;
                    $cart->save();
                    $Partner->Coin=$Partner->Coin-$cart->PriceCod;
                    $Partner->save();
                    $msg='Đã nhận đơn hàng';
                } else {
                    $msg='Không đủ điều kiện nhận đơn hàng!';
                }   
            } else {
                $msg='Đơn hàng không tồn tại hoặc đã được nhận';
            }
            return redirect()->back()->with(['msg'=>$msg]);
        }
        else
        {
            return redirect()->route('getLoginPartner');
        }   
    }
    // Hoàn thành đơn hàng
    public function postSuccessCartPartner(Request $request)
    {
        if (Auth::guard('partner')->check()) {
            $id=$request->id;
            $cart=Cart::Find($id);
            if ($cart and $cart->PartnerBy==Auth::guard('partner')->user()->id and $cart->Status==2) {
                $cart->Status=3;
                $cart->save();
                $msg='Chờ kiểm duyệt Hoàn thành đơn hàng';
            } else {
                $msg='Đơn hàng không tồn tại hoặc đã được nhận';
            }
            return redirect()->back()->with(['msg'=>$msg]);
        }
        else
        {
            return redirect()->route('getLoginPartner');
        }   
    }

    // Hủy đơn hàng
    public function postCancelCartPartner(Request $request)
    {
    	if (Auth::guard('partner')->check()) {
    		$id=$request->id;
    		$cart=Cart::Find($id);
    		if ($cart and $cart->PartnerBy==Auth::guard('partner')->user()->id and $cart->Status<3) {
    			$cart->Status=1;
                $cart->PartnerBy=null;
    			$cart->save();
    			$msg='Đã hủy đơn hàng';
    		} else {
    			$msg='Đơn hàng không tồn tại hoặc đã được nhận';
    		}
    		return redirect()->back()->with(['msg'=>$msg]);
    	}
    	else
    	{
    		return redirect()->route('getLoginPartner');
    	}	
    }
    // Update thông tin tài khoản
    public function postUpdatePartner(UpdatePartnerRequest $request)
    {
		$Partner           =	Partner::Find($request->id);
		$Partner->FullName =	$request->FullName;
		$Partner->Phone    =	$request->Phone;
		$Partner->Address  =	$request->Address;
		$Partner->Company  =	$request->Company;
		$Partner->Role     =	$request->Role;
		$Partner->IsOnline =	$request->IsOnline;
    	$Partner->save();
    	return redirect()->route('getPartnerMain'); 
    }
    // Gửi mail xác nhận thay đổi mật khẩu
    public function sendResetLinkEmailPartner(PasswordMailRequest $request)
    {
    	$Email= $request->Email;
    	$Partner=Partner::where('Email',$Email)->first();
    	if ($Partner) {
    		$company=Company::where('Locale','vi-vn')->first();
    		$Token=str_random(60);
	        $data = array(
				'NameCompany'  =>		$company->Name,
				'Email'		   =>		$Email,
				'LinkCompany'  =>		asset('/'),
				'FullName'     =>		$Partner->FullName,
				'Token'        =>		$Token
				);
			\Mail::send('partner.password', $data, function ($message) use ($data){
			    $message->to($data['Email'], $data['FullName']);
			    $message->subject('Xác nhận thông tin thay đổi mật khẩu');
			});
            if (Mail::failures()) {
                return redirect()->back()->with(['status'=>'Gửi thất bại! Vui lòng thử lại!']);
            }
			$password=Password_Change::where(['Email'=>$Email,'Type'=>2])->first();
			if ($password) 
			{
				$updateToken=Password_Change::Find($password->id);
				$updateToken->Token=$Token;
				$updateToken->save();
			}
			else
			{
				$insertPassword             	=	 new Password_Change;
                $insertPassword->Email          =   $Email;
				$insertPassword->Type      	    =	2;
				$insertPassword->Token      	=	$Token;
				$insertPassword->created_at 	=	new DateTime();
				$insertPassword->save();
			} 
			$status='Vui lòng kiểm tra Mail để lấy lại mật khẩu!';
	    	return redirect()->back()->with(['status'=>$status]);		
    	}
    	else
    	{
		    $status='Email chưa đăng ký tài khoản!';
	    	return redirect()->back()->with(['status'=>$status]);
    	}
    }
    // Xác nhận thông tin đổi mật khẩu
    Public function getPasswordResetPartner($token,$email)
    {
    	$checkToken=Password_Change::where([
                                        ['Email' , '=' , $email],
    									['Type' , '=' , 2],
    									['Token' , '=' , $token]
    									])->first();
    	if($checkToken)
    	{
    		$company=Company::where('Locale','vi-vn')->first();
			$header['title']       		=	'Thay đổi mật khẩu cho '.$email;
			$header['description'] 		=	'Cập nhật mật khẩu mới cho '.$email;
			$header['keywords']    		=	$company->MetaKeyword;
			$header['image']       		=	$company->Logo;
    		return view('partner.changepassword',['company'=>$company,'root'=>'','header'=>$header,'Email'=>$email,'Token'=>$token]);
    	}
    	else
    	{
    		$company=Company::where('Locale','vi-vn')->first();
    		$header['title']='Thông tin chưa chính xác |'.$company->MetaTitle;
		    $header['description']='Thông tin chưa chính xác | '.$company->MetaDescription;
		    $header['keywords']=$company->MetaKeyword;
		    $header['image']=$company->Logo;
	    	$error='Thông tin chưa chính xác';
		    	return view('layouts.error',['company'=>$company,'root'=>'','header'=>$header,'error'=>$error]);
    	}
    }
    // Lưu thay đổi mật khẩu
    public function postPasswordPartnerReset(PasswordResetRequest $request)
    {
		$Email           =		$request->Email;
		$Token           =		$request->Token;
		$Password        =		$request->Password;
		$PasswordConfirm =		$request->PasswordConfirm;
		// kiểm tra có trong yêu cầu thay đổi mật khẩu không
		$checkToken=Password_Change::where([
                                        ['Email' , '=' , $Email],
    									['Type' , '=' , 2],
    									['Token' , '=' , $Token]
    									])->first();
    	if($checkToken)
    	{
			$checkPartner             	=	Partner::select('id')->where('Email',$Email)->first();
			$idPartner                	=	$checkPartner->id;
			$PasswordChange           	=	Partner::Find($idPartner);
			$PasswordChange->Password 	=	bcrypt($Password);
			$PasswordChange->save();
			$Status                   	=	'Thay đổi mật khẩu thành công!';
    		return redirect()->back()->with(['status'=>$Status]);
    	}
    	else
    	{
		    $Status='Tài khoản không yêu cầu thay đổi mật khẩu!';
    		return redirect()->back()->with(['status'=>$Status]);
    	}
    }
    /*Chi tiết đơn hàng đã nhận*/
    public function getOrderPartner($CartCode)
    {

        if (Auth::guard('partner')->check()) {
            $item= Cart::where('CartCode',$CartCode)->first();
            if ($item) {
                $company=Company::where('Locale','vi-vn')->first();
                $header['title']            =   "Thông tin chi tiết về đơn hàng";
                $header['description']      =   'Thông tin chi tiết về đơn hàng';
                $header['keywords']         =   $company->MetaKeyword;
                $header['image']            =   $company->Logo;
                return view('partner.order',['company'=>$company,'root'=>'','header'=>$header,'item'=>$item]);
            }
            else
            {
                $company=Company::where('Locale','vi-vn')->first();
                $header['title']='Thông tin đơn hàng chưa chính xác |'.$company->MetaTitle;
                $header['description']='Thông tin đơn hàng chưa chính xác | '.$company->MetaDescription;
                $header['keywords']=$company->MetaKeyword;
                $header['image']=$company->Logo;
                $error='Thông tin đơn hàng chưa chính xác';
                return view('layouts.error',['company'=>$company,'root'=>'','header'=>$header,'error'=>$error]);
            }   
        }
        else
        {
            return redirect()->route('getLoginPartner');
        }   
    }
    public function postChangePassword(ChangPasswordPartnerRequest $request)
    {
        $Password=$request->Password;
        $NewPassword=$request->NewPassword;
        if ($Password!='' and $NewPassword!='' and Auth::guard('partner')->check()) {

            if (Hash::check($Password, Auth::guard('partner')->user()->Password)) {
            $Partner=Partner::Find(Auth::guard('partner')->id());
                $Partner->Password=bcrypt($NewPassword);
                $Partner->save();
                Auth::guard('partner')->logout();
                return redirect()->route('getLoginPartner');
            }
            else
            {
                return redirect()->back()->with(['msg'=>'Mật khẩu không chính xác!']);
            }
        } else {
           return redirect()->back()->with(['msg'=>'Mật khẩu không chính xác!']);
        }
        
    }
}
