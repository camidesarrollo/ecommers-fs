<?php

namespace App\Application\DTOs;

class ProductVariantImageFilterDTO
{
    public function __construct(
        public readonly ?int $id = null,               // Filtrar por ID de la imagen
        public readonly ?int $productVariantId = null, // Filtrar por variante específica
        public readonly ?bool $isPrimary = null,       // Filtrar si es imagen principal
        public readonly ?string $type = null           // Tipo de imagen (ej: 'thumbnail', 'gallery')
    ) {}

    /**
     * Crear DTO desde array
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['product_variant_id'] ?? null,
            isset($data['is_primary']) ? (bool)$data['is_primary'] : null,
            $data['type'] ?? null
        );
    }

    /**
     * Convertir DTO a array
     */
    public function toArray(): array
    {
        return [
            'id'                 => $this->id,
            'product_variant_id' => $this->productVariantId,
            'is_primary'         => $this->isPrimary,
            'type'               => $this->type
        ];
    }
}
