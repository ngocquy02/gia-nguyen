<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CartRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Requests\PasswordMailRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\AddCartRequest;

use App\Models\Company;
use App\Models\Online;
use App\Models\Category;
use App\Models\Product;
use App\Models\Article;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\ProductCart;
use App\Models\Account;
use App\Models\Password_Change;
use Mail;
use Socialite;
use DateTime;
class PublicController extends Controller
{
    // Đến trang chính
    public function getIndex()
    {
    	$company=Company::where('Locale','vi-vn')->first();
    	$header['title']=$company->MetaTitle;
	    $header['description']=$company->MetaDescription;
	    $header['keywords']=$company->MetaKeyword;
	    $header['image']=$company->Logo;
	    $check=Category::where(['IsActive' => 1])->get();
	    // $CatId = [];
	    // $Cats_Lv1 = Category::where(['IsActive'=>1,'Level' => 1])->orderBy('created_at','desc')->get();
	    // $i =0;
	    // foreach ($Cats_Lv1 as $Cat_Lv1 ) {
	    // 	$CatId[$i] = array_prepend($CatId,$Cat_Lv1->id);
	    // 	// $CatName[$i] = $Cat_Lv1->Name;
	    // 	$CatIdslv1[$i] = $Cat_Lv1->id;
	    // 	$Cats_Lv2 = Category::where(['IsActive'=>1,'Level' => 2,'ParentID' => $Cat_Lv1->id])->orderBy('created_at','desc')->get();
	    // 	foreach ($Cats_Lv2 as $Cat_Lv2) {
	    // 		$CatId[$i] = array_prepend($CatId[$i],$Cat_Lv2->id);
	    // 	}
	    // 	$i++;
	    // }

	    // dd($CatId);die;
    	return view('index',['company'=>$company,'root'=>'','header'=>$header]);
    }
    // Kiểm tra danh mục Level 0
    public function getRoot($root)
    {
    	$company=Company::where('Locale','vi-vn')->first();
    	$check=Category::where([['IsActive','=',1],['Alias','=',$root]])->first();
    	if($check){
	    	$header['title']=($check->MetaTitle=='') ? $company->MetaTitle : $check->MetaTitle;
		    $header['description']=($check->MetaDescription=='')? $company->MetaDescription : $check->MetaDescription;
		    $header['keywords']=($check->MetaKeyword=='') ? $company->MetaKeyword : $check->MetaKeyword;
		    $header['image']=($check->Img=='') ? $company->Logo : 'Upload/category/'.$check->Img;
	    	switch ($check->Type) {
	    		case '1':
	    			return view('index',['company'=>$company,'root'=> $root,'header'=>$header]);
	    			break;
	    		case '2':
	    			return view('contact',['company'=>$company,'root'=> $root,'header'=>$header]); 
	    			break;
	    		case '3':
	    			$listCatId=array($check->id);
	    			$listCate=Category::select('id')->where([['IsActive','=',1],['ParentID','=',$check->id]])->get();
	    			if($listCate->count() > 0)
	    			{
	    				foreach ($listCate as $key) {
	    					$listCatId=array_prepend($listCatId, $key->id);
		    				$listCateChildren=Category::select('id')->where([['IsActive','=',1],['ParentID','=',$key->id]])->get();
		    					if($listCateChildren->count() > 0)
	    						{
			    					foreach ($listCateChildren as $keyChild) {
				    					$listCatId=array_prepend($listCatId, $keyChild->id);
					    			}
					    		}
		    			}
	    			}
	    			$items=Product::whereIn('CatId',$listCatId)->orderBy('created_at','desc')->paginate(16);
	    			// dd($root);die;
	    			// dd($items);die;
	    			return view('products',['company'=>$company,'root'=> $root,'header'=>$header,'items'=>$items,'RootName'=>$check->Name]);
	    			break;
	    		case '4':
	    			$listCatId=array($check->id);
	    			$listCate=Category::select('id')->where([['IsActive','=',1],['ParentID','=',$check->id]])->get();
	    			if($listCate->count() > 0)
	    			{
	    				foreach ($listCate as $key) {
	    					$listCatId=array_prepend($listCatId, $key->id);
		    				$listCateChildren=Category::select('id')->where([['IsActive','=',1],['ParentID','=',$key->id]])->get();
		    					if($listCateChildren->count() > 0)
	    						{
			    					foreach ($listCateChildren as $keyChild) {
				    					$listCatId=array_prepend($listCatId, $keyChild->id);
					    			}
					    		}
		    			}
	    			}
	    			$count_article = Article::all();
	    			// dd($count_article);die;
	    			$items=Article::whereIn('CatId',$listCatId)->orderBy('id','desc')->paginate(12);
	    			return view('news',['company'=>$company,'root'=> $root,'header'=>$header,'items'=>$items,'RootName'=>$check->Name,'count_article' => $count_article]);
	    			break;
	    		case '5':
	    			$item=Article::where('CatId',$check->id)->first();
	    			return view('about',['company'=>$company,'item'=>$item,'root'=> $root,'header'=>$header,'RootName'=>$check->Name,]);
	    			break;
	    	}
    	}
    	else
    	{
    		$header['title']='404 Không tìm thấy trang | '.$company->MetaTitle;
		    $header['description']='404 Không tìm thấy trang | '.$company->MetaDescription;
		    $header['keywords']=$company->MetaKeyword;
		    $header['image']=$company->Logo;
	    	return view('layouts.404',['company'=>$company,'root'=>'','header'=>$header]);
    	}
    }
    // Kiểm tra danh mục Level 1
    public function getParent($root,$parent)
    {
    	// echo $parent;die;

    	$company=Company::where('Locale','vi-vn')->first();
    	$checkRoot=Category::where([['IsActive','=',1],['Alias','=',$root]])->first();
    	$checkParent=Category::where([['IsActive','=',1],['Alias','=',$parent]])->first();
    	if($checkRoot && $checkParent && $checkParent->ParentID == $checkRoot->id){
	    	$header['title']=($checkParent->MetaTitle=='') ? $company->MetaTitle : $checkParent->MetaTitle;
		    $header['description']=($checkParent->MetaDescription=='')? $company->MetaDescription : $checkParent->MetaDescription;
		    $header['keywords']=($checkParent->MetaKeyword=='') ? $company->MetaKeyword : $checkParent->MetaKeyword;
		    $header['image']=($checkParent->Img=='') ? $company->Logo : 'Upload/category/'.$checkParent->Img;
	    	switch ($checkParent->Type) {
	    		case '3':
	    			$listCatId=array($checkParent->id);
	    			$listCate=Category::select('id')->where([['IsActive','=',1],['ParentID','=',$checkParent->id]])->get();
	    			if($listCate->count() > 0)
	    			{
	    				foreach ($listCate as $key) {
	    					$listCatId=array_prepend($listCatId, $key->id);
		    			}
	    			}
	    			$items=Product::whereIn('CatId',$listCatId)->orderBy('created_at','desc')->paginate(16);
	    			return view('products',['company'=>$company,'root'=> $root,'header'=>$header,'items'=>$items,'RootName'=>$checkParent->Name]);
	    			break;
	    		case '4':
	    			$listCatId=array($checkParent->id);
	    			$listCate=Category::select('id')->where([['IsActive','=',1],['ParentID','=',$checkParent->id]])->get();
	    			if($listCate->count() > 0)
	    			{
	    				foreach ($listCate as $key) {
	    					$listCatId=array_prepend($listCatId, $key->id);
		    			}
	    			}
	    			$items=Article::whereIn('CatId',$listCatId)->orderBy('created_at','desc')->paginate(6);
	    			return view('news',['company'=>$company,'root'=> $root,'header'=>$header,'items'=>$items,'RootName'=>$checkRoot->Name,'checkParent'=>$checkParent->Name]);
	    			break;
	    	}
    	}
    	else
    	{
    		$header['title']='404 Không tìm thấy trang | '.$company->MetaTitle;
		    $header['description']='404 Không tìm thấy trang | '.$company->MetaDescription;
		    $header['keywords']=$company->MetaKeyword;
		    $header['image']=$company->Logo;
	    	return view('layouts.404',['company'=>$company,'root'=>'','header'=>$header]);
    	}
    }
    // Kiểm tra danh mục Level 2
    public function getChild($root,$parent,$child)
    {	
    	$company=Company::where('Locale','vi-vn')->first();
    	$checkRoot=Category::where([['IsActive','=',1],['Alias','=',$root]])->first();
    	$checkParent=Category::where([['IsActive','=',1],['Alias','=',$parent]])->first();
    	$checkChild=Category::where([['IsActive','=',1],['Alias','=',$child]])->first();
    	if($checkRoot && $checkParent && $checkChild && $checkChild->ParentID==$checkParent->id && $checkParent->ParentID==$checkRoot->id){
	    	$header['title']=($checkChild->MetaTitle=='') ? $company->MetaTitle : $checkChild->MetaTitle;
		    $header['description']=($checkChild->MetaDescription=='')? $company->MetaDescription : $checkChild->MetaDescription;
		    $header['keywords']=($checkChild->MetaKeyword=='') ? $company->MetaKeyword : $checkChild->MetaKeyword;
		    $header['image']=($checkChild->Img=='') ? $company->Logo : 'Upload/category/'.$checkChild->Img;
	    	switch ($checkChild->Type) {
	    		case '3':
	    			$items=Product::where('CatId',$checkChild->id)->orderBy('created_at','desc')->paginate(16);
	    			return view('products',['company'=>$company,'root'=> $root,'header'=>$header,'items'=>$items,'RootName'=>$checkRoot->Name,'checkParent' => $checkParent->Name,'checkChild'=>$checkChild->name]);
	    			break;
	    		case '4':
	    			$items=Article::where('CatId',$checkChild->id)->orderBy('created_at','desc')->paginate(12);
	    			return view('news',['company'=>$company,'root'=> $root,'header'=>$header,'items'=>$items,'RootName'=>$checkRoot->Name,'checkParent' =>$checkParent->Name,'checkChild'=>$checkChild->Name]);
	    			break;
	    	}
    	}
    	else
    	{
    		$header['title']='404 Không tìm thấy trang | '.$company->MetaTitle;
		    $header['description']='404 Không tìm thấy trang | '.$company->MetaDescription;
		    $header['keywords']=$company->MetaKeyword;
		    $header['image']=$company->Logo;
	    	return view('layouts.404',['company'=>$company,'root'=>'','header'=>$header]);
    	}
    }
    // Kiểm tra danh mục Level 0 (Trang chi tiết)
    public function getRootDetail($root,$detail)
    {
    	$company=Company::where('Locale','vi-vn')->first();
    	$check=Category::where([['IsActive','=',1],['Alias','=',$root]])->first();
    	if($check ){
	    	switch ($check->Type) {
	    		case '1':
	    		case '2':
	    		case '4':
	    		case '5':
			    	$item=Article::where([['IsActive','=',1],['Alias','=',$detail]])->first();
			    	if($item && $item->CatId==$check->id)
			    	{
				    	$header['title']=($item->MetaTitle=='') ? $company->MetaTitle : $item->MetaTitle;
					    $header['description']=($item->MetaDescription=='')? $company->MetaDescription : $item->MetaDescription;
					    $header['keywords']=($item->MetaKeyword=='') ? $company->MetaKeyword : $item->MetaKeyword;
					    $header['image']=($item->Img=='') ? $company->Logo : 'Upload/article/'.$item->Img;
		    			return view('new',['company'=>$company,'root'=> $root,'header'=>$header,'item'=>$item,'check'=>$check]);
			    	}
			    	else
			    	{
			    		$header['title']='Thông tin chưa chính xác |'.$company->MetaTitle;
					    $header['description']='Thông tin chưa chính xác | '.$company->MetaDescription;
					    $header['keywords']=$company->MetaKeyword;
					    $header['image']=$company->Logo;
				    	return view('layouts.error',['company'=>$company,'root'=>'','header'=>$header]);
			    	}	
	    			break;
	    		case '3':
	    			$item=Product::where([['IsActive','=',1],['Alias','=',$detail]])->first();
			    	if($item && $item->CatId==$check->id)
			    	{
				    	$header['title']=($item->MetaTitle=='') ? $company->MetaTitle : $item->MetaTitle;
					    $header['description']=($item->MetaDescription=='')? $company->MetaDescription : $item->MetaDescription;
					    $header['keywords']=($item->MetaKeyword=='') ? $company->MetaKeyword : $item->MetaKeyword;
					    $header['image']=($item->Img=='') ? $company->Logo : 'Upload/article/'.$item->Img;
		    			return view('product',['company'=>$company,'root'=> $root,'header'=>$header,'item'=>$item,'check'=>$check]);
			    	}
			    	else
			    	{
						$header['title']='Thông tin chưa chính xác |'.$company->MetaTitle;
					    $header['description']='Thông tin chưa chính xác | '.$company->MetaDescription;
					    $header['keywords']=$company->MetaKeyword;
					    $header['image']=$company->Logo;
				    	return view('layouts.error',['company'=>$company,'root'=>'','header'=>$header]);
			    	}	
			    	break;
	    	}
    	}
    	else
    	{
    		$header['title']='404 Không tìm thấy trang | '.$company->MetaTitle;
		    $header['description']='404 Không tìm thấy trang | '.$company->MetaDescription;
		    $header['keywords']=$company->MetaKeyword;
		    $header['image']=$company->Logo;
	    	return view('layouts.404',['company'=>$company,'root'=>'','header'=>$header]);
    	}
    }
    // Kiểm tra danh mục Level 1 (Trang chi tiết)
    public function getParentDetail($root,$parent,$detail)
    {
    	$company=Company::where('Locale','vi-vn')->first();
    	$checkRoot=Category::where([['IsActive','=',1],['Alias','=',$root]])->first();
    	$checkParent=Category::where([['IsActive','=',1],['Alias','=',$parent]])->first();
    	if($checkRoot && $checkParent && $checkParent->ParentID == $checkRoot->id){
	    	switch ($checkParent->Type) {
	    		case '3':    			
			    	$item=Product::where([['IsActive','=',1],['Alias','=',$detail]])->first();
			    	if($item && $item->CatId==$checkParent->id)
			    	{
				    	$header['title']=($item->MetaTitle=='') ? $company->MetaTitle : $item->MetaTitle;
					    $header['description']=($item->MetaDescription=='')? $company->MetaDescription : $item->MetaDescription;
					    $header['keywords']=($item->MetaKeyword=='') ? $company->MetaKeyword : $item->MetaKeyword;
					    $header['image']=($item->Img=='') ? $company->Logo : 'Upload/article/'.$item->Img;
		    			return view('product',['company'=>$company,'root'=> $root,'header'=>$header,'item'=>$item,'check'=>$checkRoot,'checkParent'=>$checkParent]);
			    	}
			    	else
			    	{
			    		$header['title']='Thông tin chưa chính xác |'.$company->MetaTitle;
					    $header['description']='Thông tin chưa chính xác | '.$company->MetaDescription;
					    $header['keywords']=$company->MetaKeyword;
					    $header['image']=$company->Logo;
				    	return view('layouts.error',['company'=>$company,'root'=>'','header'=>$header]);
			    	}	
	    			break;
	    		case '4':
	    			$item=Article::where([['IsActive','=',1],['Alias','=',$detail]])->first();
			    	if($item && $item->CatId==$checkParent->id)
			    	{
		    			$header['title']=($checkParent->MetaTitle=='') ? $company->MetaTitle : $checkParent->MetaTitle;
					    $header['description']=($checkParent->MetaDescription=='')? $company->MetaDescription : $checkParent->MetaDescription;
					    $header['keywords']=($checkParent->MetaKeyword=='') ? $company->MetaKeyword : $checkParent->MetaKeyword;
					    $header['image']=($checkParent->Img=='') ? $company->Logo : 'Upload/category/'.$checkParent->Img;
		    			return view('new',['company'=>$company,'root'=> $root,'header'=>$header,'item'=>$item,'check'=>$checkRoot,'checkParent'=>$checkParent]);
	    			}
			    	else
			    	{
			    		$header['title']='Thông tin chưa chính xác |'.$company->MetaTitle;
					    $header['description']='Thông tin chưa chính xác | '.$company->MetaDescription;
					    $header['keywords']=$company->MetaKeyword;
					    $header['image']=$company->Logo;
				    	return view('layouts.error',['company'=>$company,'root'=>'','header'=>$header]);
			    	}	
	    			break;
	    	}
    	}
    	else
    	{
    		$header['title']='404 Không tìm thấy trang | '.$company->MetaTitle;
		    $header['description']='404 Không tìm thấy trang | '.$company->MetaDescription;
		    $header['keywords']=$company->MetaKeyword;
		    $header['image']=$company->Logo;
	    	return view('layouts.404',['company'=>$company,'root'=>'','header'=>$header]);
    	}
    }
    // Kiểm tra danh mục Level 2 (Trang chi tiết)
    public function getChildDetail($root,$parent,$child,$detail)
    {
    	$company=Company::where('Locale','vi-vn')->first();
    	$checkRoot=Category::where([['IsActive','=',1],['Alias','=',$root]])->first();
    	$checkParent=Category::where([['IsActive','=',1],['Alias','=',$parent]])->first();
    	$checkChild=Category::where([['IsActive','=',1],['Alias','=',$child]])->first();
    	if($checkRoot && $checkParent && $checkChild && $checkChild->ParentID==$checkParent->id && $checkParent->ParentID==$checkRoot->id){
	    	switch ($checkChild->Type) {
	    		case '3':
	    			$item=Product::where([['IsActive','=',1],['Alias','=',$detail]])->first();
	    			// echo $checkChild->id;die;
			    	if($item && $item->CatId==$checkChild->id)
			    	{
				    	$header['title']=($checkChild->MetaTitle=='') ? $company->MetaTitle : $checkChild->MetaTitle;
					    $header['description']=($checkChild->MetaDescription=='')? $company->MetaDescription : $checkChild->MetaDescription;
					    $header['keywords']=($checkChild->MetaKeyword=='') ? $company->MetaKeyword : $checkChild->MetaKeyword;
					    $header['image']=($checkChild->Img=='') ? $company->Logo : 'Upload/category/'.$checkChild->Img;
		    			return view('product',['company'=>$company,'root'=> $root,'header'=>$header,'check'=>$checkRoot,'item'=>$item,'checkParent'=>$checkParent,'checkChild'=>$checkChild]);
	    			}
			    	else
			    	{
			    		$header['title']='Thông tin chưa chính xác |'.$company->MetaTitle;
					    $header['description']='Thông tin chưa chính xác | '.$company->MetaDescription;
					    $header['keywords']=$company->MetaKeyword;
					    $header['image']=$company->Logo;
				    	return view('layouts.error',['company'=>$company,'root'=>'','header'=>$header]);
			    	}	
	    			break;
	    		case '4':
	    			$item= Article::where(['IsActive'=>1,'Alias' =>$detail])->first();
	    			// dd($item);die;
			    	if($item && $item->CatId==$checkChild->id)
			    	{
		    			$header['title']=($checkChild->MetaTitle=='') ? $company->MetaTitle : $checkChild->MetaTitle;
					    $header['description']=($checkChild->MetaDescription=='')? $company->MetaDescription : $checkChild->MetaDescription;
					    $header['keywords']=($checkChild->MetaKeyword=='') ? $company->MetaKeyword : $checkChild->MetaKeyword;
					    $header['image']=($checkChild->Img=='') ? $company->Logo : 'Upload/category/'.$checkChild->Img;
		    			return view('new',['company'=>$company,'root'=> $root,'header'=>$header,'item'=>$item,'check'=>$checkRoot,'checkParent'=>$checkParent,'checkChild'=>$checkChild]);
	    			}
			    	else
			    	{
			    		$header['title']='Thông tin chưa chính xác |'.$company->MetaTitle;
					    $header['description']='Thông tin chưa chính xác | '.$company->MetaDescription;
					    $header['keywords']=$company->MetaKeyword;
					    $header['image']=$company->Logo;
				    	return view('layouts.error',['company'=>$company,'root'=>'','header'=>$header]);
			    	}	
	    			break;
	    	}
    	}
    	else
    	{
    		$header['title']='404 Không tìm thấy trang | '.$company->MetaTitle;
		    $header['description']='404 Không tìm thấy trang | '.$company->MetaDescription;
		    $header['keywords']=$company->MetaKeyword;
		    $header['image']=$company->Logo;
	    	return view('layouts.404',['company'=>$company,'root'=>'','header'=>$header]);
    	}
    }
    //  sản phẩm vào giỏ hàng bằng ajax
    public function postAddCart(AddCartRequest $request)
    {
    	$company=Company::where('Locale','vi-vn')->first();
    	$Emailto=$company->Email;
    	$AddressStart=$request->AddressStart;
	$VehicleType=$request->VehicleType;
	$CatId=Category::Find($VehicleType);
	if ($CatId) {
		$AddressEnd=$request->AddressEnd;
		$Role=$request->Role;
		$IsHome=($request->IsHome==0)?0:1;
		$Weight=($request->Weight>0)? $request->Weight: 0;
		$URL = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".str_slug($AddressStart)."&destinations=".str_slug($AddressEnd)."&key=AIzaSyCdGf9-I3HWvCPgihLZiUSj7b3Iz2jDG9s";
	        $Data = json_decode(file_get_contents($URL));
	        $kc=0;
	        if ($Data->status!='ok')
	        {
	            $kc=$Data->rows[0]->elements[0]->distance->value;
	            $kc= round($kc/1000);
		    	if($kc<=30)
		    	{
		    		$Sale=30;
		    	}
		    	elseif($kc <= 150 and $kc >30)
		    	{
		    		$Sale=150;
		    	}
		    	elseif($kc <= 300 and $kc>150)
		    	{
		    		$Sale=300;
		    	}
		    	else
		    	{
		    		$Sale=301;
		    	}
		    	$listPrice=$CatId->products()->where([
		    		'Sale'=>$Sale,
		    		'IsHot'=>$Role,
		    		'IsHome'=>$IsHome,
		    	])->first();
		    	if($listPrice)
		    	{
		    		$PriceVc=$listPrice->Price;
				    if ($Role==1) {
				    	$price=$kc*$Weight*$PriceVc;
				    }
				    else
				    {
				    	$chieu=($IsHome==0)?1:2;
				    	$price=$kc*$PriceVc*$chieu;
				    }
		    	}
		    	else
		    	{
		    		$price=0;
		    	}
		    	
	        }
	        else
	        {
	            $price=0;
	        }
		    /*end tính giá*/
	    	$idMax=Cart::max('id') +1;
	    	$cart=new Cart;
	    	$cart->CartCode=str_random(6).$idMax;
	    	$cart->Email=$request->Email;
	    	$cart->FullName=$request->FullName;
	    	$cart->Phone=$request->Phone;
	    	$cart->Address=$request->Address;
	    	$cart->Company=$request->Company;
	    	$cart->Role=$request->Role;
	    	$cart->IsHome=$request->IsHome;
	    	$cart->Weight=$request->Weight;
	    	$cart->Price=$price;
	    	$cart->DateStart=$request->DateStart;
	    	$cart->TimeStart=$request->TimeStart;
	    	$cart->AddressStart=$request->AddressStart;
	    	$cart->AddressEnd=$request->AddressEnd;
	    	$cart->VehicleType=$request->VehicleType;
	    	$cart->Note=$request->Note;
	    	$cart->save();
	    	$data = array(
					'FullName'         	=>		$cart->FullName,
					'Weight'     		=>		$cart->Weight,
					'Email'     		=>		$cart->Email,
					'Emailto'     		=>		$Emailto,
					'Phone'     		=>		$cart->Phone,
					'Price'     		=>		$cart->Price,
					'DateStart'     		=>		$cart->DateStart,
					'TimeStart'     		=>		$cart->TimeStart,
					'AddressStart'     		=>		$cart->AddressStart,
					'AddressEnd'     		=>		$cart->AddressEnd,
					'VehicleType'     		=>		$cart->VehicleType,
					'IsHome'     		=>		($cart->IsHome==0) ? '1 Chiều':'2 Chiều',
					'Role'     		=>		($cart->Role==0) ? 'Du lịch':'Vận tải',
	    			);
	    		\Mail::send('account.sendmail', $data, function ($message) use ($data){
	    		    $message->to($data['Email'], $data['FullName']);
	    		    $message->cc($data['Emailto']);
	    		    $message->subject('Thông báo đặt xe');
	    		});
	    	return redirect()->back()->with(['msg'=>'Đơn hàng đang chờ kiểm duyệt, Công ty sẽ liên hệ lại quý khách trong thời gian sớm nhất!']);
	    }
	    else
	    {
	    	return redirect()->back()->with(['msg'=>'Loại xe không tồn tại!']);
	    }
    }
    // Thêm sản phẩm vào giỏ hàng từ trang chi tiết sản phẩm
    public function postAddItemCart(Request $request)
    {
    	$id=$request->id;
    	$qtt=($request->Quantity > 50) ? 50 : $request->Quantity;
    	if(session()->has('cart.'.$id))
    	{	
    		$request->session()->put('cart.'.$id.'.Quantity' , $qtt);
    	}
    	else
    	{	
    		$request->session()->put('cart.'.$id.'.Price', $request->Price);
    		$request->session()->put('cart.'.$id.'.Quantity', $qtt);
    	}
    	return redirect()->route('getCart');
    }
    // update số lượng của giỏ hàng
    public function postUpdateCart(Request $request)
    {
    	foreach (session()->get('cart') as $key => $value) {
    		$request->session()->put('cart.'.$key.'.Quantity' , $request->input($key));
    	}
    	return redirect()->route('getCart');   
    }
    // Lấy giỏ hàng
    public function getCart()
    {
    	$company=Company::where('Locale','vi-vn')->first();
    	$header['title']='Thông tin giỏ hàng - '.$company->MetaTitle;
	    $header['description']='Thông tin giỏ hàng - '.$company->MetaTitle;
	    $header['keywords']=$company->MetaKeyword;
	    $header['image']=$company->Logo;
    	return view('cart',['company'=>$company,'root'=>'','header'=>$header]);
    }
    // Thanh toán
    public function getCheckOut()
    {
    	$company=Company::where('Locale','vi-vn')->first();
    	$header['title']='Thanh toán đơn hàng - '.$company->MetaTitle;
	    $header['description']='Thanh toán đơn hàng - '.$company->MetaTitle;
	    $header['keywords']=$company->MetaKeyword;
	    $header['image']=$company->Logo;
	    if(session()->has('cart'))
	    {
    		return view('checkout',['company'=>$company,'root'=>'','header'=>$header]);
	    }
	    else
	    {
	    	return redirect()->route('getIndex');
	    }
    }
    // Thanh toán
    public function postCreateCart(CartRequest $request)
    {
    	$cart =new Cart;
    	$getCart=$CartCode=Cart::all()->last();
    	$CartCode=(count($getCart)>0)? $getCart->id +1 : 1;
    	$CartCode= rand(10000,99999).$CartCode;
		$cart->Email        =		$request->Email;
		$cart->CartCode     =		$CartCode;
		$cart->FullName     =		$request->FullName;
		$cart->Phone        =		$request->Phone;
		$cart->Address      =		$request->Address;
		$cart->FullNameShip =		($request->FullNameShip=='') ? $request->FullName : $request->FullNameShip;
		$cart->PhoneShip    =		($request->PhoneShip == '')? $request->Phone : $request->PhoneShip;
		$cart->AddressShip  =		($request->AddressShip == '')? $request->Address : $request->AddressShip;
		$cart->Note         =		$request->Note;
		$cart->Locale       =		'vi-vn';
		$cart->save();
		$CartId=$cart->id;
		if(session()->has('cart'))
	    {
    		foreach (session()->get('cart') as $key => $value) {
				$productcart              =		 new ProductCart;
				$productcart->CartId      =		$CartId;
				$productcart->CartCode    =		$CartCode;
				$productcart->ProdId      =		$key;
				$productcart->Name        =		Product::Find($key)->Name;
				$productcart->Quantity    =		$value['Quantity'];
				$productcart->Price       =		$value['Price'];
				$productcart->Locale      =		'vi-vn';
				$productcart->save();
    		}
    		$company=Company::where('Locale','vi-vn')->first();
    		$header['title']=$company->MetaTitle;
		    $header['description']=$company->MetaDescription;
		    $header['keywords']=$company->MetaKeyword;
		    $header['image']=$company->Logo;
    		$data = array(
				'Name'         		=>		$company->Name,
				'Logo'         		=>		asset($company->Logo),
				'Link'         		=>		asset('/'),
				'FullName'     		=>		$cart->FullName,
				'Email'        		=>		$cart->Email,
				'Emailcc'      =>		$company->Email,
				'Phone'        		=>		$cart->Phone,
				'FullNameShip' 		=>		$cart->FullNameShip,
				'PhoneShip'    		=>		$cart->PhoneShip,
				'AddressShip'  		=>		$cart->AddressShip,
				'ProductCart'  		=>       Cart::Find($CartId)->productcart()->get(),
				'time'         		=>       new DateTime(),
    			);
    		Mail::send('mail', $data, function ($message) use ($data){
    		    $message->to($data['Email'], $data['FullName']);
    		    $message->cc($data['Emailcc']);
    		    $message->subject('Thông tin đặt hàng');
    		});
    		session()->forget('cart');
    		return view('layouts.successcart',['company'=>$company,'root'=>'','header'=>$header,'CartCode'=>$CartCode]);
	    }
	    else
	    {
	    	return redirect()->route('getIndex');
	    }
    }
    // Kiểm tra đơn hàng
    public function getOrder($CartCode)
    {
    	if (session()->has('account')) {
    		$item= Cart::where('CartCode',$CartCode)->first();
    		if ($item) {
	    		$company=Company::where('Locale','vi-vn')->first();
				$header['title']       		=	"Thông tin chi tiết về đơn hàng";
				$header['description'] 		=	'Thông tin chi tiết về đơn hàng';
				$header['keywords']    		=	$company->MetaKeyword;
				$header['image']       		=	$company->Logo;
		    	return view('account.order',['company'=>$company,'root'=>'','header'=>$header,'item'=>$item]);
    		}
    		else
    		{
    			$company=Company::where('Locale','vi-vn')->first();
    			$header['title']='Thông tin đơn hàng chưa chính xác |'.$company->MetaTitle;
			    $header['description']='Thông tin đơn hàng chưa chính xác | '.$company->MetaDescription;
			    $header['keywords']=$company->MetaKeyword;
			    $header['image']=$company->Logo;
			    $error='Thông tin đơn hàng chưa chính xác';
		    	return view('layouts.error',['company'=>$company,'root'=>'','header'=>$header,'error'=>$error]);
    		}	
    	}
    	else
    	{
    		return redirect()->route('getLoginAccount');
    	}	
    }
    // Xóa sản phẩm trong giỏ hàng
    public function delItemCart($id)
    {
    	if(session()->has('cart.'.$id))
    	{	
    		session()->forget('cart.'.$id);
    	}
    	return redirect()->route('getCart');    	
    }
    // Liên hệ
    public function postContact(ContactRequest $request)
    {
    	// d;
    	$contact= new Contact;
		$contact->FullName   	=	$request->FullName;
		$contact->Email      	=	$request->Email;
		$contact->Phone      	=	$request->Phone;
		$contact->Content    	=	$request->Content;
		$contact->updated_at 	=	 new DateTime();
		$contact->created_at 	=	 new DateTime();
    	$contact->save();
    	$company=Company::where('Locale','vi-vn')->first();
    	$check=Category::where([['IsActive','=',1],['Type','=',2]])->first();
    	$root=$check->Alias;
    	$header['title']=($check->MetaTitle=='') ? $company->MetaTitle : $check->MetaTitle;
	    $header['description']=($check->MetaDescription=='')? $company->MetaDescription : $check->MetaDescription;
	    $header['keywords']=($check->MetaKeyword=='') ? $company->MetaKeyword : $check->MetaKeyword;
	    $header['image']=($check->Img=='') ? $company->Logo : 'Upload/category/'.$check->Img;
    	return view('contact',['company'=>$company,'root'=> $root,'header'=>$header,'Thankyou'=>'Cảm ơn Quý khách đã góp ý!']);
    }
    // Tìm kiếm sản phẩm
    public function postSeachProduct(Request $request)
    {
    	$items= Product::where([['Name','like',$request->Seach.'%'],['IsActive','=',1]])->paginate(16);
    	$company=Company::where('Locale','vi-vn')->first();
		$header['title']       	=	 'Kết quả tìm kiếm từ khóa '.$request->Seach;
		$header['description'] 	=	'Kết quả tìm kiếm từ khóa '.$request->Seach;
		$header['keywords']    	=	$company->MetaKeyword ;
		$header['image']       	=	$company->Logo;
    	return view('seach',['company'=>$company,'root'=> '','header'=>$header,'Keyword'=>$request->Seach,'items'=>$items]);
    }
    // Get Login Account
    public function getLoginAccount()
    {
    	if(Auth::guard('account')->check())
    	{
    		return redirect()->route('getAccount');
    	}
        else
        {
        	if (Auth::guard('account')->check()) {
                Auth::guard('account')->logout();
            }
	    	$company=Company::where('Locale','vi-vn')->first();
			$header['title']       	=	"Đăng nhập vào hệ thống";
			$header['description'] 	=	'Đăng Nhập vào hệ thống';
			$header['keywords']    	=	$company->MetaKeyword;
			$header['image']       	=	$company->Logo;
	    	return view('account.login',['company'=>$company,'root'=>'','header'=>$header]);        	
        }
    }
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        if ($checkUser=Account::where(['ProviderId' => $user->id,'Provider' => 'Facebook'])->first()) 
    	{
    		Auth::guard('account')->loginUsingId($checkUser->id);
        	return redirect()->route('getAccount');
        }
        else
        {
			$account             	=		new Account;
			$account->FullName   	=		$user->name;
			$account->Email      	=		$user->email;
			$account->Password   	=		bcrypt('123456a');
			$account->ProviderId 	=		$user->id;
			$account->Provider   	=		'Facebook';
	    	$account->save();
	    	Auth::guard('account')->loginUsingId($account->id);
	    	return redirect()->route('getAccount');
        }
    }
	/**
     * Redirect the user to the GitHub authentication page.
     *Login By Google
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
    	if ($checkUser=Account::where(['ProviderId' => $user->id,'Provider' => 'Google'])->first()) 
    	{
    		Auth::guard('account')->loginUsingId($checkUser->id);
        	return redirect()->route('getAccount');
        }
        else
        {
			$account             	=		new Account;
			$account->FullName   	=		$user->name;
			$account->Email      	=		$user->email;
			$account->Password   	=		bcrypt('123456a');
			$account->ProviderId 	=		$user->id;
			$account->Provider   	=		'Google';
	    	$account->save();
	    	Auth::guard('account')->loginUsingId($account->id);
	    	return redirect()->route('getAccount');
        }
    }
/*        post Login Account*/
    public function postLoginAccount(LoginRequest $request)
    {
    	if (Auth::guard('account')->attempt(['Email' => $request->Email, 'Password' => $request->Password, 'Provider' => 'Register'])) 
    	{
    		return redirect()->route('getAccount');
		}
    	else
    	{
    		$company=Company::where('Locale','vi-vn')->first();
			$header['title']       		=	"Đăng nhập vào hệ thống";
			$header['description'] 		=	'Đăng Nhập vào hệ thống';
			$header['keywords']    		=	$company->MetaKeyword;
			$header['image']       		=	$company->Logo;
			$msgLogin              		=	'Tên đăng nhập hoặc mật khẩu không chính xác';
	    	return view('account.login',['company'=>$company,'root'=>'','header'=>$header,'msgLogin'=>$msgLogin]);
    	}
    }
    // Get Register Account
    public function getRegisterAccount()
    {
    	$company=Company::where('Locale','vi-vn')->first();
		$header['title']       		=	"Đăng ký thành viên";
		$header['description'] 		=	'Đăng ký thành viên để nhận được nhiều ưu đãi';
		$header['keywords']    		=	$company->MetaKeyword;
		$header['image']       		=	$company->Logo;
    	return view('account.register',['company'=>$company,'root'=>'','header'=>$header]);
    }
    // Post Register Account
    public function postRegisterAccount(RegisterRequest $request)
    {
		$account=Account::Create([
		'FullName' 		=>	$request->FullName,
		'Email'			=>	$request->Email,
		'Password' 		=>	bcrypt($request->Password),
		'Phone'    		=>	$request->Phone,
		'Provider'   	=>	'Register',
		'Address'  		=>	$request->Address,
		]);
    	Auth::guard('account')->loginUsingId($account->id);
    	return redirect()->route('getIndex'); 
    }
    // Get Logout Account
    public function getLogout()
    {
    	Auth::guard('account')->logout();
    	return redirect()->route('getIndex');    
    }
    // Get Account
    public function getAccount()
    {
    	if (Auth::guard('account')->check()) {
    		$company=Company::where('Locale','vi-vn')->first();
			$header['title']       		=	"Thông tin tài khoản";
			$header['description'] 		=	'Thông tin tài khoản và đơn hàng';
			$header['keywords']    		=	$company->MetaKeyword;
			$header['image']       		=	$company->Logo;
	    	return view('account.index',['company'=>$company,'root'=>'','header'=>$header]);
    	}
    	else
    	{
    		return redirect()->route('getLoginAccount');
    	}	
    }
    // Thông tin tài khoản
    public function getUpdateAccount()
    {
    	if (Auth::guard('account')->check()) {
    		$company=Company::where('Locale','vi-vn')->first();
			$header['title']       		=	"Thay đổi thông tin tài khoản";
			$header['description'] 		=	'Thay đổi thông tin tài khoản';
			$header['keywords']    		=	$company->MetaKeyword;
			$header['image']       		=	$company->Logo;
			$item=Auth::guard('account')->user();
	    	return view('account.updateaccount',['company'=>$company,'root'=>'','header'=>$header,'item'=>$item]);
    	}
    	else
    	{
    		return redirect()->route('getLoginAccount');
    	}	
    }
    // Update thông tin tài khoản
    public function postUpdateAccount(UpdateAccountRequest $request)
    {
    	$account           		=	Account::Find(Auth::guard('account')->id());
    	if ($account) {
	    	$checkEmail=Account::where([['Email','=',$request->Email]])->count();
	    	if ($checkEmail > 0 and $request->Email!=Auth::guard('account')->user()->Email) {
	    		return redirect()->back()->with(['msg'=>'Email đã tồn tại']);
	    	}
	    	else
	    	{
				$account->FullName 		=	$request->FullName;
				$account->Email 		=	$request->Email;
				$account->Phone    		=	$request->Phone;
				$account->Address  		=	$request->Address;
		    	$account->save();
		    	return redirect()->route('getAccount')->with(['msg'=>'Cập nhật thành công!']);
    		}
    	} 
    	else {
    		return redirect()->back()->with(['msg'=>'Thông tin không chính xác!']);
    	}
    }
    // Gửi mail xác nhận thay đổi mật khẩu
    public function sendResetLinkEmail(PasswordMailRequest $request)
    {
    	$Email= $request->Email;
    	$account=Account::where('Email',$Email)->first();
    	if ($account) {
    		$company=Company::where('Locale','vi-vn')->first();
    		$Token=str_random(60);
	        $data = array(
				'NameCompany'  =>		$company->Name,
				'Email'		   =>		$Email,
				'LinkCompany'  =>		asset('/'),
				'FullName'     =>		$account->FullName,
				'Token'        =>		$Token
				);
			\Mail::send('account.password', $data, function ($message) use ($data){
			    $message->to($data['Email'], $data['FullName']);
			    $message->subject('Xác nhận thông tin thay đổi mật khẩu');
			});
			if (Mail::failures()) {
                return redirect()->back()->with(['status'=>'Gửi thất bại! Vui lòng thử lại!']);
            }
			$password=Password_Change::where('Email',$Email)->first();
			if ($password) 
			{
				$updateToken=Password_Change::Find($password->id);
				$updateToken->Token=$Token;
				$updateToken->save();
			}
			else
			{
				$insertPassword             	=	 new Password_Change;
				$insertPassword->Email      	=	$Email;
				$insertPassword->Type      		=	1;
				$insertPassword->Token      	=	$Token;
				$insertPassword->created_at 	=	new DateTime();
				$insertPassword->save();
			} 
			$status='Vui lòng kiểm tra Mail để lấy lại mật khẩu!';
	    	return redirect()->back()->with(['status'=>$status]);		
    	}
    	else
    	{
		    $status='Email chưa đăng ký tài khoản!';
	    	return redirect()->back()->with(['status'=>$status]);
    	}
    }
    // Xác nhận thông tin đổi mật khẩu
    Public function getPasswordResetAccount($token,$email)
    {
    	$checkToken=Password_Change::where([
    									['Email' , '=' , $email],
    									['Type' , '=' , 1],
    									['Token' , '=' , $token]
    									])->first();
    	if($checkToken)
    	{
    		$company=Company::where('Locale','vi-vn')->first();
			$header['title']       		=	'Thay đổi mật khẩu cho '.$email;
			$header['description'] 		=	'Cập nhật mật khẩu mới cho '.$email;
			$header['keywords']    		=	$company->MetaKeyword;
			$header['image']       		=	$company->Logo;
    		return view('account.changepassword',['company'=>$company,'root'=>'','header'=>$header,'Email'=>$email,'Token'=>$token]);
    	}
    	else
    	{
    		$company=Company::where('Locale','vi-vn')->first();
    		$header['title']='Thông tin chưa chính xác |'.$company->MetaTitle;
		    $header['description']='Thông tin chưa chính xác | '.$company->MetaDescription;
		    $header['keywords']=$company->MetaKeyword;
		    $header['image']=$company->Logo;
	    	$error='Thông tin chưa chính xác';
		    	return view('layouts.error',['company'=>$company,'root'=>'','header'=>$header,'error'=>$error]);
    	}
    }
    // Lưu thay đổi mật khẩu
    public function postPasswordReset(PasswordResetRequest $request)
    {
		$Email           =		$request->Email;
		$Token           =		$request->Token;
		$Password        =		$request->Password;
		$PasswordConfirm =		$request->PasswordConfirm;
		// kiểm tra có trong yêu cầu thay đổi mật khẩu không
		$checkToken=Password_Change::where([
    									['Email' , '=' , $Email],
    									['Token' , '=' , $Token]
    									])->first();
    	if($checkToken)
    	{
			$checkAccount             	=	Account::select('id')->where('Email',$Email)->first();
			$idAccount                	=	$checkAccount->id;
			$PasswordChange           	=	Account::Find($idAccount);
			$PasswordChange->Password 	=	bcrypt($Password);
			$PasswordChange->save();
			$Status                   	=	'Thay đổi mật khẩu thành công!';
    		return redirect()->back()->with(['status'=>$Status]);
    	}
    	else
    	{
		    $Status='Tài khoản không yêu cầu thay đổi mật khẩu!';
    		return redirect()->back()->with(['status'=>$Status]);
    	}
    }
    public function postcheckKm(Request $request)
	{
		if($request->ajax())
		{
			$AddressStart=$request->AddressStart;
			$AddressEnd=$request->AddressEnd;
			$Role=$request->Role;
			$IsHome=($request->IsHome==0)?0:1;
			$Weight=($request->Weight>0)? $request->Weight: 0;
			$VehicleType=$request->VehicleType;
			$CatId=Category::Find($VehicleType);
			if ($CatId) {
				$URL = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".str_slug($AddressStart)."&destinations=".str_slug($AddressEnd)."&key=AIzaSyCdGf9-I3HWvCPgihLZiUSj7b3Iz2jDG9s";
			        $Data = json_decode(file_get_contents($URL));
			        $kc=0;
			        if ($Data->status!='ok')
			        {
			            $kc=$Data->rows[0]->elements[0]->distance->value;
			            $kc= $kc/1000;
			        }
			        else
			        {
			            return 'Không nhận dạng được địa chỉ';
			        }
			    	if($kc<=30)
			    	{
			    		$Sale=30;
			    	}
			    	elseif($kc <= 150 and $kc> 30)
			    	{
			    		$Sale=150;
			    	}
			    	elseif($kc > 150 and $kc <=300)
			    	{
			    		$Sale=300;
			    	}
			    	else
			    	{
			    		$Sale=301;
			    	}
			    	$listPrice=$CatId->products()->where([
			    		'Sale'=>$Sale,
			    		'IsHot'=>$Role,
			    		'IsHome'=>$IsHome,
			    	])->first();
			    	if($listPrice)
			    	{
			    		$PriceVc=$listPrice->Price;
			    	}
			    	else
			    	{
			    		return 'Bảng giá đang cập nhật';
			    	}
			    	
			    	$PriceVc=($listPrice) ? $listPrice->Price : 0;
			    if ($Role==1) {
			    	$price=number_format($kc*$Weight*$PriceVc,0,',','.');
			    	return 'Giá tạm tính là : '.$price;
			    }
			    else
			    {
			    	$chieu=($IsHome==0)?1:2;
			    	$price=number_format($kc*$PriceVc*$chieu,0,',','.');
			    	return 'Giá tạm tính là : '.$price;
			    }
			}
			else
			{
				return 'Dữ liệu không chính xác';
			}
		}
		else
		{
			return 'Không được phép truy cập';
		}
	}
}
