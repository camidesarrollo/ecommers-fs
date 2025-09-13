<?php

namespace App\Application\DTOs;

class ProductVariantPriceHistoryFilterDTO
{
    public function __construct(
        public readonly ?int $id = null,                    // Filtrar por ID del historial
        public readonly ?int $productVariantId = null,      // Filtrar por variante de producto
        public readonly ?float $minPrice = null,            // Precio mínimo
        public readonly ?float $maxPrice = null,            // Precio máximo
        public readonly ?float $minSalePrice = null,        // Precio en oferta mínimo
        public readonly ?float $maxSalePrice = null,        // Precio en oferta máximo
        public readonly ?\DateTimeImmutable $startDateFrom = null, // Fecha de inicio desde
        public readonly ?\DateTimeImmutable $startDateTo = null,   // Fecha de inicio hasta
        public readonly ?\DateTimeImmutable $endDateFrom = null,   // Fecha de fin desde
        public readonly ?\DateTimeImmutable $endDateTo = null,     // Fecha de fin hasta
        public readonly ?string $reason = null               // Filtrar por motivo
    ) {}

    /**
     * Crear DTO desde array
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['product_variant_id'] ?? null,
            $data['min_price'] ?? null,
            $data['max_price'] ?? null,
            $data['min_sale_price'] ?? null,
            $data['max_sale_price'] ?? null,
            isset($data['start_date_from']) ? new \DateTimeImmutable($data['start_date_from']) : null,
            isset($data['start_date_to']) ? new \DateTimeImmutable($data['start_date_to']) : null,
            isset($data['end_date_from']) ? new \DateTimeImmutable($data['end_date_from']) : null,
            isset($data['end_date_to']) ? new \DateTimeImmutable($data['end_date_to']) : null,
            $data['reason'] ?? null
        );
    }

    /**
     * Convertir DTO a array
     */
    public function toArray(): array
    {
        return [
            'id'                  => $this->id,
            'product_variant_id'  => $this->productVariantId,
            'min_price'           => $this->minPrice,
            'max_price'           => $this->maxPrice,
            'min_sale_price'      => $this->minSalePrice,
            'max_sale_price'      => $this->maxSalePrice,
            'start_date_from'     => $this->startDateFrom?->format('Y-m-d H:i:s'),
            'start_date_to'       => $this->startDateTo?->format('Y-m-d H:i:s'),
            'end_date_from'       => $this->endDateFrom?->format('Y-m-d H:i:s'),
            'end_date_to'         => $this->endDateTo?->format('Y-m-d H:i:s'),
            'reason'              => $this->reason,
        ];
    }
}
