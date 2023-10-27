<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

//Rutas Generales
Route::middleware('auth', 'verified')->group(function () {

    //Rutas de Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Ruta Panel de Control
    Route::get('/servers', [ServerController::class, 'index'])->name('servers.show');
    //Rutas de Servers
    Route::get('/server/add', [ServerController::class, 'create'])->name('server.create');
    Route::post('/server/add', [ServerController::class, 'store'])->name('server.store');
    Route::post('/server/delete/{id}', [ServerController::class, 'destroy'])->name('server.destroy');
    Route::get('/server/edit/{id}', [ServerController::class, 'edit'])->name('server.edit');
    Route::post('/server/edit/{id}', [ServerController::class, 'update'])->name('server.update');
    Route::get('/server/checkall', [ServerController::class, 'checkall'])->name('server.checkall');
    Route::get('/server/checkone', [ServerController::class, 'checkone'])->name('server.checkone');
});

//Rutas Administrador
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // Rutas de Control de Usuarios
});

require __DIR__ . '/auth.php';
