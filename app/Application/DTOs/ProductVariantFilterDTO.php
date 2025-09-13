<?php

namespace App\Application\DTOs;

class ProductVariantFilterDTO
{
    public function __construct(
        public readonly ?int $id = null,                   // Filtrar por ID de la variante
        public readonly ?int $productId = null,            // Filtrar variantes de un producto específico
        public readonly ?float $minPrice = null,           // Precio mínimo
        public readonly ?float $maxPrice = null,           // Precio máximo
        public readonly ?int $minStock = null,             // Stock mínimo
        public readonly ?int $maxStock = null,             // Stock máximo
        public readonly ?array $attributeValues = null     // Array de AttributeValueFilterDTO para filtrar por atributos
    ) {}

    /**
     * Crear DTO desde array
     */
    public static function fromArray(array $data): self
    {
        $attributeValues = [];
        if (!empty($data['attribute_values']) && is_array($data['attribute_values'])) {
            foreach ($data['attribute_values'] as $attr) {
                $attributeValues[] = AttributeValueFilterDTO::fromArray($attr);
            }
        }

        return new self(
            $data['id'] ?? null,
            $data['product_id'] ?? null,
            $data['min_price'] ?? null,
            $data['max_price'] ?? null,
            $data['min_stock'] ?? null,
            $data['max_stock'] ?? null,
            $attributeValues ?: null
        );
    }

    /**
     * Convertir DTO a array
     */
    public function toArray(): array
    {
        $attrs = [];
        if (!empty($this->attributeValues)) {
            foreach ($this->attributeValues as $attr) {
                $attrs[] = $attr->toArray();
            }
        }

        return [
            'id'               => $this->id,
            'product_id'       => $this->productId,
            'min_price'        => $this->minPrice,
            'max_price'        => $this->maxPrice,
            'min_stock'        => $this->minStock,
            'max_stock'        => $this->maxStock,
            'attribute_values' => $attrs
        ];
    }
}
