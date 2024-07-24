<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use GuzzleHttp\Middleware;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // para usuarios
    Route::resource('users',UserController::class)->only(['index','edit','update'])->middleware('can:admin.users.index')->names('admin.users');
// para categorias
    Route::get('/categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->Middleware('can:categorias.index')->name('categorias.index');
    Route::get('/categorias/create', [App\Http\Controllers\CategoriaController::class, 'create'])->middleware('can:categorias.create')->name('categorias.create');
    Route::post('/categorias', [App\Http\Controllers\CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/edit/{id}', [App\Http\Controllers\CategoriaController::class, 'edit'])->middleware('can:categorias.edit')->name('categorias.edit');
    Route::put('/categorias/edit/{id}', [App\Http\Controllers\CategoriaController::class, 'update'])->name('categorias.update');
    Route::get('/categorias/estado/{id}', [App\Http\Controllers\CategoriaController::class, 'estado'])->name('categorias.estado');

// para productos

    Route::get('/productos', [App\Http\Controllers\ProductosController::class, 'index'])->middleware('can:productos.index')->name('productos.index');
    Route::get('/productos/create', [App\Http\Controllers\ProductosController::class, 'create'])->middleware('can:productos.create')->name('productos.create');
    Route::post('/productos', [App\Http\Controllers\ProductosController::class, 'store'])->name('productos.store');
    Route::get('/productos/edit/{id}', [App\Http\Controllers\ProductosController::class, 'edit'])->middleware('can:productos.edit')->name('productos.edit');
    Route::put('/productos/edit/{id}', [App\Http\Controllers\ProductosController::class, 'update'])->name('productos.update');
    Route::get('/productos/estado/{id}', [App\Http\Controllers\ProductosController::class, 'estado'])->name('productos.estado');

    //para clientes
     Route::get('/clientes', [App\Http\Controllers\ClientesController::class, 'index'])->middleware('can:clientes.index')->name('clientes.index');
    Route::get('/clientes/create', [App\Http\Controllers\ClientesController::class, 'create'])->middleware('can:clientes.create')->name('clientes.create');
    Route::post('/clientes', [App\Http\Controllers\ClientesController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/edit/{id}', [App\Http\Controllers\ClientesController::class, 'edit'])->middleware('can:clientes.edit')->name('clientes.edit');
    Route::put('/clientes/edit/{id}', [App\Http\Controllers\ClientesController::class, 'update'])->name('clientes.update');
    Route::get('/clientes/estado/{id}', [App\Http\Controllers\ClientesController::class, 'estado'])->name('clientes.estado');

    //para proveedores
    Route::get('/proovedor', [App\Http\Controllers\ProovedorController::class, 'index'])->middleware('can:proovedor.index')->name('proovedor.index');
    Route::get('/proovedor/create', [App\Http\Controllers\ProovedorController::class, 'create'])->middleware('can:proovedor.create')->name('proovedor.create');
    Route::post('/proovedor', [App\Http\Controllers\ProovedorController::class, 'store'])->name('proovedor.store');
    Route::get('/proovedor/edit/{id}', [App\Http\Controllers\ProovedorController::class, 'edit'])->middleware('can:proovedor.edit')->name('proovedor.edit');
    Route::put('/proovedor/edit/{id}', [App\Http\Controllers\ProovedorController::class, 'update'])->name('proovedor.update');
    Route::get('/proovedor/estado/{id}', [App\Http\Controllers\ProovedorController::class, 'estado'])->name('proovedor.estado');

    //para compras livewire

    // Route::get('/Compras/create', [App\Http\Controllers\CompraController::class, 'create'])->name('compras.create');
    // Route::get('/Compras', [App\Http\Controllers\CompraController::class, 'index'])->name('compras.index');
    // Route::get('/Compras/estado/{id}/{estado}', [App\Http\Controllers\CompraController::class, 'cambiarEstado']);
    // Route::get('/Compras/ver/{id}', [App\Http\Controllers\CompraController::class, 'show'])->name('compras.show');
// para compras
    Route::get('/compras', [App\Http\Controllers\CompraController::class, 'index'])->name('compras.index');
    Route::get('/compras/create', [App\Http\Controllers\CompraController::class, 'create'])->name('compras.create');
    Route::post('/compras', [App\Http\Controllers\CompraController::class, 'store'])->name('compras.store');
    Route::get('/Compras/ver/{id}', [App\Http\Controllers\CompraController::class, 'show'])->name('compras.show');
    Route::get('/compras/estado/{id}', [App\Http\Controllers\CompraController::class, 'estado'])->name('compras.estado');

    // para ventas
    Route::get('/ventas', [App\Http\Controllers\VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/create', [App\Http\Controllers\VentaController::class, 'create'])->name('ventas.create');
    Route::post('/ventas', [App\Http\Controllers\VentaController::class, 'store'])->name('ventas.store');
    Route::get('/ventas/ver/{id}', [App\Http\Controllers\VentaController::class, 'show'])->name('ventas.show');
    Route::get('/ventas/estado/{id}', [App\Http\Controllers\VentaController::class, 'estado'])->name('ventas.estado');
});
