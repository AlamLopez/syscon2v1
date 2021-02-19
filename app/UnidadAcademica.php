<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadAcademica extends Model
{
    //
    protected $table = 'unidad_academicas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 
        'jefe',
    ];
}
