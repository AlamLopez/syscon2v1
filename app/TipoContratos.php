<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoContratos extends Model
{
     protected $table = 'tipo_contratos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'descripcion'
    ];
}
