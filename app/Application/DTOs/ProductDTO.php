<?php

namespace App\Application\DTOs;

class ProductDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $slug,
        public readonly ?string $description,
        public readonly ?string $shortDescription,
        public readonly bool $isActive,
        public readonly bool $isFeatured,
        public readonly int $categoryId,
        public readonly array $variants // array de ProductVariantDTO
    ) {}

    /**
     * Crear DTO desde un array (por ejemplo: request validated).
     */
    public static function fromArray(array $data): self
    {
        $variants = [];
        if (!empty($data['variants'])) {
            foreach ($data['variants'] as $variant) {
                $variants[] = ProductVariantDTO::fromArray($variant);
            }
        }

        return new self(
            $data['id'] ?? null,
            $data['name'],
            $data['slug'],
            $data['description'] ?? null,
            $data['short_description'] ?? null,
            (bool) ($data['is_active'] ?? true),
            (bool) ($data['is_featured'] ?? false),
            $data['category_id'],
            $variants
        );
    }

    /**
     * Convertir DTO a array para persistencia o serialización.
     */
    public function toArray(): array
    {
        $variantsArray = [];
        foreach ($this->variants as $variant) {
            $variantsArray[] = $variant->toArray();
        }

        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'slug'             => $this->slug,
            'description'      => $this->description,
            'short_description'=> $this->shortDescription,
            'is_active'        => $this->isActive,
            'is_featured'      => $this->isFeatured,
            'category_id'      => $this->categoryId,
            'variants'         => $variantsArray
        ];
    }
}
