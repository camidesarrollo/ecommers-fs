<?php

namespace App\Application\Products\DTOs;

class ProductFilterDTO
{
    public function __construct(
        public readonly ?string $search,
        public readonly ?int $categoryId,
        public readonly ?bool $isActive,
        public readonly ?bool $isFeatured,
        public readonly ?float $minPrice,
        public readonly ?float $maxPrice,
        public readonly ?string $stockStatus,
        public readonly ?string $orderBy,
        public readonly ?string $orderDirection,
        public readonly int $perPage = 15,
    ) {}

    public static function fromArray(array $data): self
    {
        $direction = strtolower($data['order_direction'] ?? 'asc');
        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        return new self(
            $data['search'] ?? null,
            isset($data['category_id']) ? (int) $data['category_id'] : null,
            isset($data['is_active']) ? (bool) $data['is_active'] : null,
            isset($data['is_featured']) ? (bool) $data['is_featured'] : null,
            isset($data['min_price']) ? (float) $data['min_price'] : null,
            isset($data['max_price']) ? (float) $data['max_price'] : null,
            $data['stock_status'] ?? null,
            $data['order_by'] ?? 'id', // 👈 por defecto, ordena por ID
            $direction,                // 👈 normalizado a asc/desc
            $data['per_page'] ?? 16,
        );
    }
}
