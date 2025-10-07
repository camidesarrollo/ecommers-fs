<?php

namespace App\Infrastructure\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transforma el recurso en un array para respuesta JSON.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'product_variant_id' => $this->product_variant_id,
            'type_product'       => $this->typeProduct ?? $this->type_product ?? null,
            'name'               => $this->name,
            'variant'            => $this->variant,
            'slug'               => $this->slug,
            'sku'                => $this->sku,
            'category_id'       => $this->category_id,
            'category_name'      => $this->name_categoria ?? $this->category_name ?? null,
            'price'              => (float) $this->price,
            'atributos'          => $this->atributos,
            'is_active'          => (bool) $this->is_active,
            'is_featured'        => (bool) $this->is_featured,
            'stock_status'       => $this->stock_status,
            'is_in_stock'        => $this->isInStock(),
            'imagen'             => $this->imagen ? asset($this->imagen) : null,
            'created_at'         => $this->created_at,
        ];
    }

    /**
     * Determina si el producto está en stock.
     *
     * @return bool
     */
    public function isInStock(): bool
    {
        if (!is_null($this->stock_status)) {
            return $this->stock_status === 'in_stock';
        }

        return false;
    }
}
