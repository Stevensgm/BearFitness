<?php

// Este archivo es parte de la configuración de rutas de tu aplicación Laravel. Aquí puedes definir las rutas que responden a las solicitudes web. Cada ruta está asociada a una función o a un controlador que maneja la lógica de la solicitud.
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\VentaController;




// Ruta para la página de bienvenida
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

// Ruta para almacenar una nueva venta
Route::post('/ventas',[VentaController::class,'store'])->name('ventas.store');

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
