<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Validator;

class LoginController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth', ['except' => 'logout']);
    // }   
    public function postLogout()
    {
       Auth::logout();
       if(session_id() == '') { session_start(); }
        unset($_SESSION['enable_filemanager']);
       return redirect()->route('login');
    }
    public function logout()
    {
        Auth::logout();
       return redirect()->route('controller');
    }
    public function login()
    {
        if (Auth::check()) {

            return redirect()->route('controller');  
        } else {
            return view('control.login');
        }
        
    }
    public function postLogin(LoginRequest $request)
    {   	
    	if (Auth::attempt(['Email' => $request->Email, 'Password' =>$request->Password,'Role'=>1])) {
            if(session_id() == '') { session_start(); }
            $_SESSION['enable_filemanager']=true;
            return redirect()->route('controller');
        }
        else
        {
        	// dd($request->Email.'dsada'.$request->Password);
        	return redirect()->back()->with(["msg"=>"Thông tin không chính xác"]);
        }
    }
}
