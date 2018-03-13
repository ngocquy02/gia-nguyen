<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'Phone'             =>    'required',
            'Address'           =>    'required'
        ];
    }
    public function messages()
    {
        return [
            'FullName.required' =>        'Vui lòng nhập đầy đủ Họ và Tên',
            'Email.required'    =>        'Vui lòng nhập Email',
            'Email.email'       =>        'Email không đúng định dạng',
            'Phone.required'    =>        'Vui lòng nhập số điện thoại',
            'Address.required'  =>        'Vui lòng nhập địa chỉ'        
        ];
    }
}
