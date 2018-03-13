<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangPasswordPartnerRequest extends FormRequest
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
            'Password'          =>    'required',
            'NewPassword'             =>    'required'
        ];
    }
    public function messages()
    {
        return [
            'Password.required' =>        'Vui lòng nhập',
            'NewPassword.required'    =>        'Vui lòng nhập',     
        ];
    }
}
