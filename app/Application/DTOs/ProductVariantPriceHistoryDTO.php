<?php

namespace App\Application\DTOs;

class ProductVariantPriceHistoryDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $productVariantId,
        public readonly float $price,
        public readonly ?float $salePrice,
        public readonly \DateTimeImmutable $startDate,
        public readonly ?\DateTimeImmutable $endDate,
        public readonly ?string $reason
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['product_variant_id'],
            (float) $data['price'],
            isset($data['sale_price']) ? (float) $data['sale_price'] : null,
            new \DateTimeImmutable($data['start_date']),
            isset($data['end_date']) ? new \DateTimeImmutable($data['end_date']) : null,
            $data['reason'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'id'                 => $this->id,
            'product_variant_id' => $this->productVariantId,
            'price'              => $this->price,
            'sale_price'         => $this->salePrice,
            'start_date'         => $this->startDate->format('Y-m-d H:i:s'),
            'end_date'           => $this->endDate?->format('Y-m-d H:i:s'),
            'reason'             => $this->reason,
        ];
    }
}
