<?php

namespace App\Http\Requests\Admin\User\Order;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payment_method_id' => 'integer|exists:payment_methods,id',
            'discount_id' => 'integer|exists:discounts,id',
            'products' => 'required|array',
            'products.*.id' => 'required|integer|exists:products,id',
            'products.*.amount' => 'required|integer',
            'status_id' => 'required|integer|exists:statuses,id',
            'paid_at' => 'date_format:Y-m-d\TH:i',
        ];
    }

    public function messages()
    {
        return [
            'payment_method_id.integer' => 'Payment method should be an integer',
            'payment_method_id.exists' => 'Payment method doesn\'t exist',
            'products.required' => 'Products are required',
            'products.array' => 'Products should be an array',
            'products.*.id.required' => 'Each product id required',
            'products.*.id.integer' => 'Each product id should be an integer',
            'products.*.id.exists' => 'Product doesn\'t exist',
            'products.*.amount.required' => 'Product amount is required',
            'products.*.amount.integer' => 'Product amount should be an integer',
            'discount_id.integer' => 'Discount should be an integer',
            'discount_id.exists' => 'Discount doesn\'t exist',
            'status_id.required' =>'Status is required',
            'status_id.integer' =>'Status id should be an integer',
            'status_id.exists' =>'Status doesn\'t exist',
            'paid_at.date_format' => 'Invalid date time format',
        ];
    }
}
