<?php

namespace App\Application\DTOs;

class MasterAttributeFilterDTO
{
    public function __construct(
        public readonly ?int $attributeId = null,   // Filtrar por atributo (Color, Sabor, Formato, etc.)
        public readonly ?string $value = null,      // Filtrar por valor específico (Rojo, 300g, Amargas, etc.)
        public readonly ?bool $isActive = null      // Filtrar valores activos
    ) {}

    /**
     * Crear DTO desde un array (por ejemplo request validated o query params)
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['attribute_id'] ?? null,
            $data['value'] ?? null,
            isset($data['is_active']) ? (bool) $data['is_active'] : null
        );
    }

    /**
     * Convertir DTO a array
     */
    public function toArray(): array
    {
        return [
            'attribute_id' => $this->attributeId,
            'value'        => $this->value,
            'is_active'    => $this->isActive,
        ];
    }
}
