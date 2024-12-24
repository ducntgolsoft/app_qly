<?php

namespace App\Modules\User\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id');
        return [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique(User::class, 'email')->ignore($id, 'id')->where(function ($query) {
                    $query->whereNull('deleted_at');
                })
            ],
            'phone' => [
                'required',
                Rule::unique(User::class, 'phone')->ignore($id, 'id')->where(function ($query) {
                    $query->whereNull('deleted_at');
                })
            ],
            // 'user_code' => [
            //     'null',
            //     Rule::unique(User::class, 'user_code')->ignore($id, 'id')->where(function ($query) {
            //         $query->whereNull('deleted_at');
            //     })
            // ],
            'status' => 'nullable',
            'ip_address' => 'nullable',
            'name_bank' => 'nullable',
            'number_account' => 'nullable',
            'name_account' => 'nullable',
            // 'is_currency' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'user_code.required' => 'Mã người dùng không được để trống',
            'user_code.unique' => 'Mã người dùng đã tồn tại',
            'ip_address.required' => 'Địa chỉ IP không được để trống',
            'name_bank.required' => 'Tên ngân hàng không được để trống',
            'number_account.required' => 'Số tài khoản không được để trống',
            'name_account.required' => 'Tên chủ tài khoản không được để trống',
        ];
    }
}