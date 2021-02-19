<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acronimo extends Model
{
    protected $table = 'acronimos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'acronimo'
    ];
}
