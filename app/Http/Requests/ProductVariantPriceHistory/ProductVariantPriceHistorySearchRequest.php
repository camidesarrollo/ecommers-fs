<?php

namespace App\Http\Requests\ProductVariantPriceHistory;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariantPriceHistorySearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Cambiar según tu lógica, por ejemplo solo admins o usuarios autorizados
        return true;
    }

    public function rules(): array
    {
        return [
            'product_variant_id' => 'sometimes|integer|exists:product_variants,id',
            'min_price'          => 'sometimes|numeric|min:0',
            'max_price'          => 'sometimes|numeric|min:0',
            'min_sale_price'     => 'sometimes|numeric|min:0',
            'max_sale_price'     => 'sometimes|numeric|min:0',
            'start_date_from'    => 'sometimes|date',
            'start_date_to'      => 'sometimes|date',
            'end_date_from'      => 'sometimes|date',
            'end_date_to'        => 'sometimes|date',
            'reason'             => 'sometimes|string|max:255',
        ];
    }
}
