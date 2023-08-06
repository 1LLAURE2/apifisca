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
        Schema::create('empresa', function (Blueprint $table) {
            $table->id();
            $table->string('emp_partida_registral',20);
            $table->string('emp_RUC',11)->unique();
            $table->string('emp_razon_social',50);
            $table->string('emp_abreviatura',50);
            $table->string('emp_num_inscripcion_SUNARP',20);
            $table->string('emp_lug_inscripcion_SUNARP',20);
            $table->string('emp_num_mz_km',20);
            $table->string('emp_telefono',9);
            $table->string('emp_email',50);
            $table->string('emp_partida_electronica_SUNARP',20);
            $table->date('emp_fec_inscripcion_SUNARP');
            $table->string('emp_nombre_via',20);
            $table->string('emp_lote_int')->default("-");
            $table->string('emp_nom_urba')->default("-");
            $table->string('emp_URL')->default("-");
            $table->string('emp_referencia',100);
            $table->string('emp_estado')->default('Habilitado');//Habilitado ....

            //TODO: RELACIONES
            $table->bigInteger('tipo_servicio_id')->unsigned();
            $table->foreign('tipo_servicio_id')
                    ->references('id')
                    ->on('tipo_servicio')
                    ->onDelete('cascade');
            
            $table->bigInteger('servicio_id')->unsigned();
            $table->foreign('servicio_id')
                    ->references('id')
                    ->on('servicio')
                    ->onDelete('cascade');
            
            // !Se ha comnetado poruqe el representante legal no debe estar en esta tabla
            // ?Se establecio la conexion con representante legal
            // $table->bigInteger('representante_legal_id')->unsigned();
            // $table->foreign('representante_legal_id')
            //         ->references('id')
            //         ->on('representante_legal')
            //         ->onDelete('cascade');
            
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
        Schema::dropIfExists('empresa');
    }
};
