<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBienesTable extends Migration
{
    public function up()
    {
        Schema::create('bienes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo')->unique(); // Asegúrate de que el código sea único
            $table->string('categoria');
            $table->integer('cantidad');
            $table->string('estado');
            $table->date('fecha_registro');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bienes');
    }
}
