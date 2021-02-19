<?php

use Illuminate\Database\Seeder;
use App\Acronimo;
class AcronimoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Acronimo::create([
       'id'=>1,
       'acronimo'=>'Arq.',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);
 Acronimo::create([
       'id'=>2,
       'acronimo'=>'Bach.',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);
  Acronimo::create([
       'id'=>3,
       'acronimo'=>'Ing.',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);
   Acronimo::create([
       'id'=>4,
       'acronimo'=>'Mtro.',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);
    Acronimo::create([
       'id'=>5,
       'acronimo'=>'Tec.',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);
     Acronimo::create([
       'id'=>6,
       'acronimo'=>'Doc.',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);








    }
}
