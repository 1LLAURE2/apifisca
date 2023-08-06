<?php

namespace Database\Seeders;

use App\Models\Tipo_Servicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tipo_servicio= new Tipo_Servicio();
        $tipo_servicio->tse_descripcion='PERSONAS';
        $tipo_servicio->tse_estado=1;
        $tipo_servicio->save();

        $tipo_servicio1= new Tipo_Servicio();
        $tipo_servicio1->tse_descripcion='MERCANCIAS';
        $tipo_servicio1->tse_estado=1;
        $tipo_servicio1->save();

        $tipo_servicio2= new Tipo_Servicio();
        $tipo_servicio2->tse_descripcion='TURISMO';
        $tipo_servicio2->tse_estado=1;
        $tipo_servicio2->save();
        
    }
}
