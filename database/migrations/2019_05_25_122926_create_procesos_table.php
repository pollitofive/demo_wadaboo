<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('procesos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('proceso_nro')->nullable();
            $table->string('titulo')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->string('hora_inicio')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->text('detalles')->nullable();
            $table->string('preferencia_pago')->nullable();
            $table->integer('punto_entrega_id')->nullable();
            $table->string('estado')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('procesos');
    }

}
