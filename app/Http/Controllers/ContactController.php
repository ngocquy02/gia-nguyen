<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /*------------------------------Lấy danh sách bài viết----------------------------------------*/
    public function getContact()
    {
    	$items=Contact::all();
        return view('control.contact.index',compact('items'));
    }
    
    /*-----------------------------Xóa bài viết--------------------------------------------*/
    public function postContactDel(Request $request)
    {
        $contact=Contact::Find($request->id);
        $contact->delete();
        return redirect()->route('getContact');
    }
    /*----------------------------------END xóa bài viết---------------------------------------*/ 
}
