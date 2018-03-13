<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
            'Birthday'                 =>          'nullable|date|date_format:"Y-m-d"',
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
            'Birthday.date'             =>          'Ngày không đúng định dạng',
            'Birthday.date_format'             =>          'Ngày không đúng định dạng',
        ];
    }
}
