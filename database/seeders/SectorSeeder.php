<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
    public function run()
    {
        DB::table('sectores')->insert([
            ['nombre' => 'EL DIAMANTE', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'GUACAMAYAS', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'SANTA RITA DEL RÍO NEGRO', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'PALOMAS', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'LA FLORIDA', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'FRIJOLITO', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'MONTECRISTO', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'PIEDRA GORDA', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'SINAI', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'MURCA', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'TUNJITA', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'BOCADEMONTE', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'SAN ISIDRO', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'SANTA HELENA', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'GUAVIO PORTOBELO', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'LA DIANA', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'LOS ANDES', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'TENA', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'ESCOBAL', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'GUARUMAL', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'CASCADAS', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'SAN ROQUE', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'MESITAS', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'TENDIDOS DE GUAVIO', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'TENDIDOS DE RÍO NEGRO', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'CRUCERO', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'LA VEGA DE SAN JUAN', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'DIAMANTE', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'TUNJA', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'CENTRO URBANO', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'CENTRO RURA', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
} 