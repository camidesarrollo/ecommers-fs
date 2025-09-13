<?php

namespace App\Http\Requests\ProductVariantPriceHistory;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariantPriceHistoryIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Permite a cualquier usuario autenticado listar registros
        return true;
    }

    public function rules(): array
    {
        return [
            'id'                  => ['nullable', 'integer', 'exists:product_variant_price_history,id'],
            'product_variant_id'  => ['nullable', 'integer', 'exists:product_variants,id'],
            'min_price'           => ['nullable', 'numeric', 'min:0'],
            'max_price'           => ['nullable', 'numeric', 'min:0'],
            'min_sale_price'      => ['nullable', 'numeric', 'min:0'],
            'max_sale_price'      => ['nullable', 'numeric', 'min:0'],
            'start_date_from'     => ['nullable', 'date'],
            'start_date_to'       => ['nullable', 'date'],
            'end_date_from'       => ['nullable', 'date'],
            'end_date_to'         => ['nullable', 'date'],
            'reason'              => ['nullable', 'string', 'max:255'],
            'order_by'            => ['nullable', 'in:id,price,sale_price,start_date,end_date,created_at,updated_at'],
            'order_direction'     => ['nullable', 'in:asc,desc'],
            'per_page'            => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists'                  => 'El historial de precio seleccionado no existe.',
            'product_variant_id.exists'  => 'La variante de producto seleccionada no existe.',
            'order_by.in'                => 'El campo de ordenamiento no es válido.',
            'order_direction.in'         => 'La dirección de orden debe ser asc o desc.',
        ];
    }
}
