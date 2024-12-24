<?php

namespace App\Modules\Auth\Requests;

use App\Models\User;
use App\Rules\CheckEmailUserRule;
use App\Rules\PasswordRule;
use App\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['nullable', 'email', 'max:40', Rule::unique(User::class, 'email')->whereNull('deleted_at')],
            'password' => ['required', new PasswordRule],
            'password_confirmation' => 'required|same:password|min:6',
            'name' => "required|string|max:30",
            'phone' => [
                'required', 'max:15',
                Rule::unique(User::class, 'phone')->whereNull('deleted_at'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.string' => 'Tên phải là chuỗi',
            'name.max' => 'Tên không được quá 255 ký tự',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password_confirmation.required' => 'Mật khẩu xác nhận không được để trống',
            'password_confirmation.min' => 'Mật khẩu xác nhận phải có ít nhất 6 ký tự',
            'password_confirmation.same' => 'Mật khẩu xác nhận không khớp',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'phone.max' => 'Số điện thoại không được quá 15 ký tự',
        ];
    }
}
