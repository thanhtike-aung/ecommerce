<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => [
                'required',
                Rule::unique('products', 'name')->whereNull('deleted_at'),
                'max:255'
            ],
            'slug' => [
                'required',
                Rule::unique('products', 'slug')->whereNull('deleted_at'),
                'max:255'
            ],
            'sku' => [
                'required',
                Rule::unique('products', 'sku')->whereNull('deleted_at'),
                'max:50'
            ],
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'short_description' => 'required|string|max:500',
            'long_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_qty' => 'required|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
            'status' => 'required|boolean',
            'featured' => 'boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
