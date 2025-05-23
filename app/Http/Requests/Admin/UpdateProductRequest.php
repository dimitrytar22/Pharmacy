<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:256',
            'instruction' => 'required|min:3|max:20000',
            'features' => 'array',
            'features.*.title' => 'required|max:255',
            'features.*.description' => 'required|min:3|max:255',
            'image' => 'image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'count' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ];
    }
}
