<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email_or_phone' => 'required|max:255',
            'password' => 'required',
            'remember' => 'string'
        ];
    }
    public function attributes(): array
    {
        return [
            'email_or_phone' => 'Tên đăng nhập',
            'password' => 'Mật khẩu'
        ];
    }

    public function messages(): array
    {
        return [
            'email_or_phone.required' => 'Tên đăng nhập không được bỏ trống',
            'password.required' => 'Mật khẩu không được bỏ trống'
        ];
    }
}
