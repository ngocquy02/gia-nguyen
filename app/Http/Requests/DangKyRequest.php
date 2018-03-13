<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangKyRequest extends FormRequest
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
            'Email'    =>       'required | email',
            'Password' =>       'required',
            'FullName' =>       'required'
        ];
    }
    public function message()
    {
        return[
            'Email.required'    =>      'Vui lòng nhập Email đăng nhập',
            'Email.email'       =>      'Vui lòng nhập Email đúng định dạng',
            'Password.required' =>      'Vui lòng nhập mật khẩu đăng nhập',
            'FullName.required' =>      'Vui lòng nhập đầy đủ họ và tên'
        ];
    }
}
