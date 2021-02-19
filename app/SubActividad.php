<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubActividad extends Model
{
    protected $table = 'sub_actividads';

    protected $primaryKey = 'id';

    protected $fillable = [
        'descripcion'
    ];
}
