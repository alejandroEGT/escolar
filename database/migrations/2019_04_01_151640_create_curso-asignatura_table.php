<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoAsignaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso-asignatura', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('curso_id');
            $table->integer('asignatura_id');
            $table->string('checked');
            $table->integer('docente_id')->nullable();
            $table->char('activo',1);
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
        Schema::dropIfExists('curso-asignatura');
    }
}
