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
            'name'=>'required',
            'detail'=>'required',
            'company'=>'required',
            'price'=>'numeric',
            'sale'=>'numeric|max:100|min:0',
            'xx.*' => 'required|mimes:jpg,jpeg,png,bmp|max:2048'


        ];
    }
    public function messages()
    {       
        return[
            'required' =>':attribute không được để trống',
            'numeric' =>':attribute phải là số',
        ];
    }
    public function attributes()
    {
        return[
            'name'=>'Tên sản phẩm',
            'detail'=>'Chi tiết',
            'company'=>'Công ty',
            'price'=>'Giá sản phẩm',
        ];
    }
}
