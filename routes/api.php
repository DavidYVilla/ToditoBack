<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//Rutas para categorias
Route::get('categorias', [App\Http\Controllers\Api\CategoriaController::class, 'index'])->name('api.categorias.index');
Route::get('categorias/{id}', [App\Http\Controllers\Api\CategoriaController::class, 'show'])->name('api.categorias.show');
Route::post('categorias', [App\Http\Controllers\Api\CategoriaController::class, 'store'])->name('api.categorias.store');
//Route::put('categorias/{id}', [App\Http\Controllers\Api\CategoriaController::class, 'update'])->name('api.categorias.update');
//Route::delete('categorias/{id}', [App\Http\Controllers\Api\CategoriaController::class, 'destroy'])->name('api.categorias.destroy');

//Rutas para Productos
