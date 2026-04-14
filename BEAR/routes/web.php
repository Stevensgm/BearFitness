<?php

// Este archivo es parte de la configuración de rutas de tu aplicación Laravel. Aquí puedes definir las rutas que responden a las solicitudes web. Cada ruta está asociada a una función o a un controlador que maneja la lógica de la solicitud.
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PdfController;

// Aquí es donde puedes registrar las rutas web para tu aplicación. Estas rutas son cargadas por el RouteServiceProvider dentro de un grupo que contiene el middleware "web".
Route::get('/', function () {

    // Esta ruta responde a la URL raíz ("/") y devuelve la vista "welcome". Es común tener esta ruta como la página de inicio de la aplicación.
    return view('welcome');
});

// Ruta para el dashboard, protegida por autenticación y verificación de correo electrónico
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // Ruta para editar el perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Rutas para actualizar y eliminar el perfil del usuario
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Ruta para eliminar el perfil del usuario
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para el recurso de categorías
    Route::resource('/categoria',CategoriaController::class )->parameters(["categoria"=>"categoria"]);

    // Rutas para el recurso de productos
    Route::resource('/producto',ProductoController::class );

    // Ruta para generar el PDF de productos
    Route::get('/pdf/productos', [PdfController::class, 'pdfProductos'])->name('pdf.productos');
});

// Rutas de autenticación
require __DIR__.'/auth.php';
