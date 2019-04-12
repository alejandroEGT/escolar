<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnoCalificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno-calificacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alumno_id');
            $table->integer('asignatura_id');
            $table->integer('curso_id');
            $table->integer('seccion')->nullable();
            $table->integer('nota1')->nullable();
            $table->integer('nota2')->nullable();
            $table->integer('nota3')->nullable();
            $table->integer('nota4')->nullable();
            $table->integer('nota5')->nullable();
            $table->integer('nota6')->nullable();
            $table->integer('nota7')->nullable();
            $table->integer('nota8')->nullable();
            $table->integer('nota9')->nullable();
            $table->integer('nota10')->nullable();
            $table->integer('nota11')->nullable();
            $table->integer('nota12')->nullable();
            $table->integer('nota13')->nullable();
            $table->integer('nota14')->nullable();
            $table->integer('nota15')->nullable();
            $table->integer('promedio')->nullable();
            $table->char('activo', 1);
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
        Schema::dropIfExists('alumno-calificacion');
    }
}
