<?php

namespace App\Application\Products\DTOs;

class ProductDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly ?string $shortDescription,
        public readonly string $sku,
        public readonly float $price,
        public readonly ?float $salePrice,
        public readonly int $stockQuantity,
        public readonly bool $manageStock,
        public readonly string $stockStatus,
        public readonly array $images,
        public readonly array $attributes,
        public readonly ?float $weight,
        public readonly ?array $dimensions,
        public readonly bool $isActive,
        public readonly bool $isFeatured,
        public readonly int $categoryId
    ) {}
    
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'short_description' => $this->shortDescription,
            'sku' => $this->sku,
            'price' => $this->price,
            'sale_price' => $this->salePrice,
            'stock_quantity' => $this->stockQuantity,
            'manage_stock' => $this->manageStock,
            'stock_status' => $this->stockStatus,
            'images' => $this->images,
            'attributes' => $this->attributes,
            'weight' => $this->weight,
            'dimensions' => $this->dimensions,
            'is_active' => $this->isActive,
            'is_featured' => $this->isFeatured,
            'category_id' => $this->categoryId,
        ];
    }
}