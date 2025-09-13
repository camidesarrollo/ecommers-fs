<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function values()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id');
    }
}