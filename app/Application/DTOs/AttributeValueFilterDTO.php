<?php

namespace App\Application\DTOs;

class AttributeValueFilterDTO
{
    public function __construct(
        public readonly ?int $id = null,           // Filtrar por ID del atributo
        public readonly ?string $name = null,      // Filtrar por nombre del atributo (Color, Sabor, etc.)
        public readonly ?bool $isActive = null     // Filtrar atributos activos
    ) {}

    /**
     * Crear DTO desde un array (por ejemplo request validated o query params)
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['name'] ?? null,
            isset($data['is_active']) ? (bool) $data['is_active'] : null
        );
    }

    /**
     * Convertir DTO a array
     */
    public function toArray(): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'is_active' => $this->isActive,
        ];
    }
}
