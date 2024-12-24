<?php

namespace App\Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserCode extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_code' => [
                'required',
                'numeric',
                'min:000001',
                'max:999999',
                Rule::unique('user_codes', 'code')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'user_code.required' => 'Mã giới thiệu không được để trống!',
            'user_code.numeric' => 'Mã giới thiệu phải là số!',
            'user_code.min' => 'Mã giới thiệu tối thiểu 6 chuỗi số!',
            'user_code.max' => 'Mã giới thiệu tối đa 6 chuỗi số!',
            'user_code.unique' => 'Mã giới thiệu đã tồn tại!',
        ];
    }
}

