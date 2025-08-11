<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\EventoController;
use App\Http\Controllers\PonenteController;
use App\Http\Controllers\AsistenteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí se definen las rutas API para los recursos de la aplicación.
|
*/

/**
 * Rutas para el recurso Evento
 */
Route::prefix('eventos')->group(function () {
    Route::get('/', [EventoController::class, 'index']);        // Listar todos los eventos
    Route::post('/', [EventoController::class, 'store']);      // Crear nuevo evento
    Route::get('/{id}', [EventoController::class, 'show']);    // Mostrar evento específico
    Route::put('/{evento}', [EventoController::class, 'update']); // Actualizar evento
    Route::delete('/{id}', [EventoController::class, 'destroy']); // Eliminar evento
});

/**
 * Rutas para el recurso Ponente
 */
Route::prefix('ponentes')->group(function () {
    Route::get('/', [PonenteController::class, 'index']);        // Listar todos los ponentes
    Route::post('/', [PonenteController::class, 'store']);       // Crear nuevo ponente
    Route::get('/{id}', [PonenteController::class, 'show']);     // Mostrar ponente específico
    Route::put('/{ponente}', [PonenteController::class, 'update']); // Actualizar ponente
    Route::delete('/{id}', [PonenteController::class, 'destroy']);  // Eliminar ponente
});

/**
 * Rutas para el recurso Asistente
 */
Route::prefix('asistentes')->group(function () {
    Route::get('/', [AsistenteController::class, 'index']);        // Listar todos los asistentes
    Route::post('/', [AsistenteController::class, 'store']);       // Crear nuevo asistente
    Route::get('/{id}', [AsistenteController::class, 'show']);     // Mostrar asistente específico
    Route::put('/{asistente}', [AsistenteController::class, 'update']); // Actualizar asistente
    Route::delete('/{id}', [AsistenteController::class, 'destroy']);    // Eliminar asistente
});