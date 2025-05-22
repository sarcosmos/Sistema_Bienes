<?php

use App\Http\Controllers\BienController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('bienes', function () {
    return Inertia::render('Bienes');
})->middleware(['auth', 'verified'])->name('bienes');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {

    // Rutas Inertia (para cargar vistas/componentes Vue)
    Route::get('/bienes', fn () => Inertia::render('Bienes/Index'))->name('bienes.index');
    Route::get('/bienes/create', fn () => Inertia::render('Bienes/Create'))->name('bienes.create');
    Route::get('/bienes/{bien}/edit', fn ($bien) => Inertia::render('Bienes/Edit', ['bienId' => $bien]))->name('bienes.edit');

    // Rutas API REST (con controladores)
    Route::get('api/bienes', [BienController::class, 'index'])->name('api.bienes.index');
    Route::post('api/bienes', [BienController::class, 'store'])->name('api.bienes.store');
    Route::get('api/bienes/{bien}', [BienController::class, 'show'])->name('api.bienes.show');
    Route::put('api/bienes/{bien}', [BienController::class, 'update'])->name('api.bienes.update');
    Route::delete('api/bienes/{bien}', [BienController::class, 'destroy'])->name('api.bienes.destroy');
});




require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
