<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'Alias'   =>    'nullable',
            'Img'     =>    'nullable',
            'MetaTitle'             =>    'nullable|max:255',
            'MetaKeyword'           =>    'nullable|max:255',
            'MetaDescription'       =>    'nullable|max:255'
        ];
    }
    public function messages()
    {
        return [
            'Name.required'     =>        'Vui lòng nhập tên Sản Phẩm',
            // 'Name.unique'       =>        'Tên Sản Phẩm đã tồn tại',
            // 'Alias.unique'      =>        'Alias Sản Phẩm đã tồn tại',
            'Alias.required'    =>        'Vui lòng nhập Alias',
            // 'Img.required'      =>        'Vui lòng Chọn file hình ảnh',
            // 'Img.image'         =>        'File không đúng định dạng',
            'MetaTitle.max'             =>          'Tối đa 255 ký tự',
            'MetaKeyword.max'           =>          'Tối đa 255 ký tự',
            'MetaDescription.max'       =>          'Tối đa 255 ký tự'
        ];
    }
}
