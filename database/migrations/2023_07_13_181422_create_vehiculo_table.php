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
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->id();

            $table->string('veh_placa',6);
            $table->string('veh_num_chasis',10);
            $table->string('veh_marca',15);
            $table->string('veh_clase',10);
            $table->string('veh_categoria',5);
            $table->string('veh_longitud',6);
            $table->string('veh_ancho',6);
            $table->string('veh_altura',6);
            $table->string('veh_num_eje',2);
            $table->string('veh_num_motor',15);
            $table->string('veh_num_asiento',2);
            $table->string('veh_color',10);
            $table->string('veh_propietario',50);
            $table->string('veh_combustible',10);
            $table->string('veh_modelo',10);
            $table->string('veh_carroceria',20);
            $table->string('veh_VIN',17);
            $table->string('veh_peso_bruto',6);
            $table->string('veh_peso_neto',6);
            $table->string('veh_carga_util',6);
            $table->string('veh_anio_fabricacion',4);
            $table->string('veh_num_llanta',2);
            $table->string('veh_num_pasajero',2);
            $table->boolean('veh_estado')->default(1);

            //TODO:RELACIONES
            $table->bigInteger('empresa_id')->unsigned();
            $table->foreign('empresa_id')
                    ->references('id')
                    ->on('empresa')
                    ->onDelete('cascade');
            
            $table->bigInteger('tenencia_id')->unsigned();
            $table->foreign('tenencia_id')
                    ->references('id')
                    ->on('tenencia')
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
        Schema::dropIfExists('vehiculo');
    }
};
