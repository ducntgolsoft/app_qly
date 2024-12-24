<?php

namespace App\Modules\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'newPassword' => ['required', 'min:6'],
            'confirmNewPassword' => 'required|min:6|same:newPassword',
        ];
    }

    public function messages()
    {
        return [
            'newPassword.required' => 'Mật khẩu không được để trống !',
            'newPassword.min' => 'Mật khẩu phải có ít nhất 6 ký tự !',
            'confirmNewPassword.required' => 'Xác nhận mật khẩu không được để trống !',
            'confirmNewPassword.same' => 'Xác nhận mật khẩu không khớp !',
            'confirmNewPassword.min' => 'Xác nhận mật khẩu phải có ít nhất 6 ký tự !',
        ];
    }
}
