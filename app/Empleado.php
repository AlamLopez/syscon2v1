<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    protected $table = 'empleados';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 
        'profesion', 
        'acronimo',
        'direccion',
        'genero',
        'fecha_nacimiento',
        'edad',
        'telefono1',
        'telefono2',
        'celular',
        'categoria',
        'dui',
        'fechavencimiento',
        'nit',
        'afp',
        'cargo',
        'unidad',
        'jefe',
        'desatestados',
        'diratestados',
        'id_user',
        'id_municipio',
        'condicion'
    ];

}
