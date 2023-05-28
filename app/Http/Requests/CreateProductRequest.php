<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
        'product_name' => 'required',
        'product_price' => 'required|numeric',
        'description' => 'required',
        'category' => 'required',
        'tags' => 'required|array|min:1',
        'discounts' => 'required',
        'photo' => 'image|max:10240',
        ];
    }
}
