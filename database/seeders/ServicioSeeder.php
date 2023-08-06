<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // for ($i=0; $i<5; $i++){
        //     Servicio::create([
        //         'ser_descripcion'   =>	'Servicio ' . $i,
        //         'ser_estado'        =>	1
        //     ]);
        // }
        $servicio1= new Servicio();
        $servicio1->ser_descripcion='PUBLICO';
        $servicio1->ser_estado=1;
        $servicio1->save();

        $servicio2= new Servicio();
        $servicio2->ser_descripcion='PRIVADO';
        $servicio2->ser_estado=2;
        $servicio2->save();
    }
}
