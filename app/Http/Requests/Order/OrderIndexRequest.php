<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ajusta según tu lógica de permisos
    }

    public function rules(): array
    {
        return [
            'status'      => ['nullable', 'string', 'max:50'],
            'customer_id' => ['nullable', 'integer', 'exists:customers,id'],
            'created_from'=> ['nullable', 'date'],
            'created_to'  => ['nullable', 'date'],
            'per_page'    => ['nullable', 'integer', 'min:1'],
            'page'        => ['nullable', 'integer', 'min:1'],
        ];
    }
}
