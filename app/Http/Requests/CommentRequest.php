<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'comment' => 'required|min:10'
        ];
    }

    public function messages()
    {       
        return[
            'required' =>':attribute không được để trống',
            'min' =>':attribute hơn 10 ký tự',
        ];
    }
    public function attributes()
    {
        return[
            'comment'=>'Bình luận',
        ];
    }
}
