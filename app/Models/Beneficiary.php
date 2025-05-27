<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'estado_validacion',
        'programa_id',
        'fecha_registro',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function deliveries() {
        return $this->hasMany(Delivery::class);
    }
    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }
}
