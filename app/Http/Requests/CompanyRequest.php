<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'Name'=>'required',
            'Phone'=>'required',
            'Address'=>'required',
            'Email'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'Name.required'  => 'Vui lòng nhập tên Công ty',
            'Phone.required'  => 'Vui lòng nhập số điện thoại Công ty',
            'Address.required'  => 'Vui lòng nhập địa chỉ Công ty',
            'Email.required'  => 'Vui lòng nhập Email Công ty',
        ];
    }
}
