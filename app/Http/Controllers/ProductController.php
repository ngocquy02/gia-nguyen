<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\EditProductRequest;
use Illuminate\Database\Query\Builder;
use File;
use DateTime;
use DB;
use Image;

class ProductController extends Controller
{
    public function getProducts()
    {
        $items=Product::all();
        return view('control/products/index',compact('items'));
    }
    public function getProductsByCatId($CatId)
    {
        $items=Category::find($CatId)->products()->orderBy('created_at','desc')->paginate(20);
        return view('control/products/index',compact('items'))->with('CatId', $CatId);
    }
    public function getAddProduct($CatId)
    {   
        $item = Category::where([
                            ['id', '=', $CatId],
                            ['Type', '=', 3],
                        ])
                ->first();
        if($item){            
            return view('control/products/product',compact('CatId'));
        }
        else
        {
            $route='getCategorys';
            $msg='Thông tin danh mục của sản phẩm chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin danh mục của sản phẩm chưa chính xác']);
        }
    }

    public function postCheckNameAdd(Request $request)
    {
        $Name=$request->Name;
        $CatId=$request->CatId;
        $alias=str_slug($Name);
        $kt=Product::where([['Alias', '=' ,$alias],['CatId', '=' , $CatId]])->get();
        if ($kt->count()>0) {
            return 'Tên sản phẩm đã tồn tại';
        }
        else
        {
            $idMax=Product::max('id') +1;
            return $alias.'-'.$idMax;
        }
    }
    public function postCheckAliasAdd(Request $request)
    {
        $Name=$request->Alias;
        $CatId=$request->CatId;
        $Alias=str_slug($Name);
        if($Alias==$request->Alias){
            $kt=Product::where([['Alias', '=' ,$alias],['CatId', '=' , $CatId]])->get();
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
        $CatId=$request->CatId;
        $id=$request->id;
        $alias=str_slug($Name);
        $kt=Product::where([
                        ['id', '<>', $id],
                        ['Alias', '=', $alias],
                        ['CatId', '=', $CatId]
                    ])->get();
        if (count($kt)>0) {
            return 'Tên sản phẩm đã tồn tại';
        }
        else
        {
            return $alias;
        }
    }
    public function postCheckAliasEdit(Request $request)
    {
        $Name=$request->Alias;
        $CatId=$request->CatId;
        $id=$request->id;
        $alias=str_slug($Name);
        if ($alias==$request->Alias) {
            $kt=Product::where([
                            ['id', '<>', $id],
                            ['Alias', '=', $alias],
                            ['CatId', '=', $CatId]
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

    public function postAddProduct(ProductRequest $request)
    {

        $product =new Product;
        $IdxMax= Category::Find($request->CatId)->products()->count();
        // Upload hình ảnh
        $image = $request->file('Img');
        $file_name ='Upload/product/'.time().'-'.$request->file('Img')->getClientOriginalName();
        $img = Image::make($image->getRealPath());
        $img->fit(350, 350)->save($file_name);
        // $file_name ='đang cập nhật';

        $product->Name            =     $request->Name; 
        $product->Alias           =     str_slug($request->Name);
        $product->CatId           =     $request->CatId;
        $product->Price           =     $request->Price;
        $product->Sale           =     0;
        $product->ShortContent            =     $request->short_content; 
        $product->Content            =     $request->content; 
        $product->MetaTitle            =     $request->MetaTitle; 
        $product->MetaDescription            =     $request->MetaDescription; 
        $product->MetaKeyword            =     $request->MetaKeyword; 
        $product->IsActive        =     ($request->IsActive == 'on') ? 1 : 0;
        $product->IsHot           =     ($request->IsHot == 'on') ? 1 :0;
        $product->IsHome          =     0;
        $product->Idx             =     $IdxMax;
        $product->Img             =     $file_name;
        $product->CreateBy        =     1;
        $product->UpdateBy        =     1;
        $product->Locale          =     'vi-vn';
        $product->created_at      =     new DateTime();
        $product->updated_at      =     new DateTime();
        $product->save();
        return redirect()->route('getProductsByCatId',['CatId'=>$request->CatId])->with(['msg'=>'Thêm thành công']);
    }

    public function postEditProduct(ProductRequest $request)
    {
        $product =Product::find($request->id);
        $IdxMax= (count(Product::all()) + 1);
        // Upload hình ảnh
        if ($request->file('Img')) {
            $image = $request->file('Img');
            $file_name = 'Upload/product/'.time().'-'.$request->file('Img')->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->fit(350, 350)->save($file_name,100);
            // Xóa file cũ
           if ($product->Img !='') {
            File::delete($product->Img);
            }
            $product->Img             =     $file_name;
        }
        $product->Name            =     $request->Name; 
        $product->Price            =     $request->Price; 
        $product->Sale            =     0; 
        $product->ShortContent            =     $request->short_content; 
        $product->Content            =     $request->content; 
        $product->MetaTitle            =     $request->MetaTitle; 
        $product->MetaDescription            =     $request->MetaDescription; 
        $product->MetaKeyword            =     $request->MetaKeyword; 
        $product->Alias           =     str_slug($request->Name);
        $product->IsHot           =     ($request->IsHot == 'on')?1:0;
        $product->IsActive        =     ($request->IsActive == 'on') ? 1 : 0;
        $product->IsHome            =    0;
        $product->UpdateBy        =     1;
        $product->updated_at      =     new DateTime();

        $product->save();
        return redirect()->route('getProductsByCatId',['CatId'=>$request->CatId])->with(['msg'=>'Thêm thành công']);
    }
    public function postActiveProduct(Request $request)
    {
        if ($request->ajax()) {
            $product =Product::find($request->id);
            $product->IsActive        =     ($request->IsActive==0) ? 1 : 0;
            $product->updated_at      =     new DateTime();
            $product->save();
            return ($product->IsActive == 1) ? 'on' : 'off';
        }
    }
    public function postHotProduct(Request $request)
    {
        if ($request->ajax()) {
            $product =Product::find($request->id);
            $product->IsHot        =     ($request->IsHot==0) ? 1 : 0;
            $product->updated_at      =     new DateTime();
            $product->save();
            return ($product->IsHot == 1) ? 'on' : 'off';
        }
    }
    public function postSliderProduct(Request $request)
    {
        if ($request->ajax()) {
        $product =Product::find($request->id);
        $product->IsHome        =     ($request->IsHome==0) ? 1 : 0;
        $product->UpdateBy        =     1;
        $product->updated_at      =     new DateTime();

        $product->save();
        return ($request->IsSlider == 1) ? 'off' : 'on';
        }
    }
    public function getProduct($id)
    {
        $item=Product::find($id); // Lấy dữ liệu sản phẩm theo id
        $item2 = Product::all();
        if(count($item2)>0){
            $cate=Category::Find($item->CatId);
            return view('control/products/product',compact('item'))->with(['CatId'=>$item->CatId]);
        }
        else
        {
            $route='getCategorys';
            $msg='Thông tin sản phẩm chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin sản phẩm chưa chính xác']);
        }
    }
    public function postProductDel(Request $request)
    {
        $product=Product::find($request->id);
        if ($product) {
            if (File::exists($product->Img)) {
                File::delete($product->Img);
            }
            $product->delete();
            return redirect()->back();
        }
        else
        {
            $route='getCategorys';
            $msg='Thông tin sản phẩm chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin sản phẩm chưa chính xác']);
        }
    }
/* --- Xóa nhiều sản phẩm ----------*/
    public function postProductDelCheck(Request $request)
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
                $product=Product::Find($value);
                if ($product) {
                    if (File::exists($product->Img)) {
                        File::delete($product->Img);
                    }
                    $product->delete();
                }
            }
            $msg='Đã xóa';
        }
        return $msg;
    }
    /*--------End xóa nhiều sản phẩm -------------*/
    public function postProductImageDelete(Request $request)
    {
        $image=ProductImage::find($request->id);
        if (File::exists($image->Img)) {
            File::delete($image->Img);
        }
        $ProdId=$image->ProdId;
        $image->delete();
        return redirect()->route('getProductImage',['ProdId'=>$ProdId]);
    }
    public function getProductImage($ProdId)
    {   $CatId=Product::Find($ProdId)->CatId;
        $items=Product::find($ProdId)->images()->get();
        return view('control/products/images',compact('items'))->with(['ProdId'=>$ProdId,'CatId'=>$CatId]);
    }
    public function postProductImage(Request $request)
    {
        $product =Product::find($request->ProdId);
        if ($request->hasFile('Img')) {
            $files = $request->file('Img');
            foreach($files as $file){
                $file_name = 'Upload/product/images'.time().'-'.$file->getClientOriginalName();
                $img = Image::make($file->getRealPath());
                $img->fit(500, 500)->save($file_name,80);
                $data= new ProductImage([
                    'Img'           =>       $file_name,
                    'ProdId'        =>      $request->ProdId,
                    'Locale'        =>      'vi-vn',
                    'created_at'    =>       new Datetime(),
                    'updated_at'    =>      new Datetime()]
                    );
                $product->images()->save($data);
            }
        }
        return redirect()->route('getProductImage',['ProdId'=>$request->ProdId]);
    }
    
    
}
