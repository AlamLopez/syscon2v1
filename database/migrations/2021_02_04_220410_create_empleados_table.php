<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->string('nombre');
            $table->string('profesion')->nullable();
            $table->string('direccion');
            $table->boolean('genero');
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('edad');
            $table->string('telefono1');
            $table->string('telefono2')->nullable();
            $table->string('celular')->nullable();
            $table->string('dui')->nullable();
            $table->date('fechavencimiento')->nullable();
            $table->string('nit')->nullable();
            $table->string('afp')->nullable();
            $table->string('cargo');
            $table->string('desatestados')->nullable();
            $table->string('disatestados')->nullable();
            $table->bigInteger('id_user')->unsigned()->nullable();
            $table->bigInteger('id_municipio')->unsigned();
            $table->bigInteger('id_unidadacademica')->unsigned();
            $table->bigInteger('id_acronimo')->unsigned();
            $table->bigInteger('id_categoria')->unsigned();
            $table->boolean('condicion')->default(true);

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->foreign('id_unidadacademica')->references('id')->on('unidad_academicas');
            $table->foreign('id_acronimo')->references('id')->on('acronimos');
            $table->foreign('id_categoria')->references('id')->on('categorias');
            
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
        Schema::dropIfExists('empleados');
    }
}
