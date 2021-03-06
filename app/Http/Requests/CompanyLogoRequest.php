<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyLogoRequest extends FormRequest
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
            'Logo'=>'required|image'
            ];
    }
    public function messages()
    {
        return [
            'Logo.required'  => 'Vui lòng Chọn file hình ảnh Logo',
            'Logo.image'  => 'File không đúng định dạng'
        ];
    }
}
