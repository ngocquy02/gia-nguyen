<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            'FullName' =>       'required'
        ];
    }
    public function message()
    {
        return[
            'FullName.required' =>      'Vui lòng nhập đầy đủ Họ và Tên'
        ];
    }
}
