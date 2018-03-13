<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCartRequest extends FormRequest
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
            'Email'        =>       'required|email',
            'FullName'     =>       'required',
            'Address'      =>       'required',
            'Phone'        =>       'required',
            'Company'      =>       'nullable',
            'Role'         =>       'required',
            'Weight'       =>       'nullable|numeric',
            'VehicleType'  =>       'required',
            'Note'         =>       'required',
            'AddressStart' =>       'required',
            'AddressEnd'   =>       'required',
        ];
    }
    public function messages()
    {
        return[
            'Email.required'        =>      'Vui lòng nhập',
            'Email.email'           =>      'Vui lòng nhập đúng định dạng',
            'Password.required'     =>      'Vui lòng nhập ',
            'FullName.required'     =>      'Vui lòng nhập',
            'Address.required'      =>      'Vui lòng nhập',
            'Phone.required'        =>      'Vui lòng nhập',
            'Role.required'         =>      'Vui lòng nhập',
            'Weight.numeric'        =>      'Vui lòng nhập số',
            'VehicleType.required'  =>      'Vui lòng nhập',
            'Note.required'         =>      'Vui lòng nhập',
            'AddressStart.required' =>      'Vui lòng nhập',
            'AddressEnd.required'   =>      'Vui lòng nhập',
        ];
    }
}
