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
        Schema::create('motivo_baja', function (Blueprint $table) {
            $table->id();
            $table->string('mba_descripcion', 15);
            // TODO: Especificar que datos debe tener descripcion
            // ? Aun no se sabe que datos debe tener
            $table->boolean('mba_estado')->default(1);
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
        Schema::dropIfExists('motivo_baja');
    }
};
