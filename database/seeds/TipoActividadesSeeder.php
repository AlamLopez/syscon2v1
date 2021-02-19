<?php

use Illuminate\Database\Seeder;
use App\TipoActividad;
class TipoActividadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoActividad::create([
       'id'=>1,
       'descripcion'=>'Normal',
       'esdocente'=>'1',
       'espermanente'=>'1',
       'esadministrativo'=>'1',
       'estecnico'=>'1',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);

        TipoActividad::create([
       'id'=>2,
       'descripcion'=>'Adicional',
       'esdocente'=>'1',
       'espermanente'=>'1',
       'esadministrativo'=>'0',
       'estecnico'=>'0',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);

        TipoActividad::create([
       'id'=>3,
       'descripcion'=>'Integral',
       'esdocente'=>'0',
       'espermanente'=>'1',
       'esadministrativo'=>'1',
       'estecnico'=>'1',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);

        TipoActividad::create([
       'id'=>4,
       'descripcion'=>'Servicio Profesional',
       'esdocente'=>'1',
       'espermanente'=>'1',
       'esadministrativo'=>'1',
       'estecnico'=>'1',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);
    }
}
 