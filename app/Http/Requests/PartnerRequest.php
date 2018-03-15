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
            'Name'              =>          'required|max:255',
            'Url'                 =>          'required|max:255|url'
        ];
    }
    public function messages()
    {
        return [
            'Name.required'     =>          'Trường bắt buộc nhập',
            'Name.max'          =>          'Nội dung trường quá dài'
        ];
    }
}
