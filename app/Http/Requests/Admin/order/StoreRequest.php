<?php

namespace App\Http\Requests\Admin\order;

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
            'name' => 'required',
            'email_receiver' => 'required|email',
            'city' => 'required',
            'ward' => 'required',
            'tel' => 'required',
            'district' => 'required',
            'address' => 'nullable',
            'note' => 'nullable',
            'productSelected' => 'required',
            'method_id' => 'required',
        ];
    }
}
