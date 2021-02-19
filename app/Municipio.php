<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    //
    protected $table = 'municipios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 
        'id_departamento'
    ];

    public function departamento()
    {
        return $this->hasOne('App\Departamento');
    }

    public function empleado()
    {
        return $this->belongsTo('App\Empleado');
    }
}
