<?php

namespace App\Infrastructure\Http\Requests\OrderItem;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id'   => ['nullable', 'integer', 'exists:orders,id'],
            'product_variant_id' => ['nullable', 'integer', 'exists:product_variants,id'],
            'per_page'   => ['nullable', 'integer', 'min:1'],
            'page'       => ['nullable', 'integer', 'min:1'],
        ];
    }
}
