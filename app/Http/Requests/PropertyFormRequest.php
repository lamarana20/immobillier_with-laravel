<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyFormRequest extends FormRequest
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
           'title' => ['required', 'min:8'],
            'description' => ['required', 'min:8'],
            'surface' => ['required', 'integer', 'min:10'],
            'rooms' => ['required', 'integer', 'min:1'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'floor' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'integer', 'min:10'],
            'city' => ['required', 'min:3'],
            'address' => ['required', 'min:8'],
            'postal_code' => ['required', 'regex:/^\d{5}$/'],
            'sold' => ['required', 'boolean'],
            'options' => ['required', 'array'],
            'options.*' => ['exists:options,id'],
         'images' => 'nullable|array',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
