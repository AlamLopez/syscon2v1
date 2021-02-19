<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ControlHorarios extends Model
{
    	protected $table = 'control_horarios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'descripcion','horasemana', 'idtipocontrato', 'idtipoactividad',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function tipocontratos()
    {
        return $this->belongsTo('App\TipoContrato');
    }

    public function tipoactividadactividad()
    {
        return $this->belongsTo('App\TipoActividad');
    }
}
