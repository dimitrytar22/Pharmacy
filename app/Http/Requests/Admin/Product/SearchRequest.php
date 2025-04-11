<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'prompt' => 'required|min:3|max:255'
        ];
    }

    public function messages()
    {
        return [
            'prompt.required' => 'Prompt is required',
            'prompt.min' => 'Min prompt length 3 symbols',
            'prompt.max' => 'Max prompt length 255 symbols'
        ];
    }
}
