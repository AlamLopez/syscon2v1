<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->bigInteger('idsubactividad')->unsigned()->nullable();
            $table->bigInteger('idtipoactividad')->unsigned();

            $table->foreign('idsubactividad')->references('id')->on('sub_actividads');
            $table->foreign('idtipoactividad')->references('id')->on('tipo_actividads');

            $table->rememberToken();
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
        Schema::dropIfExists('actividads');
    }
}
