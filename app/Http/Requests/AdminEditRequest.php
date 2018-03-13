<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminEditRequest extends FormRequest
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
            'Email'                         =>       'required | email',
            'ConfirmPassword'               =>       'same:Password',
            'FullName'                      =>       'required'
        ];
    }
    public function messages()
    {
        return[
            'Email.required'                =>      'Vui lòng nhập Email đăng nhập',
            'Email.email'                   =>      'Vui lòng nhập Email đúng định dạng',
            'ConfirmPassword.same'          =>      'Mật khẩu không trùng khớp',
            'FullName.required'             =>      'Vui lòng nhập đầy đủ họ và tên'
        ];
    }
}
