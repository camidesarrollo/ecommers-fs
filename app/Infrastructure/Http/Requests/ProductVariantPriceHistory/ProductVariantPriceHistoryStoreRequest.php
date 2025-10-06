<?php

namespace App\Infrastructure\Http\Requests\ProductVariantPriceHistory;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariantPriceHistoryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Cambia según tu lógica, por ejemplo solo admins o usuarios autorizados
        return true;
    }

    public function rules(): array
    {
        return [
            'product_variant_id' => ['required', 'integer', 'exists:product_variants,id'],
            'price'              => ['required', 'numeric', 'min:0'],
            'sale_price'         => ['nullable', 'numeric', 'min:0', 'lte:price'],
            'start_date'         => ['required', 'date'],
            'end_date'           => ['nullable', 'date', 'after_or_equal:start_date'],
            'reason'             => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_variant_id.required' => 'Debes seleccionar una variante de producto válida.',
            'product_variant_id.exists'   => 'La variante de producto seleccionada no existe.',
            'price.required'              => 'El precio es obligatorio.',
            'price.min'                   => 'El precio no puede ser menor a 0.',
            'sale_price.lte'              => 'El precio de oferta no puede ser mayor que el precio normal.',
            'start_date.required'         => 'La fecha de inicio es obligatoria.',
            'end_date.after_or_equal'     => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'reason.max'                  => 'La razón no puede exceder 255 caracteres.',
        ];
    }
}
