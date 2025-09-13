<?php

namespace App\Application\DTOs;

class ProductFilterDTO
{
    public function __construct(
        public readonly ?string $search = null,       // Búsqueda por nombre, slug, SKU, etc.
        public readonly ?int $category_id = null,      // Filtrar por categoría
        public readonly ?bool $isActive = null,       // Filtrar por estado activo
        public readonly ?bool $isFeatured = null,     // Filtrar productos destacados
        public readonly ?float $minPrice = null,      // Precio mínimo
        public readonly ?float $maxPrice = null,      // Precio máximo
        public readonly ?string $stockStatus = null,  // 'in_stock' | 'out_of_stock'
        public readonly string $orderBy = 'name',     // Orden por columna
        public readonly string $orderDirection = 'asc', // Dirección de orden: 'asc' o 'desc'
        public readonly int $perPage = 15             // Paginación
    ) {}

    /**
     * Crear DTO desde un array (request validated o query params)
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['search'] ?? null,
            $data['category_id'] ?? null,
            isset($data['is_active']) ? (bool) $data['is_active'] : null,
            isset($data['is_featured']) ? (bool) $data['is_featured'] : null,
            isset($data['min_price']) ? (float) $data['min_price'] : null,
            isset($data['max_price']) ? (float) $data['max_price'] : null,
            $data['stock_status'] ?? null,
            $data['order_by'] ?? 'name',
            $data['order_direction'] ?? 'asc',
            isset($data['per_page']) ? (int) $data['per_page'] : 15
        );
    }

    /**
     * Convertir a array (opcional)
     */
    public function toArray(): array
    {
        return [
            'search'          => $this->search,
            'category_id'     => $this->category_id,
            'is_active'       => $this->isActive,
            'is_featured'     => $this->isFeatured,
            'min_price'       => $this->minPrice,
            'max_price'       => $this->maxPrice,
            'stock_status'    => $this->stockStatus,
            'order_by'        => $this->orderBy,
            'order_direction' => $this->orderDirection,
            'per_page'        => $this->perPage,
        ];
    }
}
