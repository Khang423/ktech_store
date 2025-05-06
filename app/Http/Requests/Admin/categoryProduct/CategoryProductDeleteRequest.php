<?php

namespace App\Http\Requests\Admin\categoryProduct;

use Illuminate\Foundation\Http\FormRequest;

class CategoryProductDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


}
