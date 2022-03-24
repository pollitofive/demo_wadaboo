<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('email', 100);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('estado');
            $table->string('tipo_usuario')->nullable();
            $table->string('part_nombre')->nullable();
            $table->string('part_apellido')->nullable();
            $table->integer('part_nro_doc')->nullable();
            $table->string('part_telefono')->nullable();
            $table->string('calle')->nullable();
            $table->string('altura')->nullable();
            $table->string('piso')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->integer('provincia_id')->nullable();
            $table->integer('localidad_id')->nullable();
            $table->string('direccion_entrega')->nullable();
            $table->string('empresa_razon_social')->nullable();
            $table->string('empresa_nombre')->nullable();
            $table->string('empresa_cuit')->nullable();
            $table->string('empresa_cargo')->nullable();
            $table->string('empresa_telefono')->nullable();
            $table->string('empresa_descripcion')->nullable();
            $table->string('empresa_tamanio')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
