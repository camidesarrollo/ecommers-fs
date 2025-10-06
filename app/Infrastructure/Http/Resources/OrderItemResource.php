<?php

namespace App\Infrastructure\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'order_id'          => $this->order_id,
            'product_variant_id'=> $this->product_variant_id,
            'quantity'          => $this->quantity,
            'unit_price'        => $this->unit_price,
            'total_price'       => $this->total_price,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
