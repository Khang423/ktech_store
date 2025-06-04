<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'password' => 'required',
            're_password' => ['required_with:new_password', 'same:password'],
            'tel' => 'required|unique:customers|string|max:10',
            'email' => 'unique:customers|max:255',
            'birthday' => 'nullable',
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'Tên người dùng',
            'email_or_phone' => 'Tên đăng nhập',
            'password' => 'Mật khẩu',
            're_password' => 'Mật khẩu nhập lại',
            'birthday' => 'Ngày sinh',
            'email' => 'Địa chỉ Email'
        ];
    }

    public function messages(): array
    {
        return [
            'email_or_phone.required' => 'Tên đăng nhập không được bỏ trống',
            'password.required' => 'Mật khẩu không được bỏ trống',
            're_password.required_with' => 'Mật khẩu nhập lại không khớp'
        ];
    }
}
