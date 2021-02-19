<?php

use Illuminate\Database\Seeder;
use App\Departamento;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Departamento::create([
            'id'=>1,
            'nombre'=>'San Salvador',
            'created_at'=>date('Y-m-d H:m:s'),
            'updated_at'=>date('Y-m-d H:m:s')
          ]);
         
          Departamento::create([
            'id'=>2,
            'nombre'=>'San Miguel',
            'created_at'=>date('Y-m-d H:m:s'),
            'updated_at'=>date('Y-m-d H:m:s')
          ]);
          
           Departamento::create([
            'id'=>3,
            'nombre'=>'San Vicente',
            'created_at'=>date('Y-m-d H:m:s'),
            'updated_at'=>date('Y-m-d H:m:s')
          ]);
          
           Departamento::create([
            'id'=>4,
            'nombre'=>'Morazán',
            'created_at'=>date('Y-m-d H:m:s'),
            'updated_at'=>date('Y-m-d H:m:s')
          ]);
          
           Departamento::create([
            'id'=>5,
            'nombre'=>'La Unión',
            'created_at'=>date('Y-m-d H:m:s'),
            'updated_at'=>date('Y-m-d H:m:s')
          ]);
          
           Departamento::create([
            'id'=>6,
            'nombre'=>'Cabañas',
            'created_at'=>date('Y-m-d H:m:s'),
            'updated_at'=>date('Y-m-d H:m:s')
          ]);
          
           Departamento::create([
            'id'=>7,
            'nombre'=>'Sonsonate',
            'created_at'=>date('Y-m-d H:m:s'),
            'updated_at'=>date('Y-m-d H:m:s')
          ]);
          
           Departamento::create([
            'id'=>8,
            'nombre'=>'Chalatenango',
            'created_at'=>date('Y-m-d H:m:s'),
            'updated_at'=>date('Y-m-d H:m:s')
          ]);
          
           Departamento::create([
            'id'=>9,
            'nombre'=>'La Libertad',
            'created_at'=>date('Y-m-d H:m:s'),
            'updated_at'=>date('Y-m-d H:m:s')
          ]);
          
           Departamento::create([
            'id'=>10,
            'nombre'=>'Ahuachapan',
            'created_at'=>date('Y-m-d H:m:s'),
            'updated_at'=>date('Y-m-d H:m:s')
          ]);
          
           Departamento::create([
            'id'=>11,
            'nombre'=>'Cuscatlán',
            'created_at'=>date('Y-m-d H:m:s'),
            'updated_at'=>date('Y-m-d H:m:s')
          ]);
          Departamento::create([
            'id'=>12,
            'nombre'=>'Usulután',
            'created_at'=>date('Y-m-d H:m:s'),
            'updated_at'=>date('Y-m-d H:m:s')
          ]);
          
           Departamento::create([
            'id'=>13,
            'nombre'=>'La Paz',
            'created_at'=>date('Y-m-d H:m:s'),
            'updated_at'=>date('Y-m-d H:m:s')
         ]);
         
          Departamento::create([
            'id'=>14,
            'nombre'=>'Santa Ana',
            'created_at'=>date('Y-m-d H:m:s'),
            'updated_at'=>date('Y-m-d H:m:s')
          ]);
    }
}
