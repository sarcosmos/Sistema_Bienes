<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
<<<<<<< HEAD
=======
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
>>>>>>> d79a245b917cf833bbd155789519b1e206510c6d

    protected $fillable = [
        'nombre',
        'categoria',
        'descripcion',
        'codigo',
        'cantidad',
        'estado',
    ];
}
