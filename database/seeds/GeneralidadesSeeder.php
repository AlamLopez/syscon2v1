<?php

use Illuminate\Database\Seeder;
use App\Generalidades;

class GeneralidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Generalidades::create([
       'id'=>1,
       'empresa'=>'UNIVERSIDAD DE EL SALVADOR',
       'rector'=>'MAESTRO ROGER ARMANDO ARIAS ALVARADO',
       'vicerector'=>'DR. MANUEL DE JESÚS JOYA ABREGO.',
       'facultad'=>'FACULTAD DE INGENIERIA Y ARQUITECTURA',
       'decano'=>'PHD. EDGAR ARMANDO PEÑA FIGUEROA',
       'vicedecano'=>'ING. JOSÉ MARÍA SÁNCHEZ CORNEJO',
        'ciclo'=>'CICLO I',
        'anio'=>'2021',
        'inicio'=>date('2021-01-15'),
        'final'=>date('2021-07-15'),
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);
    }
}
