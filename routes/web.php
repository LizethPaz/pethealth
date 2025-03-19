<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\DuenoController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\VeterinarioController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Añadir esta ruta antes de Route::resource
Route::get('/citas-calendario', [App\Http\Controllers\CitaController::class, 'calendar'])->name('citas.calendar');

// Ruta para obtener mascotas por dueño (AJAX)
// 1. -->//Route::get('/mascotas-por-dueno/{idDueno}', [App\Http\Controllers\CitaController::class, 'getMascotasPorDueno']);
// 2. --> //Route::get('/mascotas-por-dueno/{idDueno}', [App\Http\Controllers\CitaController::class, 'getMascotasPorDueno'])->name('mascotas.por.dueno');
Route::get('/mascotas-por-dueno/{idDueno}', [App\Http\Controllers\CitaController::class, 'getMascotasPorDueno']);
Route::get('/duenos/{id}/mascotas', [CitaController::class, 'obtenerMascotas']);


Route::resource('citas', CitaController::class);
Route::get('/citas-historial/{idMascota?}', [CitaController::class, 'historial'])->name('citas.historial');


//
Route::resource('veterinarios', VeterinarioController::class);
Route::get('veterinarios-trashed', [VeterinarioController::class, 'trashed'])->name('veterinarios.trashed');
Route::patch('veterinarios/{id}/restore', [VeterinarioController::class, 'restore'])->name('veterinarios.restore');
Route::delete('veterinarios/{id}/force-delete', [VeterinarioController::class, 'forceDelete'])->name('veterinarios.force-delete');


Route::resource('mascotas', MascotaController::class);
Route::resource('duenos', DuenoController::class);
Route::get('/', function () {
    return redirect()->route('mascotas.index');
});
