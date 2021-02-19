<?php

use Illuminate\Database\Seeder;
use App\Categoria;
class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
       'id'=>1,
       'categoria'=>'PU-I',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);

	Categoria::create([
       'id'=>2,
       'categoria'=>'PU-II',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);

	Categoria::create([
       'id'=>3,
       'categoria'=>'PU-III',
       'created_at'=>date('Y-m-d H:m:s'),
       'updated_at'=>date('Y-m-d H:m:s')
     ]);
    }
}
