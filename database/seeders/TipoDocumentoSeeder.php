<?php

namespace Database\Seeders;

use App\Models\Tipo_Documento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tipo_documento1= new Tipo_Documento();
        $tipo_documento1->tdo_descripcion='RESOLUCION';
        $tipo_documento1->tdo_estado=1;
        $tipo_documento1->save();

        $tipo_documento2= new Tipo_Documento();
        $tipo_documento2->tdo_descripcion='INFORME';
        $tipo_documento2->tdo_estado=1;
        $tipo_documento2->save();
        
    }
}
