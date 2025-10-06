<?php

namespace App\Infrastructure\Http\Requests\OrderItem;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id'          => ['required', 'integer', 'exists:orders,id'],
            'product_variant_id'=> ['required', 'integer', 'exists:product_variants,id'],
            'quantity'          => ['required', 'integer', 'min:1'],
            'unit_price'        => ['required', 'numeric', 'min:0'],
            'total_price'       => ['required', 'numeric', 'min:0'],
        ];
    }
}
