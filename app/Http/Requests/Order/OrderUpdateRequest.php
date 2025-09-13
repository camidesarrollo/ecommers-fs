<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['sometimes', 'string', 'max:50'],
            'total'  => ['sometimes', 'numeric', 'min:0'],
            'notes'  => ['nullable', 'string'],
        ];
    }
}
