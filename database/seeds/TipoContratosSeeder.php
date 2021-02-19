<?php

use Illuminate\Database\Seeder;
use App\TipoContratos;

class TipoContratosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoContratos::create([
       'id'=>1,
       'descripcion'=>'Docente',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);

        TipoContratos::create([
       'id'=>2,
       'descripcion'=>'Administrativo',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);

        TipoContratos::create([
       'id'=>3,
       'descripcion'=>'Permanente',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);
        TipoContratos::create([
       'id'=>4,
       'descripcion'=>'Tecnico',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);
        TipoContratos::create([
       'id'=>5,
       'descripcion'=>'Permanente Medio Tiempo',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);
        TipoContratos::create([
       'id'=>6,
       'descripcion'=>'Permanente Cuarto Tiempo',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);



    }
}
