<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'correo',
        'contrasena',
        'numero_documento',
        'telefono',
        'direccion',
        'municipio',
        'departamento',
        'pais',
        'fecha_nacimiento',
        'activo',
        'tipo_documento_id',
        'genero_id',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'contrasena',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relaciones
    public function roles() {
        return $this->belongsToMany(Role::class, 'user_role');
    }
    public function documents() {
        return $this->hasMany(UserDocument::class);
    }
    public function beneficiary() {
        return $this->hasOne(Beneficiary::class);
    }
    public function deliveries() {
        return $this->hasMany(Delivery::class, 'funcionario_entrega');
    }
    public function audits() {
        return $this->hasMany(Audit::class);
    }
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }
    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
