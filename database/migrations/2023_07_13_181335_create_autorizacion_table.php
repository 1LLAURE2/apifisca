<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autorizacion', function (Blueprint $table) {
            $table->id();
            $table->string('aut_marco_legal',30);
            $table->string('aut_num_expediente',20);
            $table->string('aut_num_resolucion',20);
            $table->date('aut_fec_expediente');
            $table->date('aut_fec_resolucion');
            $table->string('aut_anio_vigencia',2);
            $table->string('aut_objeto_social',);
            $table->string('aut_observacion',50);
            $table->boolean('aut_estado')->default(1);

            //TODO: RELACIONES
            $table->bigInteger('empresa_id')->unsigned();
            $table->foreign('empresa_id')
                    ->references('id')
                    ->on('empresa')
                    ->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autorizacion');
    }
};
