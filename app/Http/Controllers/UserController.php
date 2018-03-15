<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests;
use App\Http\Requests\DangKyRequest;
use App\Http\Requests\AdminEditRequest;
use Illuminate\Http\Request;
use File;
use DateTime;
use DB;
use Auth;

class UserController extends Controller
{

    public function showRole($role){
        $users = User::where(['Role'=>$role])->get();
        return view('control.users.index',compact('users'));
    }



    public function getRegister()
    {
    	return view('control.users.user');
    }
    public function postRegister(Request $request)
    {   
        $user = new User;
        if($request->Password!='')
        {
            $user->Password= bcrypt($request->Password);
        }
            $user->FullName=$request->FullName;
            $user->Email=$request->Email;
            $user->Phone=$request->Phone;
            $user->Skype=$request->Skype;
            $user->Facebook=$request->Facebook;
            $user->Google=$request->Google;
            $user->IsActive = 1;
            $user->Sex = 1;
            $user->Img = 'noimage.gif';
            $user->role = 1;
            $user->save();
        return redirect()->route('role-user',['role'=>1]);
    }
    public function getEdit($id)
    {
    	$item=User::Find($id);
    	if ($item->Role ==1) {
    		return view('control.users.user',compact('item'));
    	}
    	else
    	{
    		return view('control.users.admin',compact('item'));
    	}	
    }
    public function postEdit(AdminEditRequest $request)
    {
    	$user =User::Find($request->id);
    	if($request->Password!='')
    	{
    		$user->Password= bcrypt($request->Password);
    	}
    		$user->FullName=$request->FullName;
            $user->Email=$request->Email;
            $user->Phone=$request->Phone;
            $user->Skype=$request->Skype;
            $user->Facebook=$request->Facebook;
            $user->Google=$request->Google;
    		$user->save();
    	return redirect()->route('getEdit',['id'=>$request->id]);
    }
    public function show(Request $request, $id)
    {
        return $value = $request->session()->get('key');
    }

    public function delUser(Request $request){
        $user = User::find($request->id)->first();
        $count = User::count();
        // dd($count);die;
        if(Auth::guard('web')->user()->id != $request->id && $count>1){
            $user->delete();
            return redirect()->route('role-user',['role' => 1]);
        }else{
            return redirect()->route('role-user',['role' => 1]);
        }
    }
}
