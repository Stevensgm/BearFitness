<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    // Función para generar el PDF de productos
    public function pdfProductos()
    {
        // Obtener todos los productos de la base de datos
        $productos = Producto::select('id', 'nombre', 'descripcion', 'precio', 'precio_venta', 'stock', 'id_categoria')->orderBy('id', 'ASC')->get();

        // Cargar la vista 'pdf.productos' y pasarle los productos para generar el PDF
        $pdf = PDF::loadView('pdf.productos', [
            'productos' => $productos
        ]);

        // Configurar el tamaño del papel y la orientación para el PDF
        $pdf->setPaper('carta', 'A4');

        // Devolver el PDF generado como una respuesta para que se muestre en el navegador
        return $pdf->stream();
    }
}
