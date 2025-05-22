<?php

use App\Http\Controllers\BienController;
use Illuminate\Support\Facades\Route;

// Asegúrate de usar sanctum para proteger rutas si es necesario
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('bienes', [BienController::class, 'index'])->name('api.bienes.index');
    Route::post('bienes', [BienController::class, 'store'])->name('api.bienes.store');
    Route::get('bienes/{bien}', [BienController::class, 'show'])->name('api.bienes.show');
    Route::put('bienes/{bien}', [BienController::class, 'update'])->name('api.bienes.update');
    Route::delete('bienes/{bien}', [BienController::class, 'destroy'])->name('api.bienes.destroy');
});
