<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditArticleRequest extends FormRequest
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
            'Name'                  =>    'required | unique:article,Name,'.$this->id.',id,CatId,'.$this->CatId,
            'Alias'                 =>    'required | unique:article,Alias,'.$this->id.',id,CatId,'.$this->CatId,
            'Img'                   =>    'nullable|image|max:2048',
            'MetaTitle'             =>    'nullable|max:255',
            'MetaKeyword'           =>    'nullable|max:255',
            'MetaDescription'       =>    'nullable|max:255'
        ];
    }
    public function messages()
    {
        return [
            'Name.required'             =>          'Vui lòng nhập tên bài viết',
            'Name.unique'               =>          'Tên bài viết đã tồn tại',
            'Alias.required'            =>          'Vui lòng nhập Alias',
            'Alias.unique'              =>          'Alias đã tồn tại',
            'Img.image'                 =>          'File không đúng định dạng',
            'Img.max'                   =>          'File quá lớn',
            'MetaTitle.max'             =>          'Tối đa 255 ký tự',
            'MetaKeyword.max'           =>          'Tối đa 255 ký tự',
            'MetaDescription.max'       =>          'Tối đa 255 ký tự'
        ];
    }
}
