<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditReviewRequest extends FormRequest
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
            'Img'               =>          'image',
            'Name'              =>          'required',
            'Content'           =>          'required',
        ];
    }
    public function messages()
    {
        return [
            'Img.image'         =>          'File không đúng định dạng',
            'Name.required'     =>          'Vui lòng nhập tên đối tác',
            'Content.required'  =>          'Vui lòng nhập ý kiến khách hàng'
        ];
    }
}
