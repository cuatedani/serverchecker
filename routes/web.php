<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServerController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('inicio');
    })->name('inicio');
});

//Rutas Generales
Route::middleware('auth', 'verified')->group(function () {

    //Rutas de Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Rutas de Servers
    Route::get('/servers', [ServerController::class, 'index'])->name('servers.show');
    Route::get('/server/add', [ServerController::class, 'create'])->name('server.create');
    Route::post('/server/add', [ServerController::class, 'store'])->name('server.store');
    Route::post('/server/delete/{id}', [ServerController::class, 'destroy'])->name('server.destroy');
    Route::get('/server/get/{id}', [ServerController::class, 'indexone'])->name('server.get');
    Route::post('/server/edit/{id}', [ServerController::class, 'update'])->name('server.update');
    Route::get('/server/checkall', [ServerController::class, 'checkall'])->name('server.checkall');
    Route::get('/server/checkglobal', [ServerController::class, 'checkglobal'])->name('server.checkone');
    Route::get('/server/checkone/{id}', [ServerController::class, 'checkone'])->name('server.checkone');


    Route::get('/añadir', function () {
        return view('add');
    });
});

require __DIR__ . '/auth.php';

//Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
