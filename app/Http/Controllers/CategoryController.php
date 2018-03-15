<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use Illuminate\Database\Query\Builder;
use File;
use DateTime;
use DB;
use Image;

class CategoryController extends Controller
{
	// Danh sách danh mục
    public function getCategorys()
    {
        $items=Category::select('id','Name','ParentID','Level','Type','Idx','IsActive')->orderBy('Idx', 'asc')->get()->toArray();
    	return view('control.category.index',compact('items'));
    }
    // Thêm danh mục
    public function getAddCategoryProduct($ParentId)
    {
    	if ($ParentId==0) {
    		$Level=0;
    		return view('control.category.category',compact('ParentId'))->with(['Type'=>3,'Level'=>$Level]);
    	}
    	else
    	{
            $category=Category::find($ParentId);
    		$category2=Category::All();
    		if (count($category2)>0) {
    			$Level=$category->Level + 1;
    			return view('control.category.category',compact('ParentId'))->with(['Type'=>3,'Level'=>$Level]);
    		}
    		else
    		{
    			$route='getCategorys';
                $msg='Thông tin Danh mục cha chưa chính xác!!!';
                return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin danh mục cha chưa đúng']);
    		}
    	}
    }
    public function getAddCategoryArticle($ParentId)
    {
    	if ($ParentId==0) {
    		$Level=0;
    		return view('control.category.category',compact('ParentId'))->with(['Type'=>4,'Level']);
    	}
    	else
    	{
    		$category=Category::find($ParentId);
            $category2 = Category::all();
    		if (count($category2)>0) {
    			$Level=$category->Level + 1;
    			return view('control.category.category',compact('ParentId'))->with(['Type'=>4,'Level'=>$Level]);
    		}
    		else
    		{
    			$route='getCategorys';
                $msg='Thông tin Danh mục cha chưa chính xác!!!';
                return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin danh mục cha chưa đúng']);
    		}
    	}
    }
    /*--------------------------Thêm danh mục loại Trang chủ--------------------------*/
    public function getAddHomeCategory()
    {
    	$home=Category::where('Type',1)->get();
    	if (count($home)>0) {
    		// alert("Đã có loại trang chủ");
    		$route='getCategorys';
            $msg='Đã tồn tại danh mục trang chủ!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Danh mục trang chủ chỉ được tạo 1 lần']);
    	}
    	else
    	{
	    	$ParentId=0;
	    	$Type=1;
	    	return view('control.category.category',compact('ParentId'))->with('Type', 1);
    	}

    }
    /*-------------------------Thêm danh mục loại Liên hệ--------------------------*/
    public function getAddContactCategory()
    {
    	$contact=Category::where('Type',2)->get();
    	if (count($contact)>0) {
    		$route='getCategorys';
            $msg='Đã tồn tại danh mục Liên hệ!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Danh mục liên hệ chỉ được tạo 1 lần']);
    	}
    	else
    	{
	    	$ParentId=0;
	    	return view('control.category.category',compact('ParentId'))->with('Type', 2);
    	}
    }
    /*------------------------Thêm danh mục loại About Type==5------------------------*/
    public function getAddAboutCategory()
    {
        $contact=Category::where('Type',5)->get();
        if (count($contact)>0) {
            $route='getCategorys';
            $msg='Đã tồn tại danh mục Giới Thiệu!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Danh mục giới thiệu chỉ được tạo 1 lần']);
        }
        else
        {
            $ParentId=0;
            return view('control.category.category',compact('ParentId'))->with('Type', 5);
        }
    }
    /*-------------------------Lưu sắp xếp danh mục--------------------------*/
    public function postIdxCategory(Request $request)
    {
        if ($request->ajax()) {
	        $dataArray=explode ('(;)',$request->data_lv);
	        foreach ($dataArray as $key) {
	        	$dataArray1=explode ('(,)' ,$key);
		        $category =Category::find($dataArray1[1]);
		        $category->Idx        	   =     $dataArray1[0];
		        $category->updated_at      =     new DateTime();
		        $category->save();
	        }
	        return 'Cập nhật thành công';
        }
    }
    /*---------------------------Active danh mục------------------------------*/
    public function postActiveCategory(Request $request)
    {
        if ($request->ajax()) {
	        $category =Category::find($request->id);
	        $IsActive=($category->IsActive==1)? 0 : 1;
	        $category->IsActive        	   =     $IsActive;
	        $category->updated_at      =     new DateTime();
	        $category->save();
	        return ($IsActive==1)?'on':'off';
        }
    }
    /*---------------------------Thêm danh mục--------------------------------*/
    public function postAddCategory(AddCategoryRequest $request)
    {
    	$category =new Category;
        $IdxMax= (count(Category::all()) + 1);
        // Upload hình ảnh
        if ($request->file('Icon')) {
           /* $file_name=time().'-'.$request->file('Icon')->getClientOriginalName();            
            $request -> file('Icon') -> move('Upload/category/icon/',$file_name);*/

            $image = $request->file('Icon');
            $file_name = 'Upload/category/icon/'.time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->fit(32, 32)->save($file_name,100);

            $category->Icon             =     $file_name;
        }
        else{$category->Icon            =     '';}
        if ($request->file('Img')) {
            $image = $request->file('Img');
            $file_name ='Upload/category/images/'. time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->fit(100, 100)->save($file_name,100);
            /*
            $file_name=time().'-'.$request->file('Img')->getClientOriginalName();
            $request -> file('Img') -> move('Upload/category/images/',$file_name);*/
            $category->Img             =     $file_name;
        }
        else{$category->Img            =     '';}
        if ($request->file('Banner')) {
            /*$file_name=time().'-'.$request->file('Banner')->getClientOriginalName();
            $request -> file('Banner') -> move('Upload/category/banner/',$file_name);*/
            $image = $request->file('Banner');
            $file_name = 'Upload/category/banner/'.time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->fit(1336, 500)->save($file_name,100);
            $category->Banner             =     $file_name;
        }
        else{$category->Banner            =     '';}
        $category->Name            =     $request->Name; 
        $category->Alias           =     str_slug($request->Alias);
        $category->Type			   =     $request->Type;
        $category->Description	   =     $request->Description;
        $category->Level		   =     $request->Level;
        $category->ParentID        =     $request->ParentID;
        $category->IsActive        =     ($request->IsActive == 'on') ? 1 : 0;
        $category->Idx             =     $IdxMax;
        $category->Locale          =     'vi';
        $category->MetaTitle       =     $request->MetaTitle;
        $category->MetaDescription =     $request->MetaDescription;
        $category->MetaKeyword     =     $request->MetaKeyword;
        $category->created_at      =     new DateTime();
        $category->updated_at      =     new DateTime();

        $category->save();
        return redirect()->route('getCategorys');
    }
    /*----------------------------Sửa danh mục--------------------------*/
    public function getCategory($id)
    {
    	$item=Category::Find($id);
        $item2 = Category::all();
    	if (count($item2)>0) {
    		return view('control.category.category',compact('item'))->with(['Level'=>$item->Level]);
    	}
    	else
    	{
    		$route='getCategorys';
            $msg='Thông tin Danh mục chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin danh mục chưa chính xác']);
    	}
    }
    public function postEditCategory(AddCategoryRequest $request)
    {
    	$category =Category::Find($request->id);
    	if ($request->file('Icon')) {
            $image = $request->file('Icon');
            $file_name = 'Upload/category/icon/'.time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->resize(32, 32, function ($constraint) {
                $constraint->aspectRatio();
            })->save($file_name,100);
            // Xóa file cũ
           if ($category->Icon !='') {
            File::delete($category->Icon);
            }
            $category->Icon        =     $file_name;
        }
        if ($request->file('Img')) {
			$image = $request->file('Img');
            $file_name = 'Upload/category/images/'.time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($file_name,100);
            // Xóa file cũ
           if ($category->Img !='') {
            File::delete($category->Img);
            }
            $category->Img         =     $file_name;
        }
        if ($request->file('Banner')) {
            $image = $request->file('Banner');
            $file_name = 'Upload/category/banner/'.time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->resize(1336, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($file_name,100);
            // Xóa file cũ
           if ($category->Banner !='') {
            File::delete($category->Banner);
            }
            $category->Banner      =     $file_name;
        }
        $category->Name            =     $request->Name; 
        $category->Alias           =     str_slug($request->Alias);
        $category->Description	   =     $request->Description;
        $category->IsActive        =     ($request->IsActive == 'on') ? 1 : 0;
        $category->MetaTitle       =     $request->MetaTitle;
        $category->MetaDescription =     $request->MetaDescription;
        $category->MetaKeyword     =     $request->MetaKeyword;
        $category->updated_at      =     new DateTime();
        /*----------update-------------*/
        $category->save();
        return redirect()->route('getCategorys');
    }
    /*--------------------------------Xóa danh mục--------------------------*/
    public function postCategoryDel(Request $request)
    {
    	$count=Category::where('ParentID',$request->id)->count();
    	if ($count==0) {
	        $products=Category::Find($request->id)->products()->get();
	        if (count($products)>0) {
	            foreach ($products as $product) {
	            	$images=Product::Find($product->id)->get();
			        if ($images) {
			            foreach ($images as $image) {
			                if (File::exists('Upload/product/images/'.$image->Img)) {
			                    File::delete('Upload/product/images/'.$image->Img);
			                }
			            }
			        }
	                if (File::exists('Upload/product/'.$product->Img)) {
	                    File::delete('Upload/product/'.$product->Img);
	                }
	            }
	        }
	        $category=Category::Find($request->id);
	        if (File::exists('Upload/category/'.$category->Img)) {
	            File::delete('Upload/category/'.$category->Img);
	        }
	        $category->delete();
	        return redirect()->route('getCategorys');
    	}
    	else
    	{
    		$route='getCategorys';
    		$msg='Không thể xóa danh mục đang chứa danh mục con!!!';
    		return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Không xóa được Danh mục']);
    	}
    }
    /*---------------------------------Kiểm tra Name và Alias---------------------------------*/
    public function postCheckNameAdd(Request $request)
    {
        $Name=$request->Name;
        $ParentID=$request->ParentID;
        $alias=str_slug($Name);
        $kt=Category::where([
                            ['Name', '=', $Name],
                            ['ParentID', '=', $ParentID],
                        ])
                ->get();
        if (count($kt)>0) {
            return 'Tên danh mục đã tồn tại';
        }
        else
        {
            return $alias;
        }
    }
    public function postCheckAliasAdd(Request $request)
    {
        $Name=$request->Alias;
        $ParentID=$request->ParentID;
        $Alias=str_slug($Name);
        if($Alias==$request->Alias){
            $kt=Category::where([
                            ['Alias', '=', $Name],
                            ['ParentID', '=', $ParentID],
                        ])
                ->get();
            if (count($kt)>0) {
                return 'Alias đã tồn tại';
            }
            else
            {
                return 'ok';
            }
        }
        else
        {
            return 'Alias không sử dụng tiếng việt có dấu và mỗi từ cách nhau bằng dấu -';
        }    
    }
    public function postCheckNameEdit(Request $request)
    {
        $Name=$request->Name;
        $id=$request->id;
        $alias=str_slug($Name);
        $kt=Category::where([
                        ['id', '<>', $id],
                        ['Alias', '=', $alias],
                    ])->get();
        if (count($kt)>0) {
            return 'Tên danh mục đã tồn tại';
        }
        else
        {
            return $alias;
        }
    }
    public function postCheckAliasEdit(Request $request)
    {
        $Name=$request->Alias;
        $id=$request->id;
        $alias=str_slug($Name);
        if ($alias==$request->Alias) {
            $kt=Category::where([
                            ['id', '<>', $id],
                            ['Alias', '=', $alias],
                        ])->get();
            if (count($kt)>0) {
                return 'Alias đã tồn tại';
            }
            else
            {
                return 'ok';
            }
        }
        else
        {
            return 'Alias không sử dụng tiếng việt có dấu và mỗi từ cách nhau bằng dấu -';
        }
    }
}
