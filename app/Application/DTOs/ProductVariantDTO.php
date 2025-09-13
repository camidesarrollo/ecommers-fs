<?php

namespace App\Application\DTOs;

class ProductVariantDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?int $productId,
        public readonly string $sku,
        public readonly float $price,
        public readonly ?float $salePrice,
        public readonly int $stockQuantity,
        public readonly bool $manageStock,
        public readonly string $stockStatus,
        public readonly ?float $weight,
        public readonly ?array $dimensions,
        public readonly array $attributes, // array de AttributeValueDTO
        public readonly array $images // array de ProductVariantImageDTO
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['product_id'] ?? null,
            $data['sku'],
            (float) $data['price'],
            isset($data['sale_price']) ? (float) $data['sale_price'] : null,
            $data['stock_quantity'] ?? 0,
            (bool) ($data['manage_stock'] ?? true),
            $data['stock_status'] ?? 'in_stock',
            isset($data['weight']) ? (float) $data['weight'] : null,
            $data['dimensions'] ?? null,
            $data['attributes'] ?? [],
            $data['images'] ?? []
        );
    }

    public function toArray(): array
    {
        return [
            'id'             => $this->id,
            'product_id'     => $this->productId,
            'sku'            => $this->sku,
            'price'          => $this->price,
            'sale_price'     => $this->salePrice,
            'stock_quantity' => $this->stockQuantity,
            'manage_stock'   => $this->manageStock,
            'stock_status'   => $this->stockStatus,
            'weight'         => $this->weight,
            'dimensions'     => $this->dimensions,
            'attributes'     => $this->attributes,
            'images'         => $this->images,
        ];
    }
}
