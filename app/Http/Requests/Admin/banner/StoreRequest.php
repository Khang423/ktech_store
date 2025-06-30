<?php

namespace App\Http\Requests\Admin\banner;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'banner_image' => 'required'
        ];
    }

     public function attributes(): array
    {
        return [
            'name' => 'Tên tiêu đề',
            'banner_image' => 'Ảnh banner',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên tiêu đề không được bỏ trống',
            'banner_image.required' => 'Vui lòng chọn ảnh Banner',
        ];
    }

}
