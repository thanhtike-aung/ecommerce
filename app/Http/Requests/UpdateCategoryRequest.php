<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
        $category = $this->route('category');

        return [
            'name' => [
                'required',
                Rule::unique('categories', 'name')->ignore($category->id)->whereNull('deleted_at'),
                'max:255'
            ],
            'slug' => [
                'required',
                Rule::unique('categories', 'slug')->ignore($category->id)->whereNull('deleted_at'),
                'max:255'
            ],
            'parent_id' => [
                'nullable',
                Rule::exists('categories', 'id')->whereNot('id', $category->id),
            ],
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            'featured' => 'boolean',
            'sort' => 'nullable|integer|min:0'
        ];
    }
}
