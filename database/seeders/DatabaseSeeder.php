<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            TipoDocumentoSeeder::class,
            GeneroSeeder::class,
            RoleSeeder::class,
            ProgramaSeeder::class,
            SectorSeeder::class,
            PermissionSeeder::class,
            // Agrega aquí todos tus seeders
        ]);
    }
}
