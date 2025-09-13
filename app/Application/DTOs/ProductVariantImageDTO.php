<?php

namespace App\Application\DTOs;

class ProductVariantImageDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $variantId,
        public readonly string $url,
        public readonly bool $isPrimary,
        public readonly int $order
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['variant_id'],
            $data['url'],
            (bool) ($data['is_primary'] ?? false),
            $data['order'] ?? 0
        );
    }

    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'variant_id'  => $this->variantId,
            'url'         => $this->url,
            'is_primary'  => $this->isPrimary,
            'order'       => $this->order,
        ];
    }
}
