<?php

namespace Database\Seeders;

use App\Models\Motivo_Baja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotivoBajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $motivoBaja1= new Motivo_Baja();
        $motivoBaja1->mba_descripcion='ANTIGUEDAD';
        $motivoBaja1->mba_estado=1;
        $motivoBaja1->save();

        $motivoBaja2= new Motivo_Baja();
        $motivoBaja2->mba_descripcion='SINIESTRO';
        $motivoBaja2->mba_estado=1;
        $motivoBaja2->save();

        $motivoBaja3= new Motivo_Baja();
        $motivoBaja3->mba_descripcion='CHATARREO';
        $motivoBaja3->mba_estado=1;
        $motivoBaja3->save();
    }
}
