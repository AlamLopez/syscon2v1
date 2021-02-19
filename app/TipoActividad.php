<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoActividad extends Model
{
    protected $table = 'tipo_actividads';

    protected $primaryKey = 'id';

    protected $fillable = [
        'descripcion', 
        'esdocente', 
        'espermanente', 
        'esadministrativo', 
        'estecnico'
    ];
}
