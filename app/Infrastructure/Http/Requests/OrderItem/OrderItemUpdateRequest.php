<?php

namespace App\Infrastructure\Http\Requests\OrderItem;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity'    => ['sometimes', 'integer', 'min:1'],
            'unit_price'  => ['sometimes', 'numeric', 'min:0'],
            'total_price' => ['sometimes', 'numeric', 'min:0'],
        ];
    }
}
