<?php

namespace App\Infrastructure\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ProductVariantPriceHistoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                 => $this->id,
            'product_variant_id' => $this->product_variant_id,
            'price'              => $this->parsePrice($this->price),
            'sale_price'         => $this->parsePrice($this->sale_price),
            'start_date'         => $this->start_date ? Carbon::parse($this->start_date)->format('Y-m-d H:i:s') : null,
            'end_date'           => $this->end_date ? Carbon::parse($this->end_date)->format('Y-m-d H:i:s') : null,
            'reason'             => $this->reason,
            'created_at'         => $this->created_at ? Carbon::parse($this->created_at)->format('Y-m-d H:i:s') : null,
            'updated_at'         => $this->updated_at ? Carbon::parse($this->updated_at)->format('Y-m-d H:i:s') : null,
            'sku'                => $this->sku,
            'imagen'             => $this->imagen,
            'typeProduct'        => $this->typeProduct,
            'variant'            => $this->variant,
            'name'               => $this->name,
            'slug'               => $this->slug,
            'stock_status'       => $this->stock_status,
            'stock_quantity'     => $this->stock_quantity
        ];
    }

    /**
     * Convierte strings de precio locales a float
     */
    private function parsePrice(string|null $price): ?float
    {
        if ($price === null) return null;

        // Si el precio viene con punto de miles y coma decimal "5.500,75" -> "5500.75"
        $normalized = str_replace(['.', ','], ['', '.'], $price);

        return (float) $normalized;
    }
}
