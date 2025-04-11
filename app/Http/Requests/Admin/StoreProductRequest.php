<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title' => 'required|min:3|max:255',
            'instruction' => 'required|min:3|max:20000',
            'features' => 'required|array',
            'features.*.title' => 'required|min:3|max:255',
            'features.*.description' => 'required|min:3|max:255',
            'image' => 'required|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'count' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'title.min' => 'Min title length 3 symbols',
            'title.max' => 'Max title length 255 symbols',
            'instruction.required' => 'Instruction is required',
            'instruction.min' => 'Min instruction length 3 symbols',
            'instruction.max' => 'Max instruction length 20000 symbols',
            'features.required' => 'Features are required',
            'features.array' => 'Features should be an array',
            'features.*.title.required' => 'Feature title is required',
            'features.*.title.min' => 'Min title length 3 symbols',
            'features.*.title.max' => 'Max title length 255 symbols',
            'features.*.description.required' => 'Description is required',
            'features.*.description.min' => 'Min description length 3 symbols',
            'features.*.description.max' => 'Max description length 255 symbols',
            'image.required' => 'Image is required',
            'image.image' => 'Invalid image format',
            'image.max' => 'Max image size 2048 Kb',
            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Category doesn\'t exist',
            'count.required' => 'Count is required',
            'count.integer' => 'Count should be an integer',
            'count.min' => 'Count should be more than 0',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price should be a number',
            'price.min' => 'Price should be more than 0'
        ];
    }
}
