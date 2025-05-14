<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'bien_id',
        'usuario_id', // Si tienes un modelo de usuario
        'fecha_prestamo',
        'fecha_devolucion',
        'estado', // Puede ser 'prestado', 'devuelto'
    ];
    public function devoluciones()
    {   
        return $this->hasOne(Devolucion::class);
    }

    // Relación con Bien
    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }
}
