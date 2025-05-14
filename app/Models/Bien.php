<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
protected $fillable = [
    'nombre',
    'codigo',
    'categoria',
    'cantidad',
    'estado',
];
public function devoluciones()
{
    return $this->hasManyThrough(Devolucion::class, Prestamo::class);
}

}
