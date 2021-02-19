<?php

use Illuminate\Database\Seeder;
use App\UnidadAcademica;
class UnidadAcademicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnidadAcademica::create([
          'id'=>1,
          'nombre'=>'Escuela de Ingeniería Civil',
          'jefe'=>' Ing. Jorge Oswaldo Rivera Flores',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>2,
          'nombre'=>'Escuela de Ingeniería Industrial',
          'jefe'=>' Ing. Georgeth Renan Wenner Osmaro Rodríguez. Arévalo',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>3,
          'nombre'=>'Escuela de Ingeniería Mecánica',
          'jefe'=>'Ing. Oscar Eduardo Marroquín H.',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>4,
          'nombre'=>'Escuela de Ingeniería Eléctrica',
          'jefe'=>'Ing. Armando Martínez Calderón',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>5,
          'nombre'=>'Escuela de Ingeniería Química y Escuela de Ingeniería de Alimentos ',
          'jefe'=>'Ing. Sara Elisabeth Orellana Berrios',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>6,
          'nombre'=>'Escuela de Arquitectura',
          'jefe'=>'Arq. Miguel Ángel Pérez Ramos',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>7,
          'nombre'=>'Escuela de Ingeniería de Sistemas Informáticos',
          'jefe'=>'Ing.Rudy Wilfredo Chicas Villegas',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>8,
          'nombre'=>'Escuela de Posgrados',
          'jefe'=>'MSc. Manuel Monjeto',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>9,
          'nombre'=>'Centro de Investigaciones y Aplicaciones Nucleares',
          'jefe'=>'Ing. Luis Ramón Portillo Trujillo',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>10,
          'nombre'=>'Unidad Ciencias Básicas',
          'jefe'=>'Lic. José Francisco Rivera Zavaleta',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>11,
          'nombre'=>'Unidad de Proyección Social',
          'jefe'=>'Licda. Angélica María Nuila Sánchez',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>12,
          'nombre'=>'Unidad de Investigaciones',
          'jefe'=>'Ing. Rodrigo Ernesto Vásquez Escalante',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>13,
          'nombre'=>'Biblioteca de las Ingenierias y la Arquitectura',
          'jefe'=>'Licda. Sonia de Meza',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>14,
          'nombre'=>'Unidad de Planificación',
          'jefe'=>'Ing. Ricardo Amed',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>15,
          'nombre'=>'Administración General',
          'jefe'=>'Ing. Marroquin ',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>16,
          'nombre'=>'Administración Académica',
          'jefe'=>'Ing. Monroy',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);

        UnidadAcademica::create([
          'id'=>17,
          'nombre'=>'Gerencia Informática',
          'jefe'=>'Ing. Pedro Eliseo Peñate',
          'created_at'=>date('Y-m-d H:m:s'),
          'updated_at'=>date('Y-m-d H:m:s')
        ]);
    }
}
