<?php

namespace App\Infrastructure\Http\Requests\ProductVariantPriceHistory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductVariantPriceHistoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Cambiar según tu lógica, por ejemplo solo admins o usuarios autorizados
        return true;
    }

    public function rules(): array
    {
        $historyId = $this->route('id'); // asumiendo que la ruta es /price-history/{id}

        return [
            'product_variant_id' => [
                'required',
                'integer',
                'exists:product_variants,id',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'sale_price' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:price',
            ],
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],
            'reason' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'product_variant_id.required' => 'La variante del producto es obligatoria.',
            'product_variant_id.exists' => 'La variante del producto seleccionada no existe.',
            'price.required' => 'El precio es obligatorio.',
            'price.min' => 'El precio debe ser mayor o igual a 0.',
            'sale_price.lte' => 'El precio de oferta no puede ser mayor que el precio normal.',
            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'end_date.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'reason.max' => 'La razón no puede exceder los 255 caracteres.',
        ];
    }
}
