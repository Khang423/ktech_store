<?php

namespace App\Http\Requests\Admin\stockImport;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'products' => 'required',
            'supplier_id' => 'required',
        ];
    }
}
