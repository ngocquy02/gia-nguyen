<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotline;
use DateTime;

class HotlineController extends Controller
{
    public function getHotline(){
    	$items = Hotline::orderBy('created_at','desc')->paginate(20); 
    	return view('control.hotline',compact('items'));
    }


    public function getHotlineId($id){
    	$item = Hotline::find($id);
		return view('hotline2',compact('item'));    	
    }

    public function getAddHotline(){
        return view('hotline2');
    }

    public function postAddHotline(Request $request){
    	if(isset($request)){
    		$hotline = new Hotline;
            $hotline->Name = $request->Name;
            $hotline->Phone = $request->Phone;
            $hotline->Email = $request->Email;
            $hotline->Skype = $request->Skype;
            $hotline->IsActive = ($request->IsActive)=='on'?1:0;
            $hotline->created_at      =   new DateTime();
            $hotline->save();
            return redirect()->route('getHotline');
    	}
    }

     public function postEditHotline(Request $request){
        if(isset($request)){
            $hotline =Hotline::find($request->id);
            $hotline->Name = $request->Name;
            $hotline->Phone = $request->Phone;
            $hotline->Email = $request->Email;
            $hotline->Skype = $request->Skype;
            $hotline->IsActive = ($request->IsActive)=='on'?1:0;
            $hotline->updated_at      =   new DateTime();
            $hotline->save();
            return redirect()->route('getHotline');
        }
    }


    public function postActiveHotline(Request $request){
    	if ($request->ajax()) {
            $hotline =Hotline::find($request->id);
            $hotline->IsActive        =     ($request->IsActive==0) ? 1 : 0;
            $hotline->updated_at      =     new DateTime();
            $hotline->save();
            return ($hotline->IsActive == 1) ? 'on' : 'off';
        }
    }

    public function postHotlineDel(Request $request){
        $hotline=Hotline::find($request->id);
        if ($hotline) {
            $hotline->delete();
            return redirect()->route('getHotline');
        }
    }
}
