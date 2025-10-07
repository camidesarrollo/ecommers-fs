<?php

namespace App\Application\DTOs;

class ProductDetailDTO
{
    public function __construct(
        public readonly int $productVariantId,
        public readonly string $typeProduct,
        public readonly string $name,
        public readonly string $variant,
        public readonly string $slug,
        public readonly string $sku,
        public readonly string $categoryName,
        public readonly float $price,
        public readonly ?string $atributos,
        public readonly bool $isActive,
        public readonly bool $isFeatured,
        public readonly string $stockStatus,
        public readonly ?string $imagen,
        public readonly string $createdAt
    ) {}

    /**
     * Crear DTO desde un array (por ejemplo: desde un modelo o query).
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['product_variant_id'],
            $data['typeProduct'],
            $data['name'],
            $data['variant'],
            $data['slug'],
            $data['sku'],
            $data['name_categoria'] ?? $data['category_name'] ?? '',
            (float) ($data['price'] ?? 0),
            $data['atributos'] ?? null,
            (bool) ($data['is_active'] ?? true),
            (bool) ($data['is_featured'] ?? false),
            $data['stock_status'] ?? 'in_stock',
            $data['imagen'] ?? null,
            $data['created_at'] ?? now()->toDateTimeString()
        );
    }

    /**
     * Convertir DTO a array para persistencia o serialización.
     */
    public function toArray(): array
    {
        return [
            'product_variant_id' => $this->productVariantId,
            'typeProduct'        => $this->typeProduct,
            'name'               => $this->name,
            'variant'            => $this->variant,
            'slug'               => $this->slug,
            'sku'                => $this->sku,
            'category_name'      => $this->categoryName,
            'price'              => $this->price,
            'atributos'          => $this->atributos,
            'is_active'          => $this->isActive,
            'is_featured'        => $this->isFeatured,
            'stock_status'       => $this->stockStatus,
            'imagen'             => $this->imagen,
            'created_at'         => $this->createdAt,
        ];
    }
}
