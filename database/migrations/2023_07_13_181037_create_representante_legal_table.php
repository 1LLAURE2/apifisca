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
        Schema::create('representante_legal', function (Blueprint $table) {
            $table->id();
            
            $table->string('rle_nombres',60);
            $table->string('rle_correo',30);
            $table->string('rle_domicilio',30);
            $table->string('rle_telefono',9);
            $table->string('rle_cargo',30);
            $table->string('rle_num_RRPP',20);
            $table->date('rle_fec_inicio');
            $table->date('rle_fec_fin');
            $table->string('rle_observacion',50);
            $table->boolean('rle_estado')->default(1);

            //TODO: RELACIONES
            $table->bigInteger('tipo_identificacion_id')->unsigned();
            $table->foreign('tipo_identificacion_id')
                    ->references('id')
                    ->on('tipo_identificacion')
                    ->onDelete('cascade');
            
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
        Schema::dropIfExists('representante_legal');
    }
};
