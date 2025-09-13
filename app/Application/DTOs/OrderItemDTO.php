<?php

namespace App\Application\DTOs;

class OrderItemDTO
{
    public ?int $id;
    public int $order_id;
    public int $product_variant_id;
    public int $quantity;
    public float $unit_price;
    public float $total_price;
    public ?array $product_snapshot;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->order_id = $data['order_id'];
        $this->product_variant_id = $data['product_variant_id'];
        $this->quantity = $data['quantity'];
        $this->unit_price = $data['unit_price'];
        $this->total_price = $data['total_price'];
        $this->product_snapshot = $data['product_snapshot'] ?? null;
    }

    public static function fromArray(array $data): self
    {
        return new self([
            'id'                => $data['id'] ?? null,
            'order_id'          => $data['order_id'],
            'product_variant_id'=> $data['product_variant_id'],
            'quantity'          => $data['quantity'],
            'unit_price'        => $data['unit_price'],
            'total_price'       => $data['total_price'],
            'product_snapshot'  => $data['product_snapshot'] ?? null,
        ]);
    }

    public function toArray(): array
    {
        return [
            'id'                 => $this->id,
            'order_id'           => $this->order_id,
            'product_variant_id' => $this->product_variant_id,
            'quantity'           => $this->quantity,
            'unit_price'         => $this->unit_price,
            'total_price'        => $this->total_price,
            'product_snapshot'   => $this->product_snapshot,
        ];
    }
}
