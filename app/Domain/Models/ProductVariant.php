<?php

namespace App\Domain\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'price',
        'sale_price',
        'stock_quantity',
        'manage_stock',
        'stock_status',
        'weight',
        'dimensions'
    ];

    protected $casts = [
        'dimensions' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_variant_attributes', 'variant_id', 'value_id');
    }

    public function images()
    {
        return $this->hasMany(ProductVariantImage::class, 'variant_id');
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductVariantImage::class, 'variant_id')->where('is_primary', true);
    }
}