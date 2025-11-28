<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'status' => 'nullable|string|in:pending,processing,completed,cancelled,refunded',
            'payment_status' => 'nullable|string|in:pending,paid,failed,refunded',
            'payment_method' => 'nullable|string|max:100',
            'total_amount' => 'nullable|numeric|min:0',
            'shipping_address' => 'nullable|string|max:500',
            'billing_address' => 'nullable|string|max:500',
            'shipping_method' => 'nullable|string|max:100',
            'tracking_number' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:1000',

            // Order items
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.options' => 'nullable|json',
        ];
    }
}
