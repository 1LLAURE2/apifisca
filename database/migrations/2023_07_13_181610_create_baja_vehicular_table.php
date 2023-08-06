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
        Schema::create('baja_vehicular', function (Blueprint $table) {
            $table->id();

            $table->string('baj_num_documento',6);
            $table->string('baj_num_resolucion',6);
            $table->date('baj_fec_documento');
            $table->date('baj_fec_resolucion');
            $table->text('baj_observacion');

            //TODO:RELACIONES
            $table->bigInteger('tipo_documento_id')->unsigned();
            $table->foreign('tipo_documento_id')
                    ->references('id')
                    ->on('tipo_documento')
                    ->onDelete('cascade');
            
            $table->bigInteger('motivo_baja_id')->unsigned();
            $table->foreign('motivo_baja_id')
                    ->references('id')
                    ->on('motivo_baja')
                    ->onDelete('cascade');
            
            $table->bigInteger('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')
                    ->references('id')
                    ->on('vehiculo')
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
        Schema::dropIfExists('baja_vehicular');
    }
};
