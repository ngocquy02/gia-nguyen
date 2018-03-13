<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPartnerRequest extends FormRequest
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
            'Img'               =>          'image',
            'Name'              =>          'required',
            'Link'              =>          'url',
        ];
    }
    public function messages()
    {
        return [
            'Img.image'         =>          'File không đúng định dạng',
            'Name.required'     =>          'Vui lòng nhập tên đối tác',
            'Link.url'          =>          'Đường dẫn không đúng'
        ];
    }
}
