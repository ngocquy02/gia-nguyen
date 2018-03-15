<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\ArticleTag;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\EditArticleRequest;
use File;
use DateTime;
use Image;

class ArticleController extends Controller
{
    /*------------------------------Lấy danh sách bài viết----------------------------------------*/
    public function getArticles($CatId)
    {
        $items=Category::find($CatId)->articles()->orderBy('created_at','desc')->paginate(20);
        return view('control.articles.index',compact('items'))->with('CatId', $CatId);
    }
    /*-------------------------------Thêm bài viết-----------------------------------------------*/
    public function getAddArticle($CatId)
    {   
        $item =Category::where([
                            ['id', '=', $CatId],
                            ['Type', '<>', 3],
                        ])
                ->get();
        $tag = Tag::All();
        // dd($tag);die;        
        if(count($item)===1){
            return view('control.articles.article',['tag'=>$tag],compact('CatId'));
        }
        else
        {
            $route='getCategorys';
            $msg='Thông tin danh mục chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin danh mục chưa chính xác']);
        }
    }
    
    public function postAddArticle(ArticleRequest $request)
    {
       

        $article =new Article;
        $IdxMax= Category::Find($request->CatId)->articles()->count();
        // Upload hình ảnh
        $image = $request->file('Img');
        $file_name = 'Upload/article/'.time().'-'.$image->getClientOriginalName();
        $img = Image::make($image->getRealPath());
        $img->fit(235, 148)->save($file_name,100);
       
        $article->Name            =     $request->Name; 
        $article->Alias           =     str_slug($request->Alias);
        $article->CatId           =     $request->CatId;
        $article->IsHot           =     0;
        $article->IsActive        =     ($request->IsActive == 'on') ? 1 : 0;
        $article->IsHome          =     0;
        $article->Idx             =     $IdxMax +1;
        $article->Img             =     $file_name;
        $article->ShortContent    =     $request->short_content;
        $article->Content         =     $request->content;
        $article->CreateBy        =     1;
        $article->UpdateBy        =     1;
        $article->MetaTitle       =     $request->MetaTitle;
        $article->MetaDescription =     $request->MetaDescription;
        $article->MetaKeyword     =     $request->MetaKeyword;
        $article->Tag     =     0;
        $article->created_at      =     new DateTime();
        $article->updated_at      =     new DateTime();

        $article->save();
        return redirect()->route('getArticles',['CatId'=>$request->CatId]);
    }
    /*------------------End thêm bài viết-----------------------------*/
    /*------------------Sửa bài viết---------------------------------*/
    public function getArticle($id)
    {
        $item=Article::find($id);
        $item2 = Article::all();
        if(count($item2)>0){
            return view('control.articles.article',compact('item'))->with('CatId',$item->CatId);
        }
        else
        {
            $route='getCategorys';
            $msg='Thông tin danh mục chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin danh mục chưa chính xác']);
        }
    }
    public function postEditArticle(EditArticleRequest $request)
    {
      
        $article =Article::find($request->id);
        // Upload hình ảnh
        if ($request->file('Img')) {
            $image = $request->file('Img');
            $file_name = 'Upload/article/'.time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            /* thêm chữ vào hình ảnh*/
            // $img->text('chien-cho', 120, 100);
            /* end */
            $img->fit(235, 148)->save($file_name,100);
            // Xóa file cũ
           if ($article->Img !='') {
            File::delete($article->Img);
            }
            $article->Img             =     $file_name;
        }

        $article->Name            =     $request->Name; 
        $article->Alias           =     str_slug($request->Alias);
        $article->CatId           =     $request->CatId;
        $article->IsHot           =      0;
        $article->IsActive        =     ($request->IsActive == 'on') ? 1 : 0;
        $article->IsHome        =     0;
        $article->ShortContent    =     $request->short_content;
        $article->Content         =     $request->content;
        $article->UpdateBy        =     1;
        $article->MetaTitle       =     $request->MetaTitle;
        $article->MetaDescription =     $request->MetaDescription;
        $article->MetaKeyword     =     $request->MetaKeyword;
        $article->Tag     =     0;
        $article->updated_at      =     new DateTime();

        $article->save();
        return redirect()->route('getArticles',['CatId'=>$request->CatId]);
    }
    /*-----------------------------End sửa bài viết----------------------------------------*/
    /*-----------------------------Xóa bài viết--------------------------------------------*/
    public function postArticleDel(Request $request)
    {
        $article=Article::Find($request->id);
        if (File::exists($article->Img)) {
            File::delete($article->Img);
        }
        $CatId=$article->CatId;
        $article->delete();
        return redirect()->back();
    }
    /*----------------------------------END xóa bài viết---------------------------------------*/
     /*-----------------------------Xóa nhiều bài viết--------------------------------------------*/
    public function postArticleDelCheck(Request $request)
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
                $article=Article::Find($value);
                if ($article) {
                    if (File::exists($article->Img)) {
                        File::delete($article->Img);
                    }
                    $article->delete();
                }
            }
            $msg='Đã xóa';
        }
        return $msg;
    }
    /*----------------------------------END xóa nhiều bài viết---------------------------------------*/
    /*-----------------------------Kiểm tra trùng lặp tên và Alias----------------------------*/
    public function postCheckNameAddArticle(Request $request)
    {
        $Name=$request->Name;
        $CatId=$request->CatId;
        $alias=str_slug($Name);
        $kt=Article::where([['Alias', '=' ,$alias],['CatId', '=' , $CatId]])->get();
        if (count($kt)>0) {
            return 'Tên bài viết đã tồn tại';
        }
        else
        {
            return $alias;
        }
    }
    public function postCheckAliasAddArticle(Request $request)
    {
        $Name=$request->Alias;
        $CatId=$request->CatId;
        $Alias=str_slug($Name);
        if($Alias==$request->Alias){
            $kt=Article::where([['Alias', '=' ,$alias],['CatId', '=' , $CatId]])->get();
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
    public function postCheckNameEditArticle(Request $request)
    {
        $Name=$request->Name;
        $CatId=$request->CatId;
        $id=$request->id;
        $alias=str_slug($Name);
        $kt=Article::where([
                        ['id', '<>', $id],
                        ['Alias', '=', $alias],
                        ['CatId', '=', $CatId]
                    ])->get();
        if (count($kt)>0) {
            return 'Tên bài viết đã tồn tại';
        }
        else
        {
            return $alias;
        }
    }
    public function postCheckAliasEditArticle(Request $request)
    {
        $Name=$request->Alias;
        $CatId=$request->CatId;
        $id=$request->id;
        $alias=str_slug($Name);
        if ($alias==$request->Alias) {
            $kt=Article::where([
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
    /*---------------------Ajax Active, Hot, Slider---------------------------*/
    public function postActiveArticle(Request $request)
    {
        if ($request->ajax()) {
            $article =Article::Find($request->id);
            $article->IsActive        =     ($request->IsActive==0) ? 1 : 0;
            $article->updated_at      =     new DateTime();
            $article->save();
            return ($article->IsActive == 1) ? 'on' : 'off';
        }
    }
    public function postHotArticle(Request $request)
    {
        if ($request->ajax()) {
            $article =Article::Find($request->id);
            $article->IsHot        =     ($request->IsHot==0) ? 1 : 0;
            $article->updated_at      =     new DateTime();
            $article->save();
            return ($article->IsHot == 1) ? 'on' : 'off';;
        }
    }
    public function postSliderArticle(Request $request)
    {
        if ($request->ajax()) {
        $article =Article::find($request->id);
        $article->IsSlider        =     ($request->IsSlider==0) ? 1 : 0;
        $article->UpdateBy        =     1;
        $article->updated_at      =     new DateTime();

        $article->save();
        return ($request->IsSlider == 1) ? 'off' : 'on';
        }
    }
    /*---------------------END-------------------------------*/
}
