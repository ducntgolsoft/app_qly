<?php

namespace App\Modules\Auth\Requests;

use App\Models\User;
use App\Rules\LoginRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ForgotPasswordRequest extends FormRequest
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

    public function rules()
    {
        return [
            'userInfo' => ['required', new LoginRule()]
        ];
    }

    public function messages()
    {
        return [
            'userInfo.required' => 'Vui lòng nhập Email/Số điện thoại !',
        ];
    }
}
