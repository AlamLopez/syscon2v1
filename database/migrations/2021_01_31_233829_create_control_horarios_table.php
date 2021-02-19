<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_horarios', function (Blueprint $table) {
          $table->bigIncrements('id');
            $table->string('descripcion');
            $table->double('horasemana');
            $table->bigInteger('idtipoactividad')->unsigned()->nullable();
            $table->bigInteger('idtipocontrato')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('idtipoactividad')->references('id')->on('tipo_actividads');
            $table->foreign('idtipocontrato')->references('id')->on('tipo_contratos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('control_horarios');
    }
}
