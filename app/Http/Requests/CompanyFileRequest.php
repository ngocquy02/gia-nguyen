<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyFileRequest extends FormRequest
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
            'File'=>'required|file'
        ];
    }
    public function messages()
    {
        return [
            'File.required'  => 'Vui lòng Chọn file',
            'File.file'  => 'File không đúng định dạng'
        ];
    }
}
