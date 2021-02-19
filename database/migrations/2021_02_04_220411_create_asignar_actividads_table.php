<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignarActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignar_actividads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('actividad');
            $table->string('subactividad');
            $table->string('tipoactividad');
            $table->integer('dia');
            $table->time('inicio');
            $table->time('fin');
            $table->string('ciclo');
            $table->string('anio');
            
            $table->bigInteger('idactividad')->unsigned();
            $table->bigInteger('idempleado')->unsigned();

            $table->foreign('idactividad')->references('id')->on('actividads');
            $table->foreign('idempleado')->references('id')->on('empleados');

            $table->rememberToken();
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
        Schema::dropIfExists('asignar_actividads');
    }
}
