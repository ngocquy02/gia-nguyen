<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\EditAccountRequest;
use Illuminate\Database\Query\Builder;
use File;
use DateTime;
use DB;
use Image;

class AccountController extends Controller
{
	/*------------Lấy danh sách đối tác--------------*/
    public function getAccountAdmin()
    {   
        $items=Account::paginate(20);
        return view('control/account/index',compact('items'));
    }
	/*------------ Thêm đối tác---------------------*/
	public function getAddAccount()
    {   
        return view('control/account/account');
    }
    /*------------ Xem và chỉnh sửa đối tác-----------*/
    public function getEditAccount($id)
    {   
    	$item=Account::Find($id);
        $item2 = Account::all();
    	if(count($item2)>0){
            return  view('control/account/account',compact('item'));
        }
        else
        {
            $route='getAccountAdmin';
            $msg='Thông tin đối tác chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin đối tác chưa chính xác']);
        }
    }
    /*------------------------ Xóa đối tác ----------------------------------------*/
    public function postAccountDel(Request $request)
    {
        $Account=Account::find($request->id);
        if (File::exists($Account->Img)) {
            File::delete($Account->Img);
        }
        $Account->delete();
        return redirect()->route('getAccountAdmin');
    }
      /*-----------------------------Xóa nhiều đối tác --------------------------------------------*/
    public function postAccountDelCheck(Request $request)
    {
        $msg='';
        if($request->getid=='')
        {
            $msg='Chưa có dữ liệu';
        }
        else
        {
            $arrayIdDel=explode(',', $request->getid);
            foreach ($arrayIdDel as $key => $value) {
                $Account=Account::Find($value);
                if ($Account) {
                    if (File::exists($Account->Img)) {
                        File::delete($Account->Img);
                    }
                    $Account->delete();
                }
            }
            $msg='Đã xóa';
        }
        return $msg;
    }
    /*----------------------------------END xóa nhiều đối tác ---------------------------------------*/
    /*------------------------ Xóa đối tác ----------------------------------------*/
    public function postActiveAccount(Request $request)
    {
        if($request->ajax())
        {
            $Account=Account::find($request->id);
            $Account->IsActive=!$Account->IsActive;
            $Account->save();
            $msg=($Account->IsActive==1)? 'on' :'off';
            return $msg;
        }
    }
    /*------------------------End active tài khoản ------------------------------*/
    /*------------------ Lưu thông tin đối tác (Add) ------------------------------*/
    public function postAddAccount(AccountRequest $request)
    {
        $Account =new Account;
        $Account->FullName     =     $request->FullName;
        $Account->Email        =     $request->Email;
        $Account->Phone        =     $request->Phone;
        $Account->Company      =     $request->Company;
        $Account->Role         =     $request->Role;
        $Account->Address      =     $request->Address;
        $Account->created_at   =     new DateTime();
        $Account->updated_at   =     new DateTime();
        $Account->save();
        return redirect()->route('getAccountAdmin');
    }
    /*---------------- Lưu thông tin đối tác (Edit)------------------------*/
    public function postEditAccount(AccountRequest $request)
    {
        $Account =Account::Find($request->id);
        if ($Account) {
        $Account->FullName     =     $request->FullName;
        $Account->Email        =     $request->Email;
        $Account->Phone        =     $request->Phone;
        $Account->Company      =     $request->Company;
        $Account->Role         =     $request->Role;
        $Account->Address      =     $request->Address;
        $Account->created_at      =     new DateTime();
        $Account->updated_at      =     new DateTime();
        $Account->save();
        return redirect()->route('getAccountAdmin');
        }
        else
        {
            $route='getAccountAdmin';
            $msg='Thông tin đối tác chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin đối tác chưa chính xác']);
        }
    }
}
