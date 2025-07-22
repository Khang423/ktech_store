<?php

namespace App\Http\Requests\Admin\product;

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
            'name' => 'string|required',
            'category_product_id' => 'required',
            'model_series_id' => 'required',
            'usage_type_id' => 'required',
            'brand_id' => 'required',
            'thumbnail' => 'image|required',
            'description' => 'nullable',
        ];
    }
}
