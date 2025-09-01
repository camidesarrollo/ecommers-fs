<?php
/*
namespace App\Domain\Products\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'slug', 'description', 'short_description', 'sku',
        'price', 'sale_price', 'stock_quantity', 'manage_stock',
        'stock_status', 'images', 'attributes', 'weight', 'dimensions',
        'is_active', 'is_featured', 'category_id'
    ];
    
    protected $casts = [
        'images' => 'array',
        'attributes' => 'array',
        'dimensions' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'manage_stock' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'weight' => 'decimal:2',
    ];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function getEffectivePriceAttribute(): float
    {
        return $this->sale_price ?? $this->price;
    }
    
    public function isInStock(): bool
    {
        return $this->stock_status === 'in_stock' && 
               (!$this->manage_stock || $this->stock_quantity > 0);
    }
    
    public function reduceStock(int $quantity): void
    {
        if ($this->manage_stock) {
            $this->decrement('stock_quantity', $quantity);
            
            if ($this->stock_quantity <= 0) {
                $this->update(['stock_status' => 'out_of_stock']);
            }
        }
    }
}

*/