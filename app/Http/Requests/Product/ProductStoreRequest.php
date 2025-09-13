<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Cambia según tu lógica (ej: solo admins pueden crear productos)
        return true;
    }

    public function rules(): array
    {
        return [
            'name'              => ['required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255', 'unique:products,slug'],
            'description'       => ['nullable', 'string'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'sku'               => ['nullable', 'string', 'max:100', 'unique:products,sku'],
            'price'             => ['required', 'numeric', 'min:0'],
            'sale_price'        => ['nullable', 'numeric', 'min:0', 'lte:price'],
            'stock_quantity'    => ['nullable', 'integer', 'min:0'],
            'manage_stock'      => ['nullable', 'boolean'],
            'stock_status'      => ['nullable', 'in:in_stock,out_of_stock'],
            'images'            => ['nullable', 'array'],
            'images.*'          => ['string', 'max:500'], // URLs o paths
            'attributes'        => ['nullable', 'array'],
            'weight'            => ['nullable', 'numeric', 'min:0'],
            'dimensions'        => ['nullable', 'array'],
            'dimensions.length' => ['nullable', 'numeric', 'min:0'],
            'dimensions.width'  => ['nullable', 'numeric', 'min:0'],
            'dimensions.height' => ['nullable', 'numeric', 'min:0'],
            'is_active'         => ['nullable', 'boolean'],
            'is_featured'       => ['nullable', 'boolean'],
            'category_id'       => ['nullable', 'integer', 'exists:categories,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'slug.unique' => 'El slug ya está en uso.',
            'sku.unique' => 'El SKU ya está en uso.',
            'sale_price.lte' => 'El precio de oferta no puede ser mayor que el precio normal.',
            'category_id.exists' => 'La categoría seleccionada no existe.',
        ];
    }
}
