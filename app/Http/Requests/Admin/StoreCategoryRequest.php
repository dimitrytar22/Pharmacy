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
            'title' => 'required|min:3|max:256',
            'image' => 'required|mimes:jpeg,png,jpg,svg|max:2048',
        ];
    }
    public function  messages()
    {
        return [
            'image.mimes' => 'You can upload only .jpeg .png .jpg .svg files!'
        ];
    }
}
