<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
	protected $table = 'actividads';

    protected $primaryKey = 'id';

    protected $fillable = [
        'descripcion', 'idsubactividad', 'idtipoactividad',
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

    public function subactividad()
    {
        return $this->belongsTo('App\SubActividad');
    }

    public function tipoactividadactividad()
    {
        return $this->belongsTo('App\TipoActividad');
    }
}
