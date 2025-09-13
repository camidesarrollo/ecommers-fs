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
        'image',
        'bg_class',
        'sort_order',
        'is_active',
        'parent_id',
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
}
