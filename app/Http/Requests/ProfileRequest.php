<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name'=>'required',
            'phone'=>'required|max:12',
            'email'=>'required',
            'address'=>'required',
            'avatar'=>'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    public function messages()
    {       
        return[
            'required' =>':attribute không được để trống',
            'image' =>':Chọn 1 hình nền',
        ];
    }
    public function attributes()
    {
        return[
            'name'=>'Tên',
            'phone'=>'Số điện thoại',
            'email'=>'Email',
            'address'=>'Địa chỉ',
            'avatar'=>'Hình nền',
        ];
    }
}
