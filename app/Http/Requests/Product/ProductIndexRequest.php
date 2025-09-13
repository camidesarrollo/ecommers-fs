<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Si quieres que solo usuarios autenticados puedan listar, cambia a true con auth check
        return true;
    }

    public function rules(): array
    {
        return [
            'search'         => ['nullable', 'string', 'max:255'],
            'category_id'    => ['nullable', 'integer', 'exists:categories,id'],
            'is_active'      => ['nullable', 'boolean'],
            'is_featured'    => ['nullable', 'boolean'],
            'min_price'      => ['nullable', 'numeric', 'min:0'],
            'max_price'      => ['nullable', 'numeric', 'min:0'],
            'stock_status'   => ['nullable', 'in:in_stock,out_of_stock'],
            'order_by'       => ['nullable', 'in:id,name,price,created_at,updated_at'],
            'order_direction'=> ['nullable', 'in:asc,desc'],
            'per_page'       => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'stock_status.in' => 'El estado de stock debe ser in_stock o out_of_stock.',
            'order_by.in' => 'El campo de ordenamiento no es válido.',
            'order_direction.in' => 'La dirección de orden debe ser asc o desc.',
        ];
    }
}
