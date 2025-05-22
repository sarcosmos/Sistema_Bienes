<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{

    protected $fillable = [
        'nombre',
        'categoria',
        'descripcion',
        'codigo',
        'cantidad',
        'estado',
    ];
}
