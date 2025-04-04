<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
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
            'sum' => 'required|numeric|gt:0'
        ];
    }
    public function messages()
    {
        return [
            'sum.required' => 'Sum is required',
            'sum.integer' => 'Sum must be an integer',
            'sum.gt' => 'Sum cannot be negative'
        ];
    }
}
