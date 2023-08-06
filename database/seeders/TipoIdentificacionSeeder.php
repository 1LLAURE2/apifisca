<?php

namespace Database\Seeders;

use App\Models\Tipo_Identificacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoIdentificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tipo_identificacion1= new Tipo_Identificacion();
        $tipo_identificacion1->tid_descripcion='DNI';
        $tipo_identificacion1->tid_estado=1;
        $tipo_identificacion1->save();

        $tipo_identificacion2= new Tipo_Identificacion();
        $tipo_identificacion2->tid_descripcion='RUC';
        $tipo_identificacion2->tid_estado=1;
        $tipo_identificacion2->save();

        $tipo_identificacion3= new Tipo_Identificacion();
        $tipo_identificacion3->tid_descripcion='CE';
        $tipo_identificacion3->tid_estado=1;
        $tipo_identificacion3->save();

        $tipo_identificacion4= new Tipo_Identificacion();
        $tipo_identificacion4->tid_descripcion='PTP';
        $tipo_identificacion4->tid_estado=1;
        $tipo_identificacion4->save();
    }
}
