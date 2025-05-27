<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficiary_id',
        'kit_id',
        'fecha_entrega',
        'funcionario_entrega',
        'observaciones',
        'estado',
        'sector_id',
    ];

    public function beneficiary() {
        return $this->belongsTo(Beneficiary::class);
    }
    public function kit() {
        return $this->belongsTo(KitInventory::class, 'kit_id');
    }
    public function funcionario() {
        return $this->belongsTo(User::class, 'funcionario_entrega');
    }
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
