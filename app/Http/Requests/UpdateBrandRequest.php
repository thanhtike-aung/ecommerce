<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest
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
        $brand = $this->route('brand');

        return [
            'name' => [
                'required',
                Rule::unique('brands', 'name')->ignore($brand->id)->whereNull('deleted_at'),
                'max:255'
            ],
            'slug' => [
                'required',
                Rule::unique('brands', 'slug')->ignore($brand->id)->whereNull('deleted_at'),
                'max:255'
            ],
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            'featured' => 'boolean',
            'sort' => 'nullable|integer|min:0'
        ];
    }
}
