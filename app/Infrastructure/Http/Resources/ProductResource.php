<?php

namespace App\Infrastructure\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'sku' => $this->sku,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'effective_price' => $this->effective_price,
            'stock_quantity' => $this->stock_quantity,
            'stock_status' => $this->stock_status,
            'is_in_stock' => $this->isInStock(),
            'images' => $this->images,
            'attributes' => $this->attributes,
            'weight' => $this->weight,
            'dimensions' => $this->dimensions,
            'is_featured' => $this->is_featured,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Determina si el producto está en stock.
     *
     * @return bool
     */
    public function isInStock(): bool
    {
        // Caso 1: Si manejas stock_quantity
        if (!is_null($this->stock_quantity)) {
            return $this->stock_quantity > 0;
        }

        // Caso 2: Si tienes un campo stock_status (ej: 'in_stock', 'out_of_stock')
        if (!is_null($this->stock_status)) {
            return $this->stock_status === 'in_stock';
        }

        // Por defecto: sin stock
        return false;
    }
}
