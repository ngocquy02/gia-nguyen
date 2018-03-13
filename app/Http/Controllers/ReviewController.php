<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\EditReviewRequest;
use Illuminate\Database\Query\Builder;
use File;
use DateTime;
use DB;
use Image;

class ReviewController extends Controller
{
    /*------------Lấy danh sách Ý kiến khách hàng--------------*/
    public function getReview()
    {   
        $items=Review::all();
        return view('control/review/index',compact('items'));
    }
	/*------------ Thêm Ý kiến khách hàng---------------------*/
	public function getAddReview()
    {   
        return view('control/review/review');
    }
    /*------------ Xem và chỉnh sửa Ý kiến khách hàng-----------*/
    public function getEditReview($id)
    {   
    	$item=Review::Find($id);
    	if(count($item)>0){
            return  view('control/review/review',compact('item'));
        }
        else
        {
            $route='getReview';
            $msg='Thông tin Ý kiến khách hàng chưa chính xác!!!';
            return view('control.error',compact('route'))->with(['msg'=>$msg,'Title'=>'Thông tin Ý kiến khách hàng chưa chính xác']);
        }
    }
    /*------------------------ Xóa Ý kiến khách hàng ----------------------------------------*/
    public function postReviewDel(Request $request)
    {
        $review=Review::find($request->id);
        if (File::exists('Upload/review/'.$review->Img)) {
            File::delete('Upload/review/'.$review->Img);
        }
        $review->delete();
        return redirect()->route('getReview');
    }
    /*------------------ Lưu thông tin Ý kiến khách hàng (Add) ------------------------------*/
    public function postAddReview(ReviewRequest $request)
    {
        $review =new Review;
        $image = $request->file('Img');
        $file_name = time().'-'.$request->file('Img')->getClientOriginalName();   
        $destinationPath = 'Upload/review/';
        $img = Image::make($image->getRealPath());
        $img->fit(200, 200)->save($destinationPath.'/'.$file_name);

        $review->Name 			  =		$request->Name;
        $review->Company 		  =		$request->Company;
        $review->Content 		  =		$request->Content;
        $review->Img 			  =     $file_name;
        $review->Locale		  	  =     'vi';
        $review->created_at       =     new DateTime();
        $review->updated_at       =     new DateTime();
        $review->save();
        return redirect()->route('getReview');
    }
    /*---------------- Lưu thông tin Ý kiến khách hàng (Edit)------------------------*/
    public function postEditReview(EditReviewRequest $request)
    {
        $review =Review::Find($request->id);
        if ($request->file('Img')) {
	        $image = $request->file('Img');
	        $file_name = time().'-'.$request->file('Img')->getClientOriginalName();   
	        $destinationPath = 'Upload/review/';
	        $img = Image::make($image->getRealPath());
	        $img->fit(200, 200)->save($destinationPath.'/'.$file_name);

	        if ($review->Img !='') {
            File::delete('Upload/review/'.$review->Img);
            }
            $review->Img          =     $file_name;
	    }
        $review->Name 			  =		$request->Name;
        $review->Company 		  =		$request->Company;
        $review->Content 		  =		$request->Content;
        $review->updated_at       =     new DateTime();
        $review->save();
        return redirect()->route('getReview');
    }
}
