<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramaSeeder extends Seeder
{
    public function run()
    {
        DB::table('programas')->insert([
            ['nombre' => 'NBI', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'ADULTO MAYOR', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'DISCAPACIDAD', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'VICTIMA DEL CONFLICTO', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
} 