<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'FullName'          =>    'required',
            'Email'             =>    'required | email',
            'Content'           =>    'required'
        ];
    }
    public function messages()
    {
        return [
            'FullName.required' =>        'Vui lòng nhập đầy đủ Họ và Tên',
            'Email.required'    =>        'Vui lòng nhập Email',
            'Email.email'       =>        'Email không đúng định dạng',
            'Content.required'  =>        'Vui lòng nhập nội dung'        
        ];
    }
}
