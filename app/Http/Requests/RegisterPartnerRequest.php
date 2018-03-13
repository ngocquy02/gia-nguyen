<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPartnerRequest extends FormRequest
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
            'Email'        =>       'required | email | unique:partner',
            'FullName'     =>       'required',
            'Address'      =>       'nullable',
            'Phone'        =>       'required',
            'Company'      =>       'nullable',
            'Role'         =>       'nullable',
            'CustomerType' =>       'nullable',
            'Content'      =>       'nullable',
        ];
    }
    public function messages()
    {
        return[
            'Email.required'        =>      'Vui lòng nhập Email đăng nhập',
            'Email.email'           =>      'Vui lòng nhập Email đúng định dạng',
            'Email.unique'          =>      'Địa chỉ Email đã được đăng ký',
            'FullName.required'     =>      'Vui lòng nhập',
            // 'Address.required'      =>      'Vui lòng nhập',
            'Phone.required'        =>      'Vui lòng nhập',
            // 'Company.required'      =>      'Vui lòng nhập',
            // 'Role.required'         =>      'Vui lòng nhập',
            // 'CustomerType.required' =>      'Vui lòng nhập',
            // 'Content.required'      =>      'Vui lòng nhập',
        ];
    }
}
