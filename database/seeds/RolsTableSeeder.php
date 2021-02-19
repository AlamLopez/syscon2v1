<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Rol::create([
            'nombre' => 'ADMINISTRADOR',
            'descripcion' => 'Administrador del sistema'
        ]);

        Rol::create([
            'nombre' => 'DIRECTOR DE ESCUELA',
            'descripcion' => 'Es el director de la escuela'
        ]);

        Rol::create([
            'nombre' => 'SECRETARIO DE ESCUELA',
            'descripcion' => 'Es el secretario de la escuela'
        ]);

        Rol::create([
            'nombre' => 'EMPLEADO',
            'descripcion' => 'Es un empleado'
        ]);

        Rol::create([
            'nombre' => 'ASISTENTE DE JD',
            'descripcion' => 'Es un asistente de Junta Directiva'
        ]);

        Rol::create([
            'nombre' => 'FINANCIERO',
            'descripcion' => 'Es un financiero'
        ]);
    }
}
