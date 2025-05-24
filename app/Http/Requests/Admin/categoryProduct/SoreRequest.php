<?php

namespace App\Http\Requests\Admin\categoryProduct;

use Illuminate\Foundation\Http\FormRequest;

class SoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'thumbnail' => 'required',
            'product_type' => 'required',
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'Tên danh mục',
            'description' => 'Mô tả',
            'thumbnail' => 'Ảnh bìa',
            'product_type' => 'Loại sản phẩm',
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
