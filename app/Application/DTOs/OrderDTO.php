<?php

namespace App\Application\DTOs;

class OrderDTO
{
    public ?int $id;
    public int $user_id;
    public string $status;
    public float $total_amount;
    public ?string $notes;
    public ?string $shipping_address;
    public ?string $billing_address;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->user_id = $data['user_id'];
        $this->status = $data['status'] ?? 'pending';
        $this->total_amount = $data['total_amount'];
        $this->notes = $data['notes'] ?? null;
        $this->shipping_address = $data['shipping_address'] ?? null;
        $this->billing_address = $data['billing_address'] ?? null;
    }

    public static function fromArray(array $data): self
    {
        return new self([
            'id'               => $data['id'] ?? null,
            'user_id'          => $data['user_id'],
            'status'           => $data['status'] ?? 'pending',
            'total_amount'     => $data['total_amount'],
            'notes'            => $data['notes'] ?? null,
            'shipping_address' => $data['shipping_address'] ?? null,
            'billing_address'  => $data['billing_address'] ?? null,
        ]);
    }

    public function toArray(): array
    {
        return [
            'id'               => $this->id,
            'user_id'          => $this->user_id,
            'status'           => $this->status,
            'total_amount'     => $this->total_amount,
            'notes'            => $this->notes,
            'shipping_address' => $this->shipping_address,
            'billing_address'  => $this->billing_address,
        ];
    }
}
