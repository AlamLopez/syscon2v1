<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignarActividad extends Model
{
    protected $table = 'asignar_actividads';

    protected $primaryKey = 'id';

    protected $fillable = [
            'actividad',
            'subactividad',
            'tipoactividad',
            'ciclo',
            'año',
            'inicio',
            'fin'
    ];
}
