<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'id' => 1,
                'nombre' => 'admin',
                'descripcion' => 'permisos administrador',
                'created_at' => '2025-05-26 01:44:42',
                'updated_at' => '2025-05-26 02:01:06',
                'ruta' => '/home,/usuarios,/permisos,/roles,/beneficiarios,/inventarios,/entregas,/mis-entregas,/perfil',
            ],
            [
                'id' => 2,
                'nombre' => 'beneficiario',
                'descripcion' => 'beneficiario',
                'created_at' => '2025-05-26 02:00:31',
                'updated_at' => '2025-05-26 02:01:18',
                'ruta' => '/home,/mis-entregas,/perfil',
            ],
            [
                'id' => 3,
                'nombre' => 'funcionario',
                'descripcion' => 'permisos funcionario',
                'created_at' => '2025-05-26 02:02:05',
                'updated_at' => '2025-05-26 02:02:05',
                'ruta' => '/home,/beneficiarios,/inventarios,/entregas,/perfil',
            ],
        ]);
    }
} 