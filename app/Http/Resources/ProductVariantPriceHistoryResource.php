<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantPriceHistoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                 => $this->id,
            'product_variant_id' => $this->product_variant_id,
            'sku'                => $this->sku ?? optional($this->variant)->sku,
            'product_name'       => $this->product_name ?? optional(optional($this->variant)->product)->product_name,
            'price'              => $this->price,
            'sale_price'         => $this->sale_price,
            'start_date'         => $this->start_date,
            'end_date'           => $this->end_date,
            'reason'             => $this->reason,
            'created_at'         => $this->created_at,
            'updated_at'         => $this->updated_at,
            'variant'            => $this->whenLoaded('variant', function () {
                return [
                    'id'         => $this->variant->id,
                    'sku'        => $this->variant->sku,
                    'price'      => $this->variant->price,
                    'stock'      => $this->variant->stock,
                    'attributes' => $this->variant->attributes,
                ];
            }),
            'product' => $this->whenLoaded('variant.product', function () {
                return [
                    'id'   => $this->variant->product->id,
                    'name' => $this->variant->product->product_name,
                    'slug' => $this->variant->product->slug,
                ];
            }),
        ];
    }
}
