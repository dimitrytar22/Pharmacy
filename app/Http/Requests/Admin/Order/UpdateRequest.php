<?php

namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'payment_method_id' => 'integer|exists:payment_methods,id',
            'product_ids' => 'required|array',
            'product_ids.*' => 'integer|exists:products,id',
            'discount_id' => 'integer|exists:discounts,id'
        ];
    }

    public function messages()
    {
        return [
            'payment_method_id.integer' => 'Payment method should be an integer',
            'payment_method_id.exists' => 'Payment method doesn\'t exist',
            'product_ids.required' => 'Products are required',
            'product_ids.array' => 'Products should be an array',
            'product_ids.*.integer' => 'Each product should be an integer',
            'product_ids.*.exists' => 'Product doesn\'t exist',
            'discount_id.integer' => 'Discount should be an integer',
            'discount_id.exists' => 'Discount doesn\'t exist'
        ];
    }
}
