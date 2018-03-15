<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Requests\AddSliderRequest;
use App\Http\Requests\EditSliderRequest;
use Illuminate\Support\Facades\Input;
use File,DateTime,Image;


class AdvertiseController extends Controller
{
    /*
        Lấy danh sách Ads
     */
    public function getAds(){
        $items = Slider::where(['Type' => 'Advertise'])->get();
         $type = 'Advertise';
        return view('control.sliders.index',['type' => $type],compact('items'));
    }
    /*
    	Thêm Ads
     */
     public function getAddAds()
    {	
    	$type = "Advertise";
        return view('control.sliders.slider',['type' =>$type]);
    }

    /*
    	Thêm Popup
     */
     public function postAddAds(AddSliderRequest $request)
    {
        $slider =new Slider;
        $IdxMax= (count(Slider::all()) + 1);
        // Upload hình ảnh
        if ($request->file('Img')) {
            $image = $request->file('Img');
            $file_name = 'Upload/slider/'.time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->fit(800, 96)->save($file_name,100);
            $slider->Img             =     $file_name;
        }
        else{$slider->Img            =     '';}
        $slider->Url                    =    $request->Url;
        $slider->Name                   =    $request->Name;
        $slider->Type                   =    "Advertise";
        $slider->IsActive               =     ($request->IsActive == 'on') ? 1 : 0;
        $slider->Idx                    =     $IdxMax;
        $slider->Locale                 =     'vi-vn';
        $slider->created_at             =     new DateTime();
        $slider->updated_at             =     new DateTime();

        $slider->save();
        return redirect()->route('getAds');
    }


    /*
    	Sửa quảng cáo
     */
     public function getEditAds($id)
    {   
        $item = Slider::find($id); // Lấy dữ liệu slider theo id
        $item2 = Slider::all();
        if(count($item2)>0){
        	$type = "Advertise";
            return view('control.sliders.slider',['type'=>$type],compact('item'));
        }
        else
        {
            $route='getAds';
            $msg='Thông tin quảng cáo chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin quảng cáo chưa chính xác']);
        }
    }

    public function postEditAds(Request $request)
    {
        $slider =Slider::Find($request->id);
        $IsActive=($request->IsActive == 'on') ? 1 : 0;
        // Upload hình ảnh
        if ($request->file('Img')) {
            $image = $request->file('Img');
            $file_name = 'Upload/slider/'.time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->fit(800, 96)->save($file_name,100);
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
        return redirect()->route('getAds');
    }

     public function postAdsDel(Request $request)
    {
        $slider=Slider::find($request->id);
        $slider2 = Slider::all();
        if(count($slider2)>0)
        {
            if (File::exists($slider->Img)) {
                File::delete($slider->Img);
            }
            $slider->delete();
            return redirect()->route('getAds');
            // return redirect()->back();
        }       
        else
        {
            $route='getPopup';
            $msg='Thông tin quảng cáo chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin quảng chưa chính xác']);
        }
    }
}
