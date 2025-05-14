<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevolucionesTable extends Migration
{
    public function up()
    {
        Schema::create('devoluciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestamo_id')->constrained()->onDelete('cascade'); // Relación con Prestamo
            $table->date('fecha_devolucion'); // Fecha en que el bien fue devuelto
            $table->enum('estado', ['completa', 'parcial', 'dañado']); // Estado de la devolución
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('devoluciones');
    }
}
