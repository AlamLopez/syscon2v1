<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $table = 'rols';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 
        'descripcion', 
        'condicion'
    ];

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
