<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(ServicioSeeder::class);
        $this->call(MotivoBajaSeeder::class);
        $this->call(TenenciaSeeder::class);
        $this->call(TipoDocumentoSeeder::class);
        $this->call(TipoIdentificacionSeeder::class);
        $this->call(TipoServicioSeeder::class);
        $this->call(EmpresaSeeder::class);
        
    }
}
