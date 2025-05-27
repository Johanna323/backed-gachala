<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['nombre' => 'admin', 'descripcion' => 'Administrador del sistema', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'beneficiario', 'descripcion' => 'Usuario beneficiario del sistema', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'funcionario', 'descripcion' => 'Funcionario encargado de la gestión', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'inventario', 'descripcion' => 'Responsable de inventario', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
} 