<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $empresa1= new Empresa();
        $empresa1->emp_partida_registral='PAR_01';
        $empresa1->emp_RUC='20346578391';
        $empresa1->emp_razon_social='CIELO AZUL';
        $empresa1->emp_abreviatura='CA';
        $empresa1->emp_num_inscripcion_SUNARP='NUM 001';
        $empresa1->emp_lug_inscripcion_SUNARP='CEDEÑO';
        $empresa1->emp_num_mz_km='721';
        $empresa1->emp_telefono='876437213';
        $empresa1->emp_email='cielo@gmail.com';
        $empresa1->emp_partida_electronica_SUNARP='Par-E01';
        $empresa1->emp_fec_inscripcion_SUNARP='2022-07-01';
        $empresa1->emp_nombre_via='-';
        $empresa1->emp_lote_int='-';
        $empresa1->emp_nom_urba='-';
        $empresa1->emp_URL='www.google.com.pe';
        $empresa1->emp_referencia='descampado';
        $empresa1->tipo_servicio_id=1;
        $empresa1->servicio_id=1;
        $empresa1->emp_estado=1;
        
        $empresa1->save();
    }
}
