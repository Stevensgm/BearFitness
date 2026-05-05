<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RutinaController;
use App\Http\Controllers\ReciboController;

// Landing page pública
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas de autenticación
require __DIR__ . '/auth.php';

// Redireccionamiento después del login según rol
Route::get('/dashboard', function () {
    if (auth()->user()->esAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('cliente.dashboard');
})->middleware(['auth'])->name('dashboard');

// ── PANEL ADMINISTRADOR ─────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('productos', ProductoController::class);
    Route::get('/productos-pdf', [ProductoController::class, 'pdf'])->name('productos.pdf');

    Route::resource('rutinas', RutinaController::class);
    Route::get('/rutinas-pdf', [RutinaController::class, 'pdf'])->name('rutinas.pdf');
});

// ── PANEL CLIENTE ───────────────────────────────────────────────
Route::prefix('cliente')->name('cliente.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $rutinas   = \App\Models\Rutina::where('activo', true)->orderBy('dia')->get();
        $productos = \App\Models\Producto::where('activo', true)->where('stock', '>', 0)->get();
        return view('cliente.dashboard', compact('rutinas', 'productos'));
    })->name('dashboard');

    Route::post('/recibo', [ReciboController::class, 'generar'])->name('recibo');
});