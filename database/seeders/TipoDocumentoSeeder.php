<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocumentoSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo_documentos')->insert([
            [
                'id' => 1,
                'nombre' => 'Cédula de Ciudadanía',
                'created_at' => '2025-05-19 22:53:52',
                'updated_at' => '2025-05-19 22:53:52'
            ],
            [
                'id' => 2,
                'nombre' => 'Cédula de Extranjería',
                'created_at' => '2025-05-19 22:53:52',
                'updated_at' => '2025-05-19 22:53:52'
            ],
            [
                'id' => 3,
                'nombre' => 'Pasaporte',
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 4,
                'nombre' => 'NIT',
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 5,
                'nombre' => 'Permiso Especial de Permanencia',
                'created_at' => null,
                'updated_at' => null
            ]
        ]);
    }
} 