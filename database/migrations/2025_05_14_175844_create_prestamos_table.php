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
            $table->foreignId('prestamo_id')->constrained()->onDelete('cascade');
            $table->date('fecha_devolucion');
            $table->enum('estado', ['completa', 'dañado', 'parcial']); // Estado de la devolución
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('devoluciones');
    }
}
