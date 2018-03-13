<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Img'               =>          'required|image',
            'Name'              =>          'required',
            'Content'           =>          'required',
        ];
    }
    public function messages()
    {
        return [
            'Img.required'      =>          'Vui lòng Chọn file hình ảnh',
            'Img.image'         =>          'File không đúng định dạng',
            'Name.required'     =>          'Vui lòng nhập tên đối tác',
            'Content.required'  =>          'Vui lòng nhập Ý kiến khách hàng'
        ];
    }
}
