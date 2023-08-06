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
        Schema::create('documentacion', function (Blueprint $table) {
            $table->id();

            $table->string('doc_num_exp',10);
            $table->string('doc_num_res',10);
            $table->date('doc_fec_exp');
            $table->date('doc_fec_res');
            $table->string('doc_observacion',50); 
            // ? doc_observacion puede ser text y no va tamaño

            //TODO:RELACIONES
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
        Schema::dropIfExists('documentacion');
    }
};
