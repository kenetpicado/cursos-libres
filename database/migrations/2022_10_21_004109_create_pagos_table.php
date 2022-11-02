<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('concepto', 50);
            $table->decimal('monto');
            $table->string('recibi_de', 50);

            $table->unsignedBigInteger('alumno_grupo_id');
            $table->foreign('alumno_grupo_id')
                ->references('id')
                ->on('alumno_grupo');

            $table->date('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
