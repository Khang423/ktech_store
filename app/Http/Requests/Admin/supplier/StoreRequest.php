<?php

namespace App\Http\Requests\Admin\supplier;

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
            'name' => 'required|max:255',
            'phone' => 'required|max:10',
            'hotline' => 'max:10',
            'address' => 'required|string',
            'website' => 'required',
            'email' => 'required|string'
        ];
    }
}
