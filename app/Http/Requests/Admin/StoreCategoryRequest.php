<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'title' => 'required|min:3|max:255|unique:categories,title',
            'image' => 'required|mimes:jpeg,png,jpg,svg|max:5000',
        ];
    }
    public function  messages()
    {
        return [
            'title.required' => 'Title is required',
            'title.min' => 'Title should be more at least 3 symbols',
            'title.max' => 'Title should be more less than 256 symbols',
            'image.required' => 'Image is required',
            'image.mimes' => 'You can upload only .jpeg .png .jpg .svg files!',
            'image.max' => "Max image size 5mb!",
        ];
    }
}
