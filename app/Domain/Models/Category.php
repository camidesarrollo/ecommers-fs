<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Campos que se pueden asignar masivamente
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',   // 👈 agrega este si lo tienes en la DB
        'image',
        'bg_class',
        'sort_order',
        'is_active',
        'parent_id',
        'is_new',              // 👈 también si lo tienes en la DB
        'create_at',
        'update_at'
    ];

    /**
     * Relación: categoría padre
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Relación: subcategorías
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Relación: productos
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
