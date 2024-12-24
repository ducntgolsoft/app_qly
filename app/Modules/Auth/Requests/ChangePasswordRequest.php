<?php

namespace App\Modules\Auth\Requests;

use App\Rules\CheckPassword;
use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => ['required', new CheckPassword],
            'password' => ['required', 'different:old_password', new PasswordRule],
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Mật khẩu cũ không được để trống',
            'password.required' => 'Mật khẩu mới không được để trống',
            'password.different' => 'Mật khẩu mới không được trùng với mật khẩu cũ',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được để trống',
            'password_confirmation.same' => 'Xác nhận mật khẩu không trùng khớp',
        ];
    }
}
