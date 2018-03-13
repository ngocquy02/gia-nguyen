<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Requests\AddSliderRequest;
use App\Http\Requests\EditSliderRequest;
use Illuminate\Support\Facades\Input;
use File,DateTime,Image;

class PopupController extends Controller
{
   /*
        Lấy danh sách popup
     */
    public function getPopup(){
        $items = Slider::where(['Type' => 'Popup'])->get();
         $type = 'Popup';
        return view('control.sliders.index',['type' => $type],compact('items'));
    }
    /*
    	thêm popup
     */
     public function getAddPopup()
    {	
    	$type = "Popup";
        return view('control.sliders.slider',['type' =>$type]);
    }
    /*
    	Thêm Popup
     */
     public function postAddPopup(AddSliderRequest $request)
    {
        $slider =new Slider;
        $IdxMax= (count(Slider::all()) + 1);
        // Upload hình ảnh
        if ($request->file('Img')) {
            $image = $request->file('Img');
            $file_name = 'Upload/slider/'.time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->fit(1349, 500)->save($file_name,100);
            $slider->Img             =     $file_name;
        }
        else{$slider->Img            =     '';}
        $slider->Url                    =    $request->Url;
        $slider->Name                   =    $request->Name;
        $slider->Type                   =    "Popup";
        $slider->IsActive               =     ($request->IsActive == 'on') ? 1 : 0;
        $slider->Idx                    =     $IdxMax;
        $slider->Locale                 =     'vi-vn';
        $slider->created_at             =     new DateTime();
        $slider->updated_at             =     new DateTime();

        $slider->save();
        return redirect()->route('getPopup');
    }

    /*
    

     */
    public function getEditPopup($id)
    {   
        $item = Slider::find($id); // Lấy dữ liệu slider theo id
        $item2 = Slider::all();
        if(count($item2)>0){
        	$type = "Popup";
            return view('control.sliders.slider',['type'=>$type],compact('item'));
        }
        else
        {
            $route='getPopup';
            $msg='Thông tin popup chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin popup chưa chính xác']);
        }
    }

    public function postEditPopup(Request $request)
    {
        $slider =Slider::Find($request->id);
        $IsActive=($request->IsActive == 'on') ? 1 : 0;
        // Upload hình ảnh
        if ($request->file('Img')) {
            $image = $request->file('Img');
            $file_name = 'Upload/slider/'.time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->fit(1349, 500)->save($file_name,100);
            if($slider->Img!='')
            {
                if (File::exists($slider->Img)) {
                    File::delete($slider->Img);
                }
            }
            $slider->Img             =     $file_name;
        }
        $slider->Url        =     $request->Url;
        $slider->Name        =     $request->Name;
        $slider->IsActive        =     $IsActive;
        $slider->updated_at      =     new DateTime();
        $slider->save();
        return redirect()->route('getPopup');
    }

    public function postPopupDel(Request $request)
    {
        $slider=Slider::find($request->id);
        $slider2 = Slider::all();
        if(count($slider2)>0)
        {
            if (File::exists($slider->Img)) {
                File::delete($slider->Img);
            }
            $slider->delete();
            return redirect()->route('getPopup');
            // return redirect()->back();
        }       
        else
        {
            $route='getPopup';
            $msg='Thông tin popup chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin popup chưa chính xác']);
        }
    }
}
