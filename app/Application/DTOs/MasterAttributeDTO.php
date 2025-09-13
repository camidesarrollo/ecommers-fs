<?php

namespace App\Application\DTOs;

class MasterAttributeDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly ?string $description,
        public readonly array $values // array de AttributeValueDTO
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['name'],
            $data['description'] ?? null,
            $data['values'] ?? []
        );
    }

    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'values'      => $this->values,
        ];
    }
}
