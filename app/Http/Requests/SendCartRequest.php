<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendCartRequest extends FormRequest
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
            'Status'=>'required|min:0|max:1',
            'Price'=>'required|min:0|numeric',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'Status.required'=>'Trường bắt buộc nhập',
            'Status.min'=>'Trạng thái không thể thay đổi',
            'Status.max'=>'Trạng thái không thể thay đổi',
            'Price.required'=>'Trường bắt buộc nhập',
            'Price.min'=>'Giá trị trường lớn hơn hoặc bằng 0',
            'Price.numeric'=>'Trường nhập phải là số',
        ];
    }
}
