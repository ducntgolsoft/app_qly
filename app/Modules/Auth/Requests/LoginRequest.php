<?php

namespace App\Modules\Auth\Requests;

use App\Models\User;
use App\Rules\LoginRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'userInfo' => ['required', new LoginRule()],
            'password' => 'required|min:6',
            'rememberMe' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'userInfo.required' => 'Email/Số điện thoại không được để trống',
            'userInfo.exists' => 'Email/Số điện thoại không tồn tại',
            'userInfo.regex' => 'Email/Số điện thoại không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
        ];
    }

}
