<?php

namespace App\Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|min:6',
            'user_code' => 'required',
            'status' => 'nullable',
            'ip_address' => 'nullable',
            // 'is_currency' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'phone.required' => 'Số điện thoại không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'user_code.required' => 'Mã người dùng không được để trống',
            'ip_address.required' => 'Địa chỉ IP không được để trống',
            'is_currency.required' => 'Loại tiền tệ không được để trống',
        ];
    }
}