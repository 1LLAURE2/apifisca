<?php

namespace Database\Seeders;

use App\Models\Tenencia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //PROPIO-SIN TENENCIA
        $tenencia1= new Tenencia();
        $tenencia1->ten_descripcion='PROPIO';
        $tenencia1->ten_estado=1;
        $tenencia1->save();

        $tenencia2= new Tenencia();
        $tenencia2->ten_descripcion='SIN TENENCIA';
        $tenencia2->ten_estado=1;
        $tenencia2->save();
    }
}
