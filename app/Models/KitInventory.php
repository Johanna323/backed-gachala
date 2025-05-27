<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_kit',
        'descripcion',
        'cantidad_disponible',
        'fecha_actualizacion',
    ];

    public function deliveries() {
        return $this->hasMany(Delivery::class, 'kit_id');
    }
}
