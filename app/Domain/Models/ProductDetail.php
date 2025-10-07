<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    /**
     * Nombre de la vista en la base de datos.
     */
    protected $table = 'product_details_view';

    /**
     * Indica que este modelo no tiene timestamps (created_at, updated_at).
     */
    public $timestamps = false;

    /**
     * Como es una vista, no hay una clave primaria autoincremental real.
     */
    protected $primaryKey = null;
    public $incrementing = false;

    /**
     * Se pueden acceder a todos los campos sin restricción.
     */
    protected $guarded = [];
}
