<?php

use Illuminate\Database\Seeder;
use App\Actividad;

class ActividadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Actividad::create([
       'id'=>'1',
       'descripcion'=>'Matematicas I',
       'idsubactividad'=>'1',
       'idtipoactividad'=>'1',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);

          Actividad::create([
       'id'=>'2',
       'descripcion'=>'Matematicas II',
       'idsubactividad'=>'1',
       'idtipoactividad'=>'1',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);
        Actividad::create([
       'id'=>'3',
       'descripcion'=>'Matematicas I',
       'idsubactividad'=>'8',
       'idtipoactividad'=>'1',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);

          Actividad::create([
       'id'=>'4',
       'descripcion'=>'Fisica I',
       'idsubactividad'=>'9',
       'idtipoactividad'=>'1',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);
      Actividad::create([
       'id'=>'5',
       'descripcion'=>'Desarrollo',
       'idsubactividad'=>null,
       'idtipoactividad'=>'2',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);

      Actividad::create([
       'id'=>'6',
       'descripcion'=>'Generacion de contrato',
       'idsubactividad'=>null,
       'idtipoactividad'=>'2',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);

    }
}
