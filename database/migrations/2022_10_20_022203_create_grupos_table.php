<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->integer('anyo');
            $table->string('horario', 50);
            $table->string('duracion', 50);

            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')
                ->references('id')
                ->on('cursos');

            $table->unsignedBigInteger('docente_id');
            $table->foreign('docente_id')
                ->references('id')
                ->on('docentes');

            $table->boolean('estado')->default(true);
                
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}
