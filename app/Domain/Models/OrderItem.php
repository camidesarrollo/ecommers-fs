<?php

namespace App\Domain\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_variant_id',
        'quantity',
        'unit_price',
        'total_price',
        'product_snapshot',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // === RELACIONES ===

    // Un ítem pertenece a una orden
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Un ítem pertenece a un producto variante
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
