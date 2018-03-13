<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'Name'    =>    'required',
            'Alias'   =>    'required',
            'Img'     =>    'nullable'
        ];
    }
    public function messages()
    {
        return [
            'Name.required'     =>        'Vui lòng nhập tên Sản Phẩm',
            'Alias.required'    =>        'Vui lòng nhập Alias',
            'Img.image'         =>        'File không đúng định dạng'
        ];
    }
}
