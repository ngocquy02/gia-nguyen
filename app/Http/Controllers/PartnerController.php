<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use App\Http\Requests\PartnerRequest;
use App\Http\Requests\EditPartnerRequest;
use Illuminate\Database\Query\Builder;
use File;
use DateTime;
use DB;
use Image;

class PartnerController extends Controller
{
	/*------------Lấy danh sách đối tác--------------*/
    public function getPartner()
    {   
        $items=Partner::paginate(20);
        return view('control/partner/index',compact('items'));
    }
	/*------------ Thêm đối tác---------------------*/
	public function getAddPartner()
    {   
        return view('control/partner/partner');
    }
    /*------------ Xem và chỉnh sửa đối tác-----------*/
    public function getEditPartner($id)
    {   
        $item=Partner::Find($id);
    	$item2=Partner::all();
    	if(count($item2)>0){
            return  view('control/partner/partner',compact('item'));
        }
        else
        {
            $route='getPartner';
            $msg='Thông tin đối tác chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin đối tác chưa chính xác']);
        }
    }
    /*------------------------ Xóa đối tác ----------------------------------------*/
    public function postPartnerDel(Request $request)
    {
        $partner=Partner::find($request->id);
        if (File::exists($partner->Img)) {
            File::delete($partner->Img);
        }
        $partner->delete();
        return redirect()->route('getPartner');
    }
      /*-----------------------------Xóa nhiều đối tác --------------------------------------------*/
    public function postPartnerDelCheck(Request $request)
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
                $partner=Partner::Find($value);
                if ($partner) {
                    if (File::exists($partner->Img)) {
                        File::delete($partner->Img);
                    }
                    $partner->delete();
                }
            }
            $msg='Đã xóa';
        }
        return $msg;
    }
    /*----------------------------------END xóa nhiều đối tác ---------------------------------------*/
    /*------------------------ Xóa đối tác ----------------------------------------*/
    public function postActivePartner(Request $request)
    {
        if($request->ajax())
        {
            $partner=Partner::find($request->id);
            $partner->IsActive=!$partner->IsActive;
            $partner->save();
            $msg=($partner->IsActive==1)? 'on' :'off';
            return $msg;
        }
    }
    /*------------------------End active tài khoản ------------------------------*/
    /*------------------ Lưu thông tin đối tác (Add) ------------------------------*/
    public function postAddPartner(PartnerRequest $request)
    {
        $partner =new Partner;
        $image = $request->file('Img');
        $file_name = time().'-'.$request->file('Img')->getClientOriginalName();   
        $destinationPath = 'Upload/partner/';
        $img = Image::make($image->getRealPath());
        $img->fit(200, 120)->save($destinationPath.'/'.$file_name);
        // $file_name='noimage.gif';
        $partner->Img     =     $destinationPath.$file_name;
        $partner->Name     =     $request->Name;
        $partner->Url        =     $request->Url;
        $partner->IsActive     =     ($request->IsActive=='on') ? 1 : 0;
        $partner->created_at   =     new DateTime();
        $partner->updated_at   =     new DateTime();
        $partner->save();
        return redirect()->route('getPartner');
    }
    /*---------------- Lưu thông tin đối tác (Edit)------------------------*/
    public function postEditPartner(PartnerRequest $request)
    {
        $partner =Partner::Find($request->id);
        if ($partner) {
            if($request->Img==''){
                $file_name1 = $partner->Img;
            }else{
                $file_name = time().'-'.$request->file('Img')->getClientOriginalName();   
                $destinationPath = 'Upload/partner/';
                $image = $request->file('Img');
                $img = Image::make($image->getRealPath());
                $img->fit(200, 120)->save($destinationPath.'/'.$file_name);
                $file_name1 = $destinationPath.$file_name;
            }

            $partner->Img     =     $file_name1;
            $partner->Name     =     $request->Name;
            $partner->Url        =     $request->Url;
            $partner->IsActive     =     ($request->IsActive=='on') ? 1 : 0;
            $partner->created_at      =     new DateTime();
            $partner->updated_at      =     new DateTime();
            $partner->save();
            return redirect()->route('getPartner');
        }
        else
        {
            $route='getPartner';
            $msg='Thông tin đối tác chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin đối tác chưa chính xác']);
        }
    }
}
