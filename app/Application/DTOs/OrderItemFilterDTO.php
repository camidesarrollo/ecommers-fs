<?php

namespace App\Application\DTOs;

class OrderItemFilterDTO
{
    public ?int $order_id;
    public ?int $product_variant_id;
    public ?int $perPage;
    public ?int $page;

    public function __construct(array $filters = [])
    {
        $this->order_id = $filters['order_id'] ?? null;
        $this->product_variant_id = $filters['product_variant_id'] ?? null;
        $this->perPage = $filters['per_page'] ?? 15;
        $this->page = $filters['page'] ?? 1;
    }

    public function toArray(): array
    {
        return [
            'order_id'          => $this->order_id,
            'product_variant_id'=> $this->product_variant_id,
            'perPage'           => $this->perPage,
            'page'              => $this->page,
        ];
    }
}
