<?php

namespace App\Application\DTOs;

class AtrributeValueDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $attributeId,
        public readonly string $value
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['attribute_id'],
            $data['value']
        );
    }

    public function toArray(): array
    {
        return [
            'id'           => $this->id,
            'attribute_id' => $this->attributeId,
            'value'        => $this->value,
        ];
    }
}
