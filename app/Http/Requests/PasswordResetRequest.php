<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
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
            'Password'        =>       'required',
            'PasswordConfirm' =>        'required | same:Password'
        ];
    }
    public function message()
    {
        return[
            'Password.required'        =>      'Vui lòng nhập mật khẩu mới',
            'PasswordConfirm.required' =>      'Vui lòng nhập nhập lại mật khẩu mới',
            'PasswordConfirm.same'     =>      'Mật khẩu không trùng khớp với nhau'
        ];
    }
}
