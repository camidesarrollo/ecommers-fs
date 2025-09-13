<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'customer_id' => $this->customer_id,
            'status'      => $this->status,
            'total'       => $this->total,
            'notes'       => $this->notes,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'items'       => OrderItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
