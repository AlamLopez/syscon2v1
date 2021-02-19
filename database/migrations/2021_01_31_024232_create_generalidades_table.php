<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generalidades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('empresa');
            $table->string('rector');
            $table->string('vicerector');
            $table->string('facultad');
            $table->string('decano');
            $table->string('vicedecano');
             $table->string('ciclo');
            $table->integer('anio');
            $table->date('inicio');
            $table->date('final');
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
        Schema::dropIfExists('generalidades');
    }
}
