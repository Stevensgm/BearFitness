<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PdfController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/categoria',CategoriaController::class )->parameters(["categoria"=>"categoria"]);

Route::resource('/producto',ProductoController::class );

Route::get('/pdf/productos', [PdfController::class, 'pdfProductos'])->name('pdf.productos');

Route::get('/hola', function () {
    return "hola";
});


Route::get('/hola/{nombre}/{apellido}', function ($nombre,$apellido=null) {
    return "hola $nombre $apellido";
});