<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyImgRequest extends FormRequest
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
            'Img'=>'required|image'
        ];
    }
    public function messages()
    {
        return [
            'Img.required'  => 'Vui lòng Chọn file hình ảnh Nền',
            'Img.image'  => 'File không đúng định dạng'
        ];
    }
}
