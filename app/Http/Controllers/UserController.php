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

class UserController extends Controller
{

    public function showRole($role){
        $user = User::where(['Role'=>$role])->get();
        return view('control.users.index',compact('users'));
    }



    public function getRegister()
    {
    	return view('control.users.user');
    }
    public function postRegister(Request $request)
    {
    	return $request->FullName;
    }
    public function getEdit($id)
    {
    	$item=User::Find($id);
    	if ($item->Role ==1) {
    		return view('control.users.admin',compact('item'));
    	}
    	else
    	{
    		return view('control.users.admin',compact('item'));
    	}	
    }
    public function postEdit(AdminEditRequest $request)
    {
    	$user=User::Find($request->id);
    	if($request->Password!='')
    	{
    		$user->Password= bcrypt($request->Password);
    	}
    		$user->FullName=$request->FullName;
    		$user->Email=$request->Email;

    		$user->save();
    	return redirect()->route('getEdit',['id'=>$request->id]);
    }
    public function show(Request $request, $id)
    {
        return $value = $request->session()->get('key');
    }
}
