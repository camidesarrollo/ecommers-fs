<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class ListaProducto extends Model
{
    // Nombre de la tabla/vista en la BD
    protected $table = 'lista_productos';

    // Como es una vista, probablemente no tenga timestamps (created_at, updated_at)
    public $timestamps = false;

    // Si tu vista no tiene clave primaria, desactiva la protección
    protected $primaryKey = null;
    public $incrementing = false;
}
