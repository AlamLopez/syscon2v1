<?php

use Illuminate\Database\Seeder;
use App\ControlHorarios;
class ControlHorasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ControlHorarios::create([
       'id'=>'1',
       'descripcion'=>'Limite de Horas',
       'horasemana'=>'10',
        'idtipoactividad'=>'2',
       'idtipocontrato'=>'1',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);

        ControlHorarios::create([
       'id'=>'2',
       'descripcion'=>'Limite de Horas',
       'horasemana'=>'40',
        'idtipoactividad'=>'1',
       'idtipocontrato'=>'3',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);
    }
}
