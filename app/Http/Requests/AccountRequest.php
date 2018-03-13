<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'FullName'              =>          'required|max:255',
            'Email'                 =>          'required|max:255|email',
            'Phone'                 =>          'required|max:255',
            'Company'               =>          'required|max:255',
            'Role'                  =>          'required|max:255',
            'Address'               =>          'required|max:255',
        ];
    }
    public function messages()
    {
        return [
            'FullName.required'     =>          'Trường bắt buộc nhập',
            'FullName.max'          =>          'Nội dung trường quá dài',
            'Email.required'        =>          'Trường bắt buộc nhập',
            'Email.email'           =>          'Trường không đúng định dạng',
            'Email.max'             =>          'Nội dung trường quá dài',
            'Phone.required'        =>          'Trường bắt buộc nhập',
            'Phone.max'             =>          'Nội dung trường quá dài',
            'Company.required'      =>          'Trường bắt buộc nhập',
            'Company.max'           =>          'Nội dung trường quá dài',
            'Role.required'         =>          'Trường bắt buộc nhập',
            'Role.max'              =>          'Nội dung trường quá dài',
            'Address.required'      =>          'Trường bắt buộc nhập',
            'Address.max'           =>          'Nội dung trường quá dài',
        ];
    }
}
