<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyMapRequest;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\CompanyImgRequest;
use App\Http\Requests\CompanyLogoRequest;
use File;
use App\Models\Company;
use DateTime;
use Image;

class CompanyController extends Controller
{
    public function getCompany()
    {
    	$items=Company::all();
        if(count($items)>0){
            foreach ($items as $item)
            return view('control.company.index',compact('item'));
        }
    	else
        {
    	    $route='controller';
            $msg='Chưa có thông tin công ty!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Chưa có thông tin công ty']);
        }
    }
    public function postCompanyMap(CompanyMapRequest $request)
    {	
    	// echo $request->Map;

    	$Company = Company::find($request->id);

		$Company->Map 			 = 		 $request->Map;

		$Company->save();
		$items=Company::all();
    	foreach ($items as $item)
    	return redirect()->route('getCompany');
    }
    public function postCompany(CompanyRequest $request)
    {
    	$Company = Company::find($request->id);

		$Company->Name            =		 $request->Name;
		$Company->Phone           =		 $request->Phone;
		$Company->Email           =		 $request->Email;
		$Company->Address         =		 $request->Address;
		$Company->Facebook        =		 $request->Facebook;
		$Company->Twitter         =		 $request->Twitter;
		$Company->Google          =		 $request->Google;
		$Company->Zalo            =		 $request->Zalo;
		$Company->Skype           =		 $request->Skype;
		$Company->Viber           =		 $request->Viber;
		$Company->Analytic        =		 $request->Analytic;
		$Company->Chatbox         =		 $request->Chatbox;
		$Company->MetaTitle       =		 $request->MetaTitle;
		$Company->MetaDescription =		 $request->MetaDescription;
		$Company->MetaKeyword     =		 $request->MetaKeyword;
		$Company->Locale     	  =		 "vi-vn";
		$Company->updated_at      =		 new DateTime();

		$Company->save();
    	return redirect()->route('getCompany');
    }
    public function postCompanyImg(CompanyImgRequest $request)
    {
    	$Company = Company::find($request->id);
            $image = $request->file('Img');
            $file_name = 'Upload/company/'.time().'-'.$image->getClientOriginalName();               
            $img = Image::make($image->getRealPath());
            $img->fit(1366, 300)->save($file_name,100);

		if ($Company->Img !='') {
			File::delete($Company->Img);
		}
    	$Company->Img=$file_name;
    	$Company->save();

    	return redirect()->route('getCompany');
    }
    public function postCompanyLogo(CompanyLogoRequest $request)
    {
    	$Company = Company::find($request->id);
		    $image = $request->file('Logo');
            $file_name = 'Upload/company/'.time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->fit(250, 133)->save($file_name,100);
		if ($Company->Logo !='') {
			File::delete($Company->Logo);
		}
    	$Company->Logo=$file_name;
    	$Company->save();

    	return redirect()->route('getCompany');
    }
}
