<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleComportamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_comportamiento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comportamiento_id');
            $table->integer('alumno_id');
            $table->integer('curso_id');
            $table->integer('docente_id');
            $table->char('activo', 1);
            $table->string('descripcion');
            $table->integer('seccion');
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
        Schema::dropIfExists('detalle_comportamiento');
    }
}
