<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;

    protected $fillable = [
        'prestamo_id', // Relación con el préstamo
        'fecha_devolucion',
        'estado', // Estado de la devolución
    ];

    // Relación con Prestamo (cada devolución pertenece a un préstamo)
    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }
}
