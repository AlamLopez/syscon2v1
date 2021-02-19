<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generalidades extends Model
{
      protected $table = 'generalidades';

    protected $primaryKey = 'id';

    protected $fillable = [
            'empresa',
            'rector',
            'vicerector',
            'facultad',
            'decano',
            'vicedecano',
            'ciclo',
            'anio',
            'inicio',
            'final'
    ];

}
